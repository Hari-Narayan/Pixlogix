@extends('admin.layouts.app')

@section('content')
    {!! Form::open(['method' => 'POST', 'route' => ['admin.users.store']]) !!}
    <div class="card card-default">
        <div class="card-header bg-success">
            <h3 class="card-title">@lang('admin.users.add-new-user')</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6 form-group">
                    {!! Form::label('first_name', trans('admin.users.fields.first-name').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('first_name', old('first_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                </div>
                <div class="col-sm-6 form-group">
                    {!! Form::label('last_name', trans('admin.users.fields.last-name').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('last_name', old('last_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 form-group">
                    {!! Form::label('email', trans('admin.users.fields.email').'*', ['class' => 'control-label']) !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                </div>
                <div class="col-sm-6 form-group">
                    {!! Form::label('gender', trans('admin.users.fields.gender.title').'', ['class' => 'control-label']) !!}
                    <div>
                        <div class="icheck-success d-inline">
                            {!! Form::radio('gender', '1', true, ['id' => 'male']) !!}
                            {!! Form::label('male', trans('admin.users.fields.gender.fields.male').'', ['class' => 'control-label']) !!}
                        </div>
                        
                        <div class="icheck-success d-inline">
                            {!! Form::radio('gender', '1', false, ['id' => 'female']) !!}
                            {!! Form::label('female', trans('admin.users.fields.gender.fields.female').'', ['class' => 'control-label']) !!}
                        </div>
                        
                        <div class="icheck-success d-inline">
                            {!! Form::radio('gender', '0', false, ['id' => 'other']) !!}
                            {!! Form::label('other', trans('admin.users.fields.gender.fields.other').'', ['class' => 'control-label']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 form-group">
                    {!! Form::label('password', trans('quickadmin.users.fields.password').'*', ['class' => 'control-label']) !!}
                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                </div>
                <div class="col-sm-6 form-group">
                    {!! Form::label('role_id', trans('admin.users.fields.role').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('role_id', $roles, old('role_id'), ['class' => 'form-control select2 select2-success', 'required' => '']) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-success']) !!}
            {!! Form::close() !!}
            <a href="{{ route('admin.users.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop