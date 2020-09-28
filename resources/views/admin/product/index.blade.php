@inject('request', 'Illuminate\Http\Request')
@extends('admin.layouts.app')

@section('content')
    @can('product_create')
    <p>
        <a href="{{ route('admin.products.create') }}" class="btn btn-success pl-3 pr-3" title="@lang('admin.buttons.add-new')"  data-toggle="tooltip" data-placement="top">
            <i class="fas fa-plus-square"></i>
        </a>
    </p>
    @endcan
    <div class="card card-default">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6 form-group">
                    {!! Form::label('search', trans('admin.products.fields.search') . ' ' . trans('admin.products.fields.title'), ['class' => 'control-label']) !!}
                    {!! Form::text('search', old('search'), ['class' => 'form-control', 'placeholder' => '', 'id' => 'search']) !!}
                </div>
                <div class="col-sm-6 form-group">
                    {!! Form::label('category', trans('admin.products.fields.categories').'', ['class' => 'control-label']) !!}
                    {!! Form::select('category',$categories, old('category'), ['class' => 'form-control select2 select2-success', 'id' => 'category', 'multiple' => '']) !!}
                </div>
                <div class="col-sm-6 form-group">
                    {!! Form::label('status', trans('admin.products.fields.status').'', ['class' => 'control-label']) !!}
                    {!! Form::select('status',$status, old('status'), ['class' => 'form-control select2', 'id' => 'status']) !!}
                </div>
                <div class="col-sm-6 form-group text-right">
                    <label for="" style="visibility: hidden; display: block; opacity: 0;">Action</label>
                    <button class="btn btn-success" type="button" id="btnSearch" style="margin-right: 10px;">
                        @lang('admin.products.fields.search')
                    </button>
                    <button class="btn btn-danger" type="button" id="clearbtn">
                        @lang('admin.buttons.clear-all')
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-default">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 text-right">
                    <button class="btn btn-info pl-3 pr-3" data-toggle="tooltip" data-placement="top" title="@lang('admin.buttons.import')">
                        <i class="fas fa-file-import"></i>
                    </button>
                    <a href="{{ url('backoffice/product_export') }}" class="btn btn-warning pl-3 pr-3" data-toggle="tooltip" data-placement="top" title="@lang('admin.buttons.export')">
                        <i class="fas fa-share-square"></i>
                    </a>
                </div>
            </div>
            <table class="table table-bordered table-striped w-100" id="productTable">
                <thead class="bg-success">
                    <tr>
                        <th>@lang('admin.products.fields.title')</th>
                        <th>@lang('admin.products.fields.sku')</th>
                        <th>@lang('admin.category.fields.status')</th>
                        <th>@lang('admin.products.fields.categories')</th>
                        <th>@lang('admin.products.fields.images')</th>
                        <th>@lang('admin.products.fields.short-description')</th>
                        <th>@lang('admin.buttons.action')</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@stop
@section('javascript') 
    <script>
        $(document).ready(function () {
            setTimeout(function() {
                $('.dataTables_filter').hide();
                $('#productTable').removeClass('dataTable');
            }, 100);

            $("#productTable").each(function () {
                window.dtDefaultOptions.processing = true;
                window.dtDefaultOptions.serverSide = true;

                window.dtDefaultOptions.ajax = {
                    url: "{{ route('admin.products.index') }}",
                    data: function (d) {
                        d.search = $('#search').val();
                        d.status = $('#status').val();
                        d.categories = $('#category').val();
                    }
                };

                window.dtDefaultOptions.columns = [
                    {data: 'title', name: 'title'},
                    {data: 'sku', name: 'sku'},
                    {data: 'status', name: 'status'},                
                    {data: 'category', name: 'category'},
                    {data: 'image', name: 'image'},
                    {data: 'short_description', name: 'short_description'},
                    {data: 'actions', name: 'actions', searchable: false, sortable: false}
                ];

                var oTable = $(this).DataTable(window.dtDefaultOptions);

                $('#btnSearch').on('click', function(e) {
                    oTable.draw();
                });

                $("#clearbtn").on('click', function(event) {
                    $("#category").val('').trigger('change');
                    $("#status").val('').trigger('change');
                    $('#search').val('');
                    oTable.draw();
                });
            });
        });
    </script>
@endsection