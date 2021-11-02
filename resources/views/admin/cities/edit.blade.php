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
        {!! Form::open(['url' => admin_url('cities/'.$city->id), 'method' => 'patch']) !!}
            <div class="form-group">
                {!! Form::label('name_en', 'City Name EN') !!}
                {!! Form::text('name_en', $city->getTranslation('name', 'en'), ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('name_ar', 'City Name AR') !!}
                {!! Form::text('name_ar', $city->getTranslation('name', 'ar'), ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('country_id', 'Country') !!}
                {!! Form::select('country_id', App\Models\Country::pluck('name', 'id')->map(function ($item, $key) {
                    return  App\Models\Country::find($key)->getTranslation('name', lang());
                }) ,$city->country_id, ['class' => 'form-control']) !!}
            </div>
            {!! Form::submit($title, ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
</div>

</div><!-- /.container-fluid -->
@endsection

