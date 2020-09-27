{{-- @can($gateKey.'view')
    <a href="{{ route($routeKey.'.show', $row->id) }}"
       class="btn btn-xs btn-primary">@lang('admin.view')</a>
@endcan --}}
@can($gateKey.'edit')
    <a href="{{ route($routeKey.'.edit',[$row->id]) }}" class="btn btn-warning pl-3 pr-3" data-toggle="tooltip" data-placement="top" title="@lang('admin.buttons.edit')">
        <i class="fas fa-edit"></i>
    </a>
@endcan
@can($gateKey.'delete')
    {!! Form::open(array(
        'style' => 'display: inline-block;',
        'method' => 'DELETE',
        'onsubmit' => "return confirm('".trans("admin.buttons.are-you-sure")."');",
        'route' => [$routeKey.'.destroy', $row->id])) !!}
    <button type="submit" class="btn btn-danger pl-3 pr-3" title="@lang('admin.buttons.delete')" data-toggle="tooltip" data-placement="top">
        <i class="fas fa-trash"></i>
    </button>
    {!! Form::close() !!}
@endcan
