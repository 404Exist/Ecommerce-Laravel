@extends('admin.index')
@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ url('assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ url('assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush
@section('title')
    {{ $title }}
@endsection
@section('content')

<div class="container-fluid">
<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{$title}}</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        {!! Form::open(['url' => admin_url('states')]) !!}
            <div class="form-group">
                {!! Form::label('name_en', 'State Name EN') !!}
                {!! Form::text('name_en', old('name_en'), ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('name_ar', 'State Name AR') !!}
                {!! Form::text('name_ar', old('name_ar'), ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('country_id', 'Country') !!}
                {!! Form::select('country_id', App\Models\Country::pluck('name', 'id')->map(function ($item, $key) {
                    return  App\Models\Country::find($key)->getTranslation('name', lang());
                }), old('country_id'), ['class' => 'form-control', 'placeholder' => '......']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('city_id', 'City') !!}
                <span id="ajaxResponse">
                    <select name="city_id" class="form-control">
                        <option>.....</option>
                    </select>
                </span>
            </div>
            {!! Form::submit($title, ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
</div>

</div><!-- /.container-fluid -->
@push('js')
<script>
    let countryInput = document.querySelector('select[name=country_id]');
    countryInput.addEventListener('change', function() {
        let selectedCountry = countryInput.options[countryInput.selectedIndex].value;
        ajax({url: `{{ admin_url('states/${selectedCountry}') }}`});
    });
</script>
@endpush
@endsection

