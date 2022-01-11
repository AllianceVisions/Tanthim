<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyEventRequest;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Cawader;
use App\Models\City;
use App\Models\Client;
use App\Models\CompaniesAndInstitution;
use App\Models\Event;
use App\Models\Gate as EventGate;
use App\Models\GovernmentalEntity;
use App\Models\Specialization;
use App\Models\Visitor;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Alert;
use Auth;

class EventsController extends Controller
{
    use MediaUploadingTrait; 

    public function index(Request $request)
    { 

        if ($request->ajax()) {
            $client = Client::where('user_id',Auth::id())->first();

            $query = Event::where('client_id',$client->id)->with(['city', 'client.user', 'available_gates','specializations'])->select(sprintf('%s.*', (new Event())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) { 
                $crudRoutePart = 'client.events';

                return view('partials.datatablesActions_noAuth', compact( 
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            }); 
            $table->editColumn('date', function ($row) {
                $start = $row->start_date ? $row->start_date : '';
                $end = $row->end_date ? $row->end_date : '';
                return sprintf('<span class="badge bg-light text-dark">%s</span> <br> <span class="badge bg-secondary">%s</span>',$start,$end);
            });
            $table->editColumn('time', function ($row) {
                $start = $row->start_time ? $row->start_time : '';
                $end = $row->end_time ? $row->end_time : '';
                return sprintf('<span class="badge bg-light text-dark">%s</span> <br> <span class="badge bg-secondary">%s</span>',$start,$end);
            });
            $table->editColumn('city', function ($row) {
                $name = 'name_'.app()->getLocale();
                return $row->city ? $row->city->$name : '';
            });
            $table->addColumn('client_user_name', function ($row) {
                return $row->client ? $row->client->user->name : '';
            });

            $table->editColumn('available_gates', function ($row) {
                $labels = [];
                foreach ($row->available_gates as $available_gate) {
                    $labels[] = sprintf('<span class="badge badge-info label-many">%s</span>', $available_gate->gate);
                }

                return implode(' ', $labels);
            });

            $table->editColumn('specializations', function ($row) {
                $labels = [];
                foreach ($row->specializations as $specialization) {
                    $labels[] = sprintf('<span class="badge badge-info label-many">%s</span>', $specialization->name_ar);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('status', function ($row) {
                if($row->status == 'active'){
                    $event_status = 'success';
                }elseif($row->status == 'pending'){
                    $event_status = 'info';
                }elseif($row->status == 'closed'){
                    $event_status = 'warning';
                }elseif($row->status == 'refused'){
                    $event_status = 'danger';
                }else{
                    $event_status = 'dark';
                }
                return $row->status ? sprintf('<span class="badge badge-%s">%s</span>',$event_status,trans('global.events_status.'.$row->status)) : '';
            });
            $table->rawColumns(['actions', 'placeholder', 'client', 'date', 'time', 'status', 'available_gates','specializations']);

            return $table->make(true);
        }

        return view('client.events.index');
    }

    public function create()
    { 
        $cities = City::pluck('name_ar', 'id')->prepend(trans('global.pleaseSelect'), '');

        $client = Client::where('user_id',Auth::id())->first();

        $companies = CompaniesAndInstitution::with('user')->get()->pluck('user.name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $available_gates = EventGate::pluck('gate', 'id');

        $specializations = Specialization::pluck('name_ar', 'id');

        $cawaders = Cawader::with('user')->get(); 

        $governments = GovernmentalEntity::with('user')->get()->pluck('user.name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('client.events.create', compact('cities', 'companies', 'available_gates','specializations','cawaders','client','governments'));
    }

    public function store(StoreEventRequest $request)
    {
        $event = Event::create($request->all());
        $event->available_gates()->sync($request->input('available_gates', []));
        $event->specializations()->sync($request->input('specializations', []));
        $event->cawaders()->sync($request->input('cawaders', []));
        if ($request->input('photo', false)) {
            $event->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $event->id]);
        }

        Alert::success('تم بنجاح', 'تم إضافة الفعالية بنجاح ');
        return redirect()->route('client.events.index');
    }

    public function edit(Event $event)
    {
        $client = Client::where('user_id',Auth::id())->first();

        // check record auth
        $check = not_auth_recored($event->client_id, $client->id);
        if($check){
            return redirect()->route($check);
        }

        $cities = City::pluck('name_ar', 'id')->prepend(trans('global.pleaseSelect'), '');

        $companies = CompaniesAndInstitution::with('user')->get()->pluck('user.name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $available_gates = EventGate::pluck('gate', 'id');

        $specializations = Specialization::pluck('name_ar', 'id');

        $cawaders = Cawader::with('user')->get()->map(function($cawader) use ($event) {
            $cawader->hours = data_get($event->cawaders->firstWhere('id', $cawader->id), 'pivot.hours') ?? null;
            $cawader->amount = data_get($event->cawaders->firstWhere('id', $cawader->id), 'pivot.amount') ?? null;
            $cawader->extra_hours = data_get($event->cawaders->firstWhere('id', $cawader->id), 'pivot.extra_hours') ?? null;
            return $cawader;
        }); 

        $clients = Client::with('user')->get()->pluck('user.name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $governments = GovernmentalEntity::with('user')->get()->pluck('user.name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $event->load('city', 'company', 'specializations', 'cawaders', 'reviews', 'client', 'government', 'available_gates');

        return view('client.events.edit', compact('cities', 'companies', 'available_gates', 'event','specializations','cawaders','clients','governments'));
    }

    public function update(UpdateEventRequest $request, Event $event)
    {
        $event->update($request->all());
        $event->available_gates()->sync($request->input('available_gates', []));
        $event->specializations()->sync($request->input('specializations', []));
        $event->cawaders()->sync($request->input('cawaders', []));
        if ($request->input('photo', false)) {
            if (!$event->photo || $request->input('photo') !== $event->photo->file_name) {
                if ($event->photo) {
                    $event->photo->delete();
                }
                $event->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($event->photo) {
            $event->photo->delete();
        }

        Alert::success('تم بنجاح', 'تم تعديل بيانات الفعالية بنجاح ');
        return redirect()->route('client.events.index');
    }

    public function show(Event $event)
    {
        $client = Client::where('user_id',Auth::id())->first();

        // check record auth
        $check = not_auth_recored($event->client_id, $client->id);
        if($check){
            return redirect()->route($check);
        }
        $event->load('city', 'company', 'available_gates', 'specializations', 'cawaders', 'reviews', 'client', 'government', 'eventBrands', 'eventsVisitors');

        return view('client.events.show', compact('event'));
    }

    public function destroy(Event $event)
    {
        $client = Client::where('user_id',Auth::id())->first();

        // check record auth
        $check = not_auth_recored($brand->event->client_id, $client->id);
        if($check){
            return redirect()->route($check);
        }
        $event->delete();

        Alert::success('تم بنجاح', 'تم  حذف الفعالية بنجاح ');
        return 1;
    }

    public function massDestroy(MassDestroyEventRequest $request)
    {
        Event::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    { 
        $model         = new Event();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
