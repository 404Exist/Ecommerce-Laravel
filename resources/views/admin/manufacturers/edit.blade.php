@extends('admin.index')
@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ url('assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ url('assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush
@push('js')
    <script type="text/javascript" src='https://maps.google.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyAbNguUK2aND3WLKqJRy5KjbvpJUmEXHzM'></script>
    <script src="{{ url('assets/js/locationpicker.jquery.js') }}"></script>
    <script>
        $('#us1').locationpicker({
            location: {
                latitude: {{$manufacturer->latitude}},
                longitude: {{$manufacturer->longitude}}
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
        {!! Form::open(['url' => admin_url('manufacturers/'.$manufacturer->id), 'method' => 'patch', 'files' => true]) !!}
            {!! Form::hidden('latitude', $manufacturer->latitude, ['id' => 'lat']) !!}
            {!! Form::hidden('longitude', $manufacturer->longitude, ['id' => 'lon']) !!}
            <div class="form-group">
                {!! Form::label('name_en', 'Manufacturer Name EN') !!}
                {!! Form::text('name_en', $manufacturer->getTranslation('name', 'en'), ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('name_ar', 'Manufacturer Name AR') !!}
                {!! Form::text('name_ar', $manufacturer->getTranslation('name', 'ar'), ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('contact_name', 'Contact Name') !!}
                {!! Form::text('contact_name', $manufacturer->contact_name, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('mobile', 'Mobile') !!}
                {!! Form::number('mobile', $manufacturer->mobile, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('email', 'Email') !!}
                {!! Form::email('email', $manufacturer->email, ['class' => 'form-control']) !!}
            </div>

            <div id="us1" style="height: 400px;"></div>

            <div class="form-group">
                {!! Form::label('facebook', 'Facebook') !!}
                {!! Form::url('facebook', $manufacturer->facebook, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('twitter', 'Twitter') !!}
                {!! Form::url('twitter', $manufacturer->twitter, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('website', 'Website') !!}
                {!! Form::url('website', $manufacturer->website, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('logo', 'logo') !!}
                {!! Form::file('logo', ['class' => 'form-control']) !!}
                @if (!empty($manufacturer->logo))
                    <img src="{{ asset('storage/'.$manufacturer->logo) }}" style="width: 50px;height: 50px;" />
                @endif
            </div>
            {!! Form::submit($title, ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
</div>

</div><!-- /.container-fluid -->
@endsection

