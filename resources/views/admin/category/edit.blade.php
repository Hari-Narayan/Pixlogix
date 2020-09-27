@extends('admin.layouts.app')

@section('content')
    {!! Form::model($category, ['method' => 'PUT', 'route' => ['admin.category.update', $category->id], 'files' => true]) !!}
    <div class="card card-default">
        <div class="card-header bg-success">
            <h3 class="card-title">@lang('admin.category.add-new-category')</h3>
        </div>
        <div class="card-body">
            {{-- include category form for add or edit --}}
            @include('admin.category.form')
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-sm-12 text-right">
                    <a href="{{ route('admin.category.index') }}" class="btn btn-default">@lang('admin.buttons.back-to-list')</a>
                    {!! Form::submit(trans('admin.buttons.update'), ['class' => 'btn btn-warning']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
    @parent
    <script src="//cdn.ckeditor.com/4.5.4/full/ckeditor.js"></script>
    <script>
        $('.editor').each(function () {
            CKEDITOR.replace($(this).attr('id'),{
                filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
                filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
            });
        });
    </script>
@stop