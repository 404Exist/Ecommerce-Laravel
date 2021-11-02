@extends('admin.index')
@section('css')
<!--Internal  treeview -->
<link rel="stylesheet" type="text/css" href="{{ url('assets/css/treeview.css') }}" />
@section('title')
    {{$title}}
@endsection

@section('content')



<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{$title}}</h3>
        </div>
        <!-- /.card-header -->
        {!! Form::open(['route' => 'roles.store','method'=>'POST']) !!}
            <div class="card-body">
                <div class="form-group">
                    <p>Role Name :</p>
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>
                <div class="row">
                    <!-- col -->
                    <div class="col-lg-6">
                        <ul id="treeview1">
                            <li>
                                <a href="#">Permissions</a>
                                <ul>
                                    @foreach($permissions as $permission)
                                        <label style="font-size: 16px;">
                                            {{ Form::checkbox('permission[]', $permission->id, false, ['class' => 'name']) }}
                                            {{ $permission->name }}
                                        </label>
                                        <br/>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!-- /col -->
                </div>
                {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}
    </div>

</div><!-- /.container-fluid -->

@endsection
@push('js')
<!-- Internal Treeview js -->
<script src="{{ url('assets/js/treeview.js')}}"></script>
@endpush
