@extends('layouts.client')
@section('content')

        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('client.news.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.news.title_singular') }}
                </a>
            </div>
        </div>
        
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.news.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-News">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.news.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.news.fields.title') }}
                            </th>
                            <th>
                                {{ trans('cruds.news.fields.short_description') }}
                            </th>
                            <th>
                                {{ trans('cruds.news.fields.photo') }}
                            </th> 
                            <th>
                                {{ trans('cruds.news.fields.status') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($news as $key => $news)
                            <tr data-entry-id="{{ $news->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $news->id ?? '' }}
                                </td>
                                <td>
                                    {{ $news->title ?? '' }}
                                </td>
                                <td>
                                    {{ $news->short_description ?? '' }}
                                </td>
                                <td>
                                    @if ($news->photo)
                                        <a href="{{ $news->photo->getUrl() }}" target="_blank"
                                            style="display: inline-block">
                                            <img src="{{ $news->photo->getUrl('thumb') }}">
                                        </a>
                                    @endif
                                </td> 
                                <td>
                                    @php
                                        if ($news->status == 'active') {
                                            $news_status = 'success';
                                        } elseif ($news->status == 'pending') {
                                            $news_status = 'info';
                                        } elseif ($news->status == 'closed') {
                                            $news_status = 'warning';
                                        } elseif ($news->status == 'refused') {
                                            $news_status = 'danger';
                                        } else {
                                            $news_status = 'dark';
                                        }
                                    @endphp
                                    <span
                                        class="badge badge-{{ $news_status }}">{{ trans('global.news_status.' . $news->status) ?? '' }}</span>
                                </td>
                                <td>  
                                    <a href="{{ route('client.news.show', $news->id) }}"
                                        class="btn btn-outline-info btn-pill action-buttons-view">
                                        <i class="fas fa-eye actions-custom-i"></i>
                                    </a> 

                                    <a href="{{ route('client.news.edit', $news->id) }}"
                                        class="btn btn-outline-success btn-pill action-buttons-edit">
                                        <i class="fa fa-edit actions-custom-i"></i>
                                    </a> 

                                    <?php $route = route('client.news.destroy', $news->id); ?>
                                    <a href="#" onclick="deleteConfirmation('{{ $route }}')"
                                        class="btn btn-outline-danger btn-pill action-buttons-delete">
                                        <i class="fa fa-trash actions-custom-i"></i>
                                    </a>  
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>



@endsection
@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('client.news.massDestroy') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
                return $(entry).data('entry-id')
                });
            
                if (ids.length === 0) {
                alert('{{ trans('global.datatables.zero_selected') }}')
            
                return
                }
            
                if (confirm('{{ trans('global.areYouSure') }}')) {
                $.ajax({
                headers: {'x-csrf-token': _token},
                method: 'POST',
                url: config.url,
                data: { ids: ids, _method: 'DELETE' }})
                .done(function () { location.reload() })
                }
                }
                }
                dtButtons.push(deleteButton)
                

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 25,
            });
            let table = $('.datatable-News:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
