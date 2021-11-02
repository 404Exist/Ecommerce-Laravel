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
        {!! Form::open(['url' => [admin_url('accounts/users/'.$user->id)] ]) !!}
            @method('patch')
            {!! Form::hidden('id', $user->id) !!}
            <div class="form-group">
                {!! Form::label('name', 'Admin Name') !!}
                {!! Form::text('name', $user->name, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('email', 'Email') !!}
                {!! Form::email('email', $user->email, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('level', 'Level') !!}
                {!! Form::select('level', ['user' => 'User', 'vendor' => 'Vendor', 'company' => 'Company'], $user->level, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('password', 'Password') !!}
                {!! Form::password('password', ['class' => 'form-control']) !!}
            </div>
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
</div>

</div><!-- /.container-fluid -->
@endsection

