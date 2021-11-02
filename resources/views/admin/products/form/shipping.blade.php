<div id="shipping" class="container tab-pane fade"><br>
    <h1 id="title">Please Choose Department</h1>
    <div class="row d-none" id="shipping_info" >
        <div id="ajaxResponse" class="col-md-6"></div>
        <div class="col-md-6">
            <div class="form-group">
                <div class="row">
                    <label for="weights" class="col-md-3">Weight</label>
                    <div class="col-md-9">
                        {!! Form::select('weight_id', App\Models\Weight::pluck('name', 'id')->map(function ($item, $key) {
                            return  App\Models\Weight::find($key)->getTranslation('name', lang());
                        }), !isset($product) ? old('weight_id') : $product->weight_id, ['class' => 'form-control', 'placeholder' => 'Weight']) !!}
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <label for="weights" class="col-md-3">Weight</label>
                    <div class="col-md-9">
                        {!! Form::text('weight', !isset($product) ? old('weight') : $product->weight, ['class' => 'form-control', 'placeholder' => 'Weight']) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <div class="row">
                    <label for="colors" class="col-md-3">Color</label>
                    <div class="col-md-9">
                        {!! Form::select('color_id', App\Models\Color::pluck('name', 'id')->map(function ($item, $key) {
                            return  App\Models\Color::find($key)->getTranslation('name', lang());
                        }), !isset($product) ? old('color_id') : $product->color_id, ['class' => 'form-control', 'placeholder' => 'Color']) !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <div class="row">
                    <label for="trademark_id" class="col-md-3">Trademark</label>
                    <div class="col-md-9">
                        {!! Form::select('trademark_id', App\Models\Trademark::pluck('name', 'id')->map(function ($item, $key) {
                            return  App\Models\Trademark::find($key)->getTranslation('name', lang());
                        }), !isset($product) ? old('trademark_id') : $product->trademark_id, ['class' => 'form-control', 'placeholder' => 'Trademark']) !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <div class="row">
                    <label for="manufacturer_id" class="col-md-3">Manufacturer</label>
                    <div class="col-md-9">
                        {!! Form::select('manufacturer_id', App\Models\Manufacturer::pluck('name', 'id')->map(function ($item, $key) {
                            return  App\Models\Manufacturer::find($key)->getTranslation('name', lang());
                        }), !isset($product) ? old('manufacturer_id') : $product->manufacturer_id, ['class' => 'form-control', 'placeholder' => 'Manufacturer']) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <div class="row">
                    <label for="malls" class="col-md-3">Malls</label>
                    <div class="col-md-9">
                        <select class="js-example-basic-single form-control" name="mall_id[]" multiple>
                            @foreach (App\Models\Country::all() as $country)
                                <optgroup label="{{ $country->getTranslation('name', lang()) }}">
                                    @foreach ($country->malls as $mall)
                                        <option
                                            value="{{$mall->id}}"
                                            {{isset($product) ? (in_array($mall->id,$product->mall_id) ? 'selected' : '') : ''}}
                                        >
                                            {{$mall->getTranslation('name', lang())}}
                                        </option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@push('js')
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
@endpush
