<div id="setting" class="container tab-pane fade"><br>
    <div class="row">
        <div class="form-group col-md-6">
            {!! Form::label('price', 'Product Price') !!}
            {!! Form::text('price',
                !isset($product) ? old('price') : $product->price,
                ['class' => 'form-control', 'placeholder' => 'Product Price'])
            !!}
        </div>
        <div class="form-group col-md-6">
            {!! Form::label('stock', 'Product Stock') !!}
            {!! Form::text('stock',
                !isset($product) ? old('stock') : $product->stock,
                ['class' => 'form-control', 'placeholder' => 'Product Stock'])
            !!}
        </div>
        <div class="form-group col-md-6">
            {!! Form::label('start_at', 'Product Start at') !!}
            {!! Form::text('start_at',
                !isset($product) ? old('start_at') : $product->start_at,
                ['class' => 'form-control datepicker', 'placeholder' => 'Product Start at'])
            !!}
        </div>
        <div class="form-group col-md-6">
            {!! Form::label('end_at', 'Product End at') !!}
            {!! Form::text('end_at',
                !isset($product) ? old('end_at') : $product->end_at,
                ['class' => 'form-control datepicker', 'placeholder' => 'Product End at'])
            !!}
        </div>
        <div class="form-group col-md-6">
            {!! Form::label('offer_price', 'Product Offer Price') !!}
            {!! Form::text('offer_price',
                !isset($product) ? 0 : $product->offer_price,
                ['class' => 'form-control', 'placeholder' => 'Product Offer Price'])
            !!}
        </div>
        <div class="form-group col-md-6">
            {!! Form::label('start_offer_at', 'Product Start Offer at') !!}
            {!! Form::text('start_offer_at',
                !isset($product) ? old('start_offer_at') : $product->start_offer_at,
                ['class' => 'form-control datepicker', 'placeholder' => 'Product Start Offer at'])
            !!}
        </div>
        <div class="form-group col-md-6">
            {!! Form::label('end_offer_at', 'Product End Offer at') !!}
            {!! Form::text('end_offer_at',
                !isset($product) ? old('end_offer_at') : $product->end_offer_at,
                ['class' => 'form-control datepicker', 'placeholder' => 'Product End Offer at'])
            !!}
        </div>
        <div class="form-group col-md-6">
            {!! Form::label('status', 'Product Status') !!}
            {!! Form::select('status', ['pending' => 'pending', 'rejected' => 'rejected', 'active' => 'active'],
                !isset($product) ? old('status') : $product->status,
                ['class' => 'form-control', 'placeholder' => 'Product Status'])
            !!}
        </div>
    </div>
</div>

@push('css')
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap-datepicker.min.css') }}" />
@endpush
@push('js')
    <script src="{{ url('assets/js/bootstrap-datepicker.min.js') }}"></script>
    <script type="text/javascript">
       !function(a){
            a.fn.datepicker.dates.ar={
                days:["الأحد","الاثنين","الثلاثاء","الأربعاء","الخميس","الجمعة","السبت","الأحد"],
                daysShort:["أحد","اثنين","ثلاثاء","أربعاء","خميس","جمعة","سبت","أحد"],
                daysMin:["ح","ن","ث","ع","خ","ج","س","ح"],
                months:["يناير","فبراير","مارس","أبريل","مايو","يونيو","يوليو","أغسطس","سبتمبر","أكتوبر","نوفمبر","ديسمبر"],
                monthsShort:["يناير","فبراير","مارس","أبريل","مايو","يونيو","يوليو","أغسطس","سبتمبر","أكتوبر","نوفمبر","ديسمبر"],
                today:"هذا اليوم",
                clear:"مسح",
                rtl:true
            }
        }(jQuery);
        $('.datepicker').datepicker({
            autoclose: false,
            todayHighlight: true,
            todayBtn: true,
            clearBtn: true,
            format: 'D dd-mm-yyyy',
            language: '{{lang()}}',
        });
        $('.datepicker').datepicker("setDate", new Date());
        $(document).on('change','[name=status]', function(){
            let status = $('[name=status] option:selected').val();
            if (status == 'rejected') {
                $('#setting').append(
                `<div class="form-group reason">
                    <label for="reason">Rejected Reason</label>
                    <textarea name="reason" id="reason" cols="50" rows="10" class="form-control" placeholder="Rejected Reason">{{!isset($product) ? old('reason') : $product->reason}}</textarea>
                </div>`);
                $('.reason').hide().show(300);
            } else {
                $('.reason').fadeOut(300, function(){ $('.reason').remove(); });
            }
        });
    </script>
@endpush
