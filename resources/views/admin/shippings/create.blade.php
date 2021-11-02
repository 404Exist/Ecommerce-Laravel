@extends('admin.index')
@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ url('assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ url('assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush
@php
    $latitude= !empty(old('latitude')) ? old('latitude') : '30.60372461342821';
    $longitude= !empty(old('longitude')) ? old('longitude') : '30.964590430259697';
@endphp
@push('js')
    <script type="text/javascript" src='https://maps.google.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyAbNguUK2aND3WLKqJRy5KjbvpJUmEXHzM'></script>
    <script src="{{ url('assets/js/locationpicker.jquery.js') }}"></script>
    <script>
        $('#us1').locationpicker({
            location: {
                latitude: {{$latitude}},
                longitude: {{$longitude}}
            },
            radius: 50,
            markerIcon: '{{ url("assets/images/map-marker-2-xl.png") }}',
            inputBinding: {
                latitudeInput: $('#lat'),
                longitudeInput: $('#lon'),
                // locationNameInput: $('#address'),
                // radiusInput: $('#us2-radius'),
            },
            enableAutocomplete: true
        });
    </script>
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

        {!! Form::open(['url' => admin_url('shippings'), 'files' => true]) !!}
            {!! Form::hidden('latitude', $latitude, ['id' => 'lat']) !!}
            {!! Form::hidden('longitude', $longitude, ['id' => 'lon']) !!}
            <div class="form-group">
                {!! Form::label('name_en', 'Shipping Company Name EN') !!}
                {!! Form::text('name_en', old('name_en'), ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('name_ar', 'Shipping Company Name AR') !!}
                {!! Form::text('name_ar', old('name_ar'), ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('user_id', 'Shipping Company Name AR') !!}
                {!! Form::select('user_id', App\Models\User::where('level', 'company')->pluck('name', 'id') ,old('user_id'), ['class' => 'form-control', 'placeholder' => 'Choose Company']) !!}
            </div>
            <div id="us1" style="height: 400px;"></div>


            <div class="form-group">
                {!! Form::label('logo', 'logo') !!}
                {!! Form::file('logo', ['class' => 'form-control']) !!}
            </div>
            {!! Form::submit($title, ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
</div>

</div><!-- /.container-fluid -->
@endsection

