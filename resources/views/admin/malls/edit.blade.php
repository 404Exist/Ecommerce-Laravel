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
                latitude: {{$mall->latitude}},
                longitude: {{$mall->longitude}}
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
        {!! Form::open(['url' => admin_url('malls/'.$mall->id), 'method' => 'patch', 'files' => true]) !!}
            {!! Form::hidden('latitude', $mall->latitude, ['id' => 'lat']) !!}
            {!! Form::hidden('longitude', $mall->longitude, ['id' => 'lon']) !!}
            <div class="form-group">
                {!! Form::label('name_en', 'Mall Name EN') !!}
                {!! Form::text('name_en', $mall->getTranslation('name', 'en'), ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('name_ar', 'Mall Name AR') !!}
                {!! Form::text('name_ar', $mall->getTranslation('name', 'ar'), ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('contact_name', 'Contact Name') !!}
                {!! Form::text('contact_name', $mall->contact_name, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('mobile', 'Mobile') !!}
                {!! Form::number('mobile', $mall->mobile, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('email', 'Email') !!}
                {!! Form::email('email', $mall->email, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('country_id', 'Country') !!}
                {!! Form::select('country_id', App\Models\Country::pluck('name', 'id')->map(function ($item, $key) {
                    return  App\Models\Country::find($key)->getTranslation('name', lang());
                }), $mall->country_id, ['class' => 'form-control', 'placeholder' => 'Country']) !!}
            </div>
            <div id="us1" style="height: 400px;"></div>

            <div class="form-group">
                {!! Form::label('facebook', 'Facebook') !!}
                {!! Form::url('facebook', $mall->facebook, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('twitter', 'Twitter') !!}
                {!! Form::url('twitter', $mall->twitter, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('website', 'Website') !!}
                {!! Form::url('website', $mall->website, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('logo', 'logo') !!}
                {!! Form::file('logo', ['class' => 'form-control']) !!}
                @if (!empty($mall->logo))
                    <img src="{{ asset('storage/'.$mall->logo) }}" style="width: 50px;height: 50px;" />
                @endif
            </div>
            {!! Form::submit($title, ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
</div>

</div><!-- /.container-fluid -->
@endsection

