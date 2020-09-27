@inject('request', 'Illuminate\Http\Request')
@extends('admin.layouts.app')

@section('content')
    @can('product_create')
    <p>
        <a href="{{ route('admin.category.create') }}" class="btn btn-success pl-3 pr-3" title="@lang('admin.buttons.add-new')"  data-toggle="tooltip" data-placement="top">
            <i class="fas fa-plus-square"></i>
        </a>
    </p>
    @endcan
    <div class="card card-default">
        <div class="card-body">
            <table class="table table-bordered {{ count($categories) > 0 ? 'dataTable' : '' }}">
                <thead>
                    <tr>
                        <th>@lang('admin.category.fields.title')</th>
                        <th>@lang('admin.category.fields.status')</th>
                        <th>@lang('admin.category.fields.parent-category')</th>
                        <th>@lang('admin.buttons.action')</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($categories) > 0)
                        @foreach ($categories as $category)
                            <tr data-entry-id="{{ $category->id }}">
                                <td field-key='title'>{{ $category->title }}</td>
                                <td field-key='status'>
                                    @if ($category->status)
                                        <span class="bg-success rounded p-2 mr-1">Active</span>
                                    @else
                                        <span class="bg-danger rounded p-2 mr-1">Inactive</span>
                                    @endif
                                </td>
                                <td field-key='categories'>
                                    @if ($category->parent_id)
                                        @php
                                            $subCategories1 = \App\Models\Category::where('id', $category->parent_id)
                                            ->get();
                                        @endphp
                                        @if (count($subCategories1))
                                            @foreach ($subCategories1 as $subCategory)
                                                <span class="bg-primary rounded p-2 mr-1">{{ $subCategory->title }}</span>
                                                @php
                                                    $subCategories2 = \App\Models\Category::where('id', $subCategory->parent_id)
                                                    ->get();
                                                @endphp
                                                @if (count($subCategories2))
                                                    @foreach ($subCategories2 as $subCategory1)
                                                        <span class="bg-primary rounded p-2 mr-1">{{ $subCategory1->title }}</span>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endif
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @can('category_edit')
                                    <a href="{{ route('admin.category.edit',[$category->id]) }}" class="btn btn-warning pl-3 pr-3" data-toggle="tooltip" data-placement="top" title="@lang('admin.buttons.edit')">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @endcan
                                    @can('category_delete')
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("admin.buttons.are-you-sure")."');",
                                            'route' => ['admin.category.destroy', $category->id]))
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