@extends('admin.layouts.app')

@section('content')
    {!! Form::open(['method' => 'POST', 'route' => ['admin.products.store'], 'files' => true]) !!}
    <div class="card card-default">
        <div class="card-header bg-success">
            <h3 class="card-title">@lang('admin.products.add-new-product')</h3>
        </div>
        <div class="card-body">
            {{-- include product form for add or edit --}}
            @include('admin.product.form')
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-sm-12 text-right">
                    <a href="{{ route('admin.products.index') }}" class="btn btn-default">@lang('admin.buttons.back-to-list')</a>
                    {!! Form::submit(trans('admin.buttons.save'), ['class' => 'btn btn-success']) !!}
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