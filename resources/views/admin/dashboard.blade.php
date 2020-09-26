@inject('request', 'Illuminate\Http\Request')
@extends('admin.layouts.app')

@section('content-header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    Home
                </li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('content')
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $products }}</h3>
                    <p>@lang('admin.dashboard.total-product')</p>
                </div>
                <div class="icon">
                    <i class="fas fa-layer-group"></i>
                </div>
                <a href="{{ route('admin.products.index') }}" class="small-box-footer">
                    @lang('admin.dashboard.more-info')
                    <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $categories }}</h3>
                    <p>@lang('admin.dashboard.total-category')</p>
                </div>
                <div class="icon">
                    <i class="fas fa-cubes"></i>
                </div>
                <a href="{{ route('admin.category.index') }}" class="small-box-footer">
                    @lang('admin.dashboard.more-info')
                    <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <!-- /.row -->
@stop

@section('javascript') 
    @parent
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    {{-- <script src="{{ url('public/admin/dist/js/pages/dashboard.js') }}"></script> --}}
    <!-- AdminLTE for demo purposes -->
    {{-- <script src="{{ url('public/admin/dist/js/demo.js') }}"></script> --}}

    <script src="//cdn.ckeditor.com/4.5.4/full/ckeditor.js"></script>

    <script>
        // $('.editor').each(function () {
        //     CKEDITOR.replace($(this).attr('id'),{
        //         filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        //         filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
        //         filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        //         filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
        //     });
        // });
    </script>
@endsection