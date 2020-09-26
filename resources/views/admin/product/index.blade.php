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
            <table class="table table-bordered {{ count($products) > 0 ? 'dataTable' : '' }}">
                <thead>
                    <tr>
                        <th>@lang('admin.products.fields.title')</th>
                        <th>@lang('admin.products.fields.images')</th>
                        <th>@lang('admin.products.fields.sku')</th>
                        <th>@lang('admin.products.fields.categories')</th>
                        <th>@lang('admin.products.fields.short-description')</th>
                        <th>@lang('admin.buttons.action')</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($products) > 0)
                        @foreach ($products as $product)
                            <tr data-entry-id="{{ $product->id }}">
                                <td field-key='title'>{{ $product->title }}</td>
                                <td field-key='images'>
                                    @if (count($product->images))
                                        @foreach ($product->images as $key => $value)
                                            <img class="prod-img" src="{{ url('public/uploads/products/thumb/' . $value->file_name) }}" alt="{{ $value->file_name }}" />
                                        @endforeach
                                    @else
                                        -
                                    @endif
                                </td>
                                <td field-key='sku'>{{ $product->sku }}</td>
                                <td field-key='categories'>
                                    @if (count($product->categories))
                                        @foreach ($product->categories as $key => $categories)
                                            @php
                                                $category = App\Models\Category::findOrFail($categories->category_id);
                                            @endphp
                                            <span class="bg-primary rounded p-2 mr-1">{{ $category->title }}</span>
                                        @endforeach
                                    @else
                                        -
                                    @endif
                                </td>
                                <td field-key='short_description'>
                                    {{ $product->short_description }}
                                </td>
                                <td>
                                    {{-- @can('product_view')
                                    <a href="{{ route('admin.products.show',[$product->id]) }}" class="btn btn-info pl-3 pr-3" title="@lang('admin.buttons.view')" data-toggle="tooltip" data-placement="top">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @endcan --}}
                                    @can('product_edit')
                                    <a href="{{ route('admin.products.edit',[$product->id]) }}" class="btn btn-warning pl-3 pr-3" data-toggle="tooltip" data-placement="top" title="@lang('admin.buttons.edit')">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @endcan
                                    @can('product_delete')
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("admin.buttons.are-you-sure")."');",
                                            'route' => ['admin.products.destroy', $product->id]))
                                        !!}
                                            <button type="submit" class="btn btn-danger pl-3 pr-3" title="@lang('admin.buttons.delete')" data-toggle="tooltip" data-placement="top">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10">@lang('admin.error.no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop
@section('javascript') 
    <script>
    </script>
@endsection