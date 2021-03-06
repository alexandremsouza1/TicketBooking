<div class="row">
    <div class="col-md-8">
        <div class="box-body">
            <div class="form-group">
                <label for="status">@lang('company.station')</label>
                {{ Form::select('station_id', $stations->pluck('name', 'id'), $company->station_id ?? (Request::get('station_id') ?? ''), [
                    'class' => 'form-control',
                ]) }}
                <span for="station_id" class="error help-block"></span>
            </div>
            <div class="form-group">
                <label for="name">@lang('company.name')</label>
                {{ Form::text('name', $company->name ?? '', [
                    'class' => 'form-control',
                    'placeholder' => trans('company.name'),
                ]) }}
                <span for="name" class="error help-block"></span>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group group-member">
                        <label for="status">@lang('company.admin_company')</label>
                        @if(in_array(Auth::user()->role, [
                            config('setting.user.role.super_admin'),
                            config('setting.user.role.admin'),
                        ]))
                            {{ Form::text('super_manager_view', '', [
                                'class' => 'form-control user-autocomplate user-admin-company',
                                'autocomplete' => 'off',
                                'data-url' => route('user.search'),
                            ]) }}
                            {{ Form::hidden('super_manager', '', [
                                'class' => 'super-manager'
                            ]) }}
                        @endif
                        <div class="result-content-complate group-member-admin">
                            <ul class="ui-users ui-users-admin">
                                @if (isset($company))
                                    @foreach ($company->userCompanies->where('role', config('setting.user.role_company.super_manager')) as $user)
                                        <li class="ui-users-item" data-id="{{ $user->user_id }}" title="{{ $user->user->full_name }}">
                                            <div class="ui-users-item-wrapper">
                                                <img src="{{ $user->user->avatar }}" class="member-avatar">
                                                <span class="name-user">{{ $user->user->full_name }}</span>
                                                @if(in_array(Auth::user()->role, [
                                                    config('setting.user.role.super_admin'),
                                                    config('setting.user.role.admin'),
                                                ]))
                                                    <span class="remove-user"><i class="fa fa-trash-o" aria-hidden="true"></i></span>
                                                @endif
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                        <span for="super_manager_view" class="error help-block"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group group-member">
                        <label for="status">@lang('company.employee_company')</label>
                        @if(in_array(Auth::user()->role, [
                            config('setting.user.role.super_admin'),
                            config('setting.user.role.admin'),
                        ]) || Auth::user()->id == $company->userCompanies()->where('role', config('setting.user.role_company.super_manager'))->first()->user_id)
                            {{ Form::text('employee_view', '', [
                                'class' => 'form-control user-autocomplate',
                                'autocomplete' => 'off',
                                'data-url' => route('user.search'),
                            ]) }}
                            {{ Form::hidden('employee', '', [
                                'class' => 'employee'
                            ]) }}
                        @endif
                        <div class="result-content-complate group-member-emplyee">
                            <ul class="ui-users">
                                @if (isset($company))
                                    @foreach ($company->userCompanies->where('role', config('setting.user.role_company.manager')) as $user)
                                        <li class="ui-users-item" data-id="{{ $user->user_id }}" title="{{ $user->user->full_name }}">
                                            <div class="ui-users-item-wrapper">
                                                <img src="{{ $user->user->avatar }}" class="member-avatar">
                                                <span class="name-user">{{ $user->user->full_name }}</span>
                                                @if(in_array(Auth::user()->role, [
                                                    config('setting.user.role.super_admin'),
                                                    config('setting.user.role.admin'),
                                                ]) || Auth::user()->id == $company->userCompanies()->where('role', config('setting.user.role_company.super_manager'))->first()->user_id)
                                                    <span class="remove-user"><i class="fa fa-trash-o" aria-hidden="true"></i></span>
                                                @endif
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                        <span for="employee" class="error help-block"></span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="address">@lang('company.address')</label>
                {{ Form::text('address', $company->address ?? '', [
                    'class' => 'form-control',
                    'placeholder' => trans('company.address'),
                ]) }}
                <span for="address" class="error help-block"></span>
            </div>
            <div class="form-group">
                <label for="phone">@lang('company.phone')</label>
                {{ Form::text('phone', $company->phone ?? '', [
                    'class' => 'form-control',
                    'placeholder' => trans('company.phone'),
                ]) }}
                <span for="phone" class="error help-block"></span>
            </div>
            <div class="form-group">
                <label for="status">@lang('main.status')</label>
                {{ Form::select('status', $statuses, $company->status ?? '',[
                    'class' => 'form-control',
                ]) }}
                <span for="status" class="error help-block"></span>
            </div>
            @if (isset($company))
                <div class="form-group">
                    <a href="{{ route('route.index', ['company_id' => $company->id]) }}">
                        <label style="cursor: pointer" class="label label-info">{{ $company->routes->count() }} @lang('company.route')</label>
                    </a>
                    
                    <a href="{{ route('bus.index', ['company_id' => $company->id]) }}">
                        <label style="cursor: pointer" class="label label-warning">{{ $company->buses->count() }} @lang('main.bus')</label>
                    </a>
                </div>
            @endif
            <div class="form-group">
                <label for="description">@lang('company.description')</label>
                <textarea class="textarea" name="description" placeholder="Place some text here"
                    style="width: 100%; height: 200px; font-size: 14px;
                    line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $company->description ?? '' }}</textarea>
                <span for="description" class="error help-block"></span>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        {{ Form::hidden('old_image', '', [
            'class' => 'old-image'
        ]) }}
        <div class="custom-file-container"
            data-img="{{ isset($company) ? json_encode($company->images->pluck('url')->all()) : '' }}" data-upload-id="upload-image">
            <label>Upload File <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">&times;</a></label>
            <label class="custom-file-container__custom-file" >
                <input type="file" name="images[]" class="custom-file-container__custom-file__custom-file-input" accept="*" multiple aria-label="Choose File">
                <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                <span class="custom-file-container__custom-file__custom-file-control"></span>
            </label>
            <div class="custom-file-container__image-preview"></div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="box-body">
        <div class="box-footer">
            <button type="button" class="btn btn-primary btn-company">Submit</button>
        </div>
    </div>
</div>
