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
        {{-- Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) --}}
        {!! Form::open(['route' => ['roles.update', $role->id], 'method'=>'PATCH']) !!}
            <div class="card-body">
                <div class="form-group">
                    <p>Role Name :</p>
                    {!! Form::text('name', $role->name, ['class' => 'form-control']) !!}
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
                                            {{ Form::checkbox('permission[]', $permission->id,
                                                in_array($permission->id, $rolePermissions) ? true : false,
                                                ['class' => 'name'])
                                            }}
                                            {{ $permission->name }}
                                        </label><br />
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!-- /col -->
                </div>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}
    </div>

</div><!-- /.container-fluid -->

@endsection
@push('js')
<!-- Internal Treeview js -->
<script src="{{ url('assets/js/treeview.js')}}"></script>
@endpush
