@inject('request', 'Illuminate\Http\Request')
@extends('admin.layouts.app')

@section('content')
    @can('user_create')
    <p>
        <a href="{{ route('admin.users.create') }}" class="btn btn-success pl-3 pr-3" title="@lang('admin.buttons.add-new')"  data-toggle="tooltip" data-placement="top">
            <i class="fas fa-plus-square"></i>
        </a>
    </p>
    @endcan
    <div class="card card-default">
        <div class="card-body">
            <table class="table table-bordered {{ count($users) > 0 ? 'dataTable' : '' }}">
                <thead>
                    <tr>
                        <th>@lang('admin.users.fields.first-name')</th>
                        <th>@lang('admin.users.fields.last-name')</th>
                        <th>@lang('admin.users.fields.email')</th>
                        <th>@lang('admin.users.fields.mobile-number')</th>
                        <th>@lang('admin.users.fields.role')</th>
                        <th>@lang('admin.users.fields.status')</th>
                        <th>@lang('admin.buttons.action')</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($users) > 0)
                        @foreach ($users as $user)
                            <tr data-entry-id="{{ $user->id }}">
                                <td field-key='first_name'>{{ $user->first_name }}</td>
                                <td field-key='last_name'>{{ $user->last_name }}</td>
                                <td field-key='email'>{{ $user->email }}</td>
                                <td field-key='mobile_number'>
                                    ({{ $user->dailing_code }}) {{ $user->mobile_number }}
                                </td>
                                <td field-key='role'>{{ $user->role->name ?? '' }}</td>
                                <td field-key='status'>
                                    @if ($user->status == 1)
                                        Active
                                    @elseif ($user->status == 2)
                                        Inactive
                                    @endif
                                </td>
                                <td>
                                    @can('user_view')
                                    <a href="{{ route('admin.users.show',[$user->id]) }}" class="btn btn-info pl-3 pr-3" title="@lang('admin.buttons.view')" data-toggle="tooltip" data-placement="top">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @endcan
                                    @if($user->id != 1)
                                        @can('user_edit')
                                        <a href="{{ route('admin.users.edit',[$user->id]) }}" class="btn btn-warning pl-3 pr-3" data-toggle="tooltip" data-placement="top" title="@lang('admin.buttons.edit')">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @endcan
                                        @can('user_delete')
                                            {!! Form::open(array(
                                                'style' => 'display: inline-block;',
                                                'method' => 'DELETE',
                                                'onsubmit' => "return confirm('".trans("admin.buttons.are-you-sure")."');",
                                                'route' => ['admin.users.destroy', $user->id])) !!}
                                            {{-- {!! Form::submit(trans('admin.buttons.delete'), array('class' => 'btn btn-danger')) !!} --}}
                                            <button type="submit" class="btn btn-danger pl-3 pr-3" title="@lang('admin.buttons.delete')" data-toggle="tooltip" data-placement="top">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            {!! Form::close() !!}
                                        @endcan
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10">@lang('admin.qa_no_entries_in_table')</td>
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