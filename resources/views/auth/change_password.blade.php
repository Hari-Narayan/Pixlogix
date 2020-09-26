@extends('admin.layouts.app')

@section('content')
	@if(session('success'))
		<div class="row">
			<div class="col-sm-12">
				<div class="alert alert-success">
					{{ session('success') }}
				</div>
			</div>
		</div>
	@else
		{!! Form::open(['method' => 'PATCH', 'route' => ['auth.change_password']]) !!}
		<div class="card card-success">
			<div class="card-header">
			  	<h3 class="card-title">
					@lang('admin.change-password.title')
				</h3>
			</div>
		  	<div class="card-body">
				<div class="row">
					<div class="col-sm-12 form-group">
						{!! Form::label('current_password', trans('admin.change-password.current-password'), ['class' => 'control-label']) !!}
						{!! Form::password('current_password', ['class' => 'form-control', 'placeholder' => '']) !!}
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 form-group">
						{!! Form::label('new_password', trans('admin.change-password.new-password'), ['class' => 'control-label']) !!}
						{!! Form::password('new_password', ['class' => 'form-control', 'placeholder' => '']) !!}
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 form-group">
						{!! Form::label('new_password_confirmation', trans('admin.change-password.password-confirm'), ['class' => 'control-label']) !!}
						{!! Form::password('new_password_confirmation', ['class' => 'form-control', 'placeholder' => '']) !!}
					</div>
				</div>
			</div>
			<div class="card-footer text-right">
				@include('admin.layouts.actionTemplate', ['route' => route('admin.home'), 'action' => '4', 'back_to' => '1'])
				{!! Form::close() !!}
			</div>
	  	</div>
	@endif
@stop