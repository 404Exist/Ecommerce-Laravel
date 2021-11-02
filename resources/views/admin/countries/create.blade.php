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
        {!! Form::open(['url' => admin_url('countries'), 'files' => true]) !!}
            <div class="form-group">
                {!! Form::label('name_en', 'Country Name EN') !!}
                {!! Form::text('name_en', old('name_en'), ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('name_ar', 'Country Name AR') !!}
                {!! Form::text('name_ar', old('name_ar'), ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('mob_code', 'Mobile Code') !!}
                {!! Form::text('mob_code', old('mob_code'), ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('abbreviation', 'Abbreviation') !!}
                {!! Form::text('abbreviation', old('abbreviation'),['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('currency_en', 'Currency Name EN') !!}
                {!! Form::text('currency_en', old('currency_en'),['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('currency_ar', 'Currency Name AR') !!}
                {!! Form::text('currency_ar', old('currency_ar'),['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('flag', 'Flag') !!}
                {!! Form::file('flag', ['class' => 'form-control']) !!}
            </div>
            {!! Form::submit($title, ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
</div>

</div><!-- /.container-fluid -->
@endsection

