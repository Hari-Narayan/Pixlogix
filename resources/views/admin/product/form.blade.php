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
        {!! Form::label('title', trans('admin.products.fields.title').'*', ['class' => 'control-label']) !!}
        {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
        <input type="hidden" name="id" value="{{ (isset($product)) ? $product->id : '' }}">
    </div>
    <div class="col-sm-6 form-group">
        {!! Form::label('sku', trans('admin.products.fields.sku').'*', ['class' => 'control-label']) !!}
        {!! Form::text('sku', old('sku'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
    </div>
</div>
<div class="row">
    <div class="col-sm-6 form-group">
        {!! Form::label('category_id', trans('admin.products.fields.categories').'*', ['class' => 'control-label']) !!}
        @if (isset($selected_categories))
            <select name="category_id[]" class="form-control select2 select2-success" multiple>
                @foreach($categories as $key => $value)
                    <option value="{{ $value->id }}" @if (in_array($value->id, $selected_categories)) selected @endif>{{ $value->title }}</option>
                @endforeach
            </select>
        @else
        {!! Form::select('category_id[]', $categories, old('category_id'), ['class' => 'form-control select2 select2-success', 'required' => '', 'multiple' => '']) !!}
        @endif
    </div>
    <div class="col-sm-6 form-group">
        {!! Form::label('status', trans('admin.products.fields.status').'', ['class' => 'control-label']) !!}
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
<div class="row">
    <div class="col-sm-6 form-group">
        {!! Form::label('short_description', trans('admin.products.fields.short-description').'*', ['class' => 'control-label']) !!}
        {!! Form::textarea('short_description', old('short_description'), ['class' => 'form-control ', 'placeholder' => '', 'rows' => '5']) !!}
    </div>
    <div class="col-sm-6 form-group">
        {!! Form::label('image', trans('admin.products.fields.images').'*', ['class' => 'control-label']) !!}
        <div id="old_image_block" class="up_img_mul_box">
            @if (isset($product) && count($product->images))
                @foreach ($product->images as $value)
                    <img src="{{ url('public/uploads/products/thumb/' . $value->file_name) }}" alt="{{ $value->file_name }}" class="mul-image">
                @endforeach
            @endif
        </div>
        <div id="image_block" class="up_img_mul_box">
        </div>
        <div class="input-group">
            <div class="custom-file">
                {!! Form::file('images[]', ['class' => 'custom-file-input', 'multiple' => '', 'accept' => 'image/*', 'style' => 'margin-top: 10px;', 'onchange' => "multipleImageView(this)"]) !!}
                {!! Form::label('', trans('admin.buttons.choose-file'), ['class' => 'custom-file-label']) !!}
            </div>
        </div>
        {!! Form::hidden('image_max_size', 2) !!}
        {!! Form::hidden('image_max_width', 4096) !!}
        {!! Form::hidden('image_max_height', 4096) !!}
        <p class="text-danger" style="display: none;" id="image_error"></p>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 form-group">
        {!! Form::label('description', trans('admin.products.fields.description').'*', ['class' => 'control-label']) !!}
        {!! Form::textarea('description', old('description'), ['class' => 'form-control editor', 'placeholder' => '', 'required' => '']) !!}
    </div>
</div>
