<div class="row">
    <div class="col-sm-12">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="list-unstyled">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>
<div class="row">
    <div class="col-sm-6 form-group">
        <input type="hidden" name="id" value="{{ (isset($category)) ? $category->id : '' }}">
        {!! Form::label('title', trans('admin.category.fields.title').'*', ['class' => 'control-label']) !!}
        {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
    </div>
    <div class="col-sm-6 form-group">
        {!! Form::label('parent_id', trans('admin.category.fields.parent-category').'*', ['class' => 'control-label']) !!}
        <select name="parent_id" id="" class="form-control select2 select2-success">
            <option value="">@lang('admin.please_select')</option>
            @if (count($categories))
                @foreach ($categories as $parent)
                    <option value="{{ $parent['id'] }}"{{ (isset($category) && $parent['id'] == $category->parent_id) ? 'selected' : '' }}>{{ $parent['title'] }}</option>
                    @foreach ($parent['sub_category'] as $child)
                        <option value="{{ $child['id'] }}"{{ (isset($category) && $child['id'] == $category->parent_id) ? 'selected' : '' }}>&nbsp; &nbsp; &nbsp; {{ $child['title'] }}</option>
                    @endforeach
                @endforeach
            @endif
        </select>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 form-group">
        {!! Form::label('status', trans('admin.category.fields.status').'', ['class' => 'control-label']) !!}
        <div>
            <div class="icheck-success d-inline">
                {!! Form::radio('status', '1', true, ['id' => 'active']) !!}
                {!! Form::label('active', trans('admin.buttons.status.active').'', ['class' => 'control-label']) !!}
            </div>

            <div class="icheck-success d-inline">
                {!! Form::radio('status', '0', false, ['id' => 'other']) !!}
                {!! Form::label('other', trans('admin.buttons.status.inactive').'', ['class' => 'control-label']) !!}
            </div>
        </div>
    </div>
</div>