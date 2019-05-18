@extends('admin.template.master')

@section('main_content')
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('company.company_information')</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-md-8">
                    <form role="form">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="status">@lang('company.station')</label>
                                {{ Form::select('station', $stations->pluck('name', 'id'), $company->station_id,[
                                    'class' => 'form-control',
                                ]) }}
                            </div>
                            <div class="form-group">
                                <label for="name">@lang('company.name')</label>
                                {{ Form::text('name', $company->name, [
                                    'class' => 'form-control',
                                    'placeholder' => trans('company.name'),
                                ]) }}
                            </div>
                            <div class="form-group">
                                <label for="address">@lang('company.address')</label>
                                {{ Form::text('address', $company->address, [
                                    'class' => 'form-control',
                                    'placeholder' => trans('company.address'),
                                ]) }}
                            </div>
                            <div class="form-group">
                                <label for="phone">@lang('company.phone')</label>
                                {{ Form::text('phone', $company->phone, [
                                    'class' => 'form-control',
                                    'placeholder' => trans('company.phone'),
                                ]) }}
                            </div>
                            <div class="form-group">
                                <label for="status">@lang('company.status')</label>
                                {{ Form::select('status', $statuses, $company->status,[
                                    'class' => 'form-control',
                                ]) }}
                            </div>
                            <div class="form-group">
                                <label for="description">@lang('company.description')</label>
                                <textarea class="textarea" placeholder="Place some text here"
                                    style="width: 100%; height: 200px; font-size: 14px;
                                    line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $company->description }}</textarea>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-4">
                    {{-- <img class="avatar-user-detail" src="{{ $user->avatar }}" alt=""> --}}
                </div>
            </div>
            <!-- /.row -->
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('.textarea').wysihtml5()
        })
    </script>
@endpush
