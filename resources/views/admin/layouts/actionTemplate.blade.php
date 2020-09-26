{{-- action 1 - Add New / 2 - Save / 3 - Edit / 4 - Update / 5 - View / 5 - Delete --}}
{{-- back_to 1 - Back TO Dashboard / 2 - Back To List --}}
@if ($back_to == '1')    
<a href="{{ route('admin.home') }}" class="btn btn-default pl-3 pr-3" title="@lang('admin.buttons.back-to-dashboard')">
    <i class="fas fa-tachometer-alt"></i>
</a>
@endif
@if ($action == '4')    
    <button type="submit" class="btn btn-warning pl-3 pr-3" title="@lang('admin.buttons.update')">
        <i class="fas fa-edit"></i>
    </button>
@endif