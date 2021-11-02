<div id="info" class="container tab-pane active"><br>
    <div class="form-group">
        {!! Form::label('title_en', 'Product Title EN') !!}
        {!! Form::text('title_en',
            !isset($product) ? old('title_en') : $product->getTranslation('title', 'en'),
            ['class' => 'form-control', 'placeholder' => 'Product Title EN'])
        !!}
    </div>
    <div class="form-group">
        {!! Form::label('title_ar', 'Product Title AR') !!}
        {!! Form::text('title_ar',
            !isset($product) ? old('title_ar') : $product->getTranslation('title', 'ar'),
            ['class' => 'form-control', 'placeholder' => 'Product Title AR'])
        !!}
    </div>
    <div class="form-group">
        {!! Form::label('content_en', 'Product Content EN') !!}
        {!! Form::textarea('content_en',
            !isset($product) ? old('content_en') : $product->getTranslation('content', 'ar'),
            ['class' => 'form-control', 'placeholder' => 'Product Content EN'])
        !!}
    </div>
    <div class="form-group">
        {!! Form::label('content_ar', 'Product Content AR') !!}
        {!! Form::textarea('content_ar',
            !isset($product) ? old('content_ar') : $product->getTranslation('content', 'ar'),
            ['class' => 'form-control', 'placeholder' => 'Product Content AR'])
        !!}
    </div>
</div>
