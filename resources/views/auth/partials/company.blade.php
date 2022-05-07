<form method="POST" action="{{ route('frontend.register.company') }}" enctype="multipart/form-data" id="form-company">
    @csrf
    <div class="row">
        <div class="form-group col-md-6">
            <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                id="name" value="{{ old('name', '') }}" required>
            @if ($errors->has('name'))
                <div class="invalid-feedback">
                    {{ $errors->first('name') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
        </div>
        <div class="form-group col-md-6">
            <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
            <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email"
                id="email" value="{{ old('email') }}" required>
            @if ($errors->has('email'))
                <div class="invalid-feedback">
                    {{ $errors->first('email') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
        </div>
        <div class="form-group col-md-6">
            <label class="required" for="password">{{ trans('cruds.user.fields.password') }}</label>
            <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password"
                name="password" id="password" required>
            @if ($errors->has('password'))
                <div class="invalid-feedback">
                    {{ $errors->first('password') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
        </div>
        <div class="form-group col-md-6">
            <label class="required" for="phone">{{ trans('cruds.user.fields.phone') }}</label>
            <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone"
                id="phone" value="{{ old('phone', '') }}" required>
            @if ($errors->has('phone'))
                <div class="invalid-feedback">
                    {{ $errors->first('phone') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.user.fields.phone_helper') }}</span>
        </div>
        <div class="form-group col-md-6">
            <label for="landline_phone">{{ trans('cruds.user.fields.landline_phone') }}</label>
            <input class="form-control {{ $errors->has('landline_phone') ? 'is-invalid' : '' }}" type="text"
                name="landline_phone" id="landline_phone" value="{{ old('landline_phone', '') }}">
            @if ($errors->has('landline_phone'))
                <div class="invalid-feedback">
                    {{ $errors->first('landline_phone') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.user.fields.landline_phone_helper') }}</span>
        </div>
        <div class="form-group col-md-6">
            <label class="required" for="website">{{ trans('cruds.user.fields.website') }}</label>
            <input class="form-control {{ $errors->has('website') ? 'is-invalid' : '' }}" type="text" name="website"
                id="website" value="{{ old('website', '') }}" required>
            @if ($errors->has('website'))
                <div class="invalid-feedback">
                    {{ $errors->first('website') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.user.fields.website_helper') }}</span>
        </div>
        <div class="form-group col-md-6 ">
            <label class="required"
                for="city_id">{{ trans('cruds.companiesAndInstitution.fields.city') }}</label>
            <select class="{{ $errors->has('city') ? 'is-invalid' : '' }}" name="city_id" id="city_id">
                @foreach (\App\Models\City::pluck('name_ar', 'id')->prepend(trans('global.pleaseSelect'), '') as $id => $entry)
                    <option value="{{ $id }}" {{ old('city_id') == $id ? 'selected' : '' }}>
                        {{ $entry }}</option>
                @endforeach
            </select>
            @if ($errors->has('city'))
                <div class="invalid-feedback">
                    {{ $errors->first('city') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.companiesAndInstitution.fields.city_helper') }}</span>
        </div>
        <div class="form-group col-md-6 ">
            <label class="required"
                for="specializations">{{ trans('cruds.companiesAndInstitution.fields.specializations') }}</label>
            <select class="{{ $errors->has('specializations') ? 'is-invalid' : '' }}" name="specializations[]"
                id="specializations" multiple>
                @foreach (\App\Models\Specialization::pluck('name_ar', 'id') as $id => $specialization)
                    <option value="{{ $id }}"
                        {{ in_array($id, old('specializations', [])) ? 'selected' : '' }}>
                        {{ $specialization }}</option>
                @endforeach
            </select>
            @if ($errors->has('specializations'))
                <div class="invalid-feedback">
                    {{ $errors->first('specializations') }}
                </div>
            @endif
            <span
                class="help-block">{{ trans('cruds.companiesAndInstitution.fields.specializations_helper') }}</span>
        </div>
        <div class="form-group col-md-6">
            <label class="required"
                for="commerical_num">{{ trans('cruds.companiesAndInstitution.fields.commerical_num') }}</label>
            <input class="form-control {{ $errors->has('commerical_num') ? 'is-invalid' : '' }}" type="text"
                name="commerical_num" id="commerical_num" value="{{ old('commerical_num', '') }}" required>
            @if ($errors->has('commerical_num'))
                <div class="invalid-feedback">
                    {{ $errors->first('commerical_num') }}
                </div>
            @endif
            <span
                class="help-block">{{ trans('cruds.companiesAndInstitution.fields.commerical_num_helper') }}</span>
        </div>
        <div class="form-group col-md-6">
            <label class="required"
                for="commerical_expiry">{{ trans('cruds.companiesAndInstitution.fields.commerical_expiry') }}</label>
            <input class="form-control date {{ $errors->has('commerical_expiry') ? 'is-invalid' : '' }}" type="text"
                name="commerical_expiry" id="commerical_expiry" value="{{ old('commerical_expiry') }}" required>
            @if ($errors->has('commerical_expiry'))
                <div class="invalid-feedback">
                    {{ $errors->first('commerical_expiry') }}
                </div>
            @endif
            <span
                class="help-block">{{ trans('cruds.companiesAndInstitution.fields.commerical_expiry_helper') }}</span>
        </div>
        <div class="form-group col-md-6">
            <label class="required"
                for="licence_num">{{ trans('cruds.companiesAndInstitution.fields.licence_num') }}</label>
            <input class="form-control {{ $errors->has('licence_num') ? 'is-invalid' : '' }}" type="text"
                name="licence_num" id="licence_num" value="{{ old('licence_num', '') }}" required>
            @if ($errors->has('licence_num'))
                <div class="invalid-feedback">
                    {{ $errors->first('licence_num') }}
                </div>
            @endif
            <span
                class="help-block">{{ trans('cruds.companiesAndInstitution.fields.licence_num_helper') }}</span>
        </div>
        <div class="form-group col-md-6">
            <label class="required"
                for="licence_expiry">{{ trans('cruds.companiesAndInstitution.fields.licence_expiry') }}</label>
            <input class="form-control date {{ $errors->has('licence_expiry') ? 'is-invalid' : '' }}" type="text"
                name="licence_expiry" id="licence_expiry" value="{{ old('licence_expiry') }}" required>
            @if ($errors->has('licence_expiry'))
                <div class="invalid-feedback">
                    {{ $errors->first('licence_expiry') }}
                </div>
            @endif
            <span
                class="help-block">{{ trans('cruds.companiesAndInstitution.fields.licence_expiry_helper') }}</span>
        </div>
        <div class="form-group col-md-6 ">
            <label class="required"
                for="about_company">{{ trans('cruds.companiesAndInstitution.fields.about_company') }}</label>
            <textarea class="form-control {{ $errors->has('about_company') ? 'is-invalid' : '' }}"
                name="about_company" id="about_company" style="height: 150px"
                required>{{ old('about_company') }}</textarea>
            @if ($errors->has('about_company'))
                <div class="invalid-feedback">
                    {{ $errors->first('about_company') }}
                </div>
            @endif
            <span
                class="help-block">{{ trans('cruds.companiesAndInstitution.fields.about_company_helper') }}</span>
        </div>
        <div class="form-group col-md-6">
            <label class="required" for="photo">{{ trans('cruds.user.fields.photo') }}</label>
            <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
            </div>
            @if ($errors->has('photo'))
                <div class="invalid-feedback">
                    {{ $errors->first('photo') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.user.fields.photo_helper') }}</span>
        </div>
    </div>

    <div class="form-group">
        <div>
            <input type="checkbox" id="terms_cader" name="terms_cader" value="terms_cader" required>
            <label for="terms_cader" style="display: inline">أوافق علي <a href="{{ route('frontend.terms',2) }}" target="_blank" >الشروط والأحكام</a></label> 
        </div> 
        <br>
        <button class="site-button button-md btn-block" type="submit">تسجيل</button>
    </div>
    <div class="form-group">
        <p class="info-bottom">
            <a href="{{ route('login') }}" class="btn-link">لديك حساب
                بالفعل </a>
        </p>
    </div>
</form>


<!-- Modal 
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background:#512d6d">
                <h5 class="modal-title" id="exampleModalLabel">الشروط والأحكام للشركات</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @php
                    $setting = \App\Models\Setting::first();
                @endphp
              <?php echo $setting->terms_cawader ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
            </div>
        </div>
    </div>
</div>-->