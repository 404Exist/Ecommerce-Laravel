<div class="form-group">
    <div class="row">
        <label for="sizes" class="col-md-3">Size</label>
        <div class="col-md-9">
            {!! Form::select('size_id', $sizes, $product === '' ? old('size_id') : $product->size_id, ['class' => 'form-control', 'placeholder' => 'Size']) !!}
        </div>
    </div>
</div>

<div class="form-group">
    <div class="row">
        <label for="sizes" class="col-md-3">Size</label>
        <div class="col-md-9">
            {!! Form::text('size', $product === '' ? old('size') : $product->size, ['class' => 'form-control', 'placeholder' => 'Size']) !!}
        </div>
    </div>
</div>



