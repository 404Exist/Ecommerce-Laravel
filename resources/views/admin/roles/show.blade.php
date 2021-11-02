@extends('admin.index')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/treeview.css') }}" />
@endpush
@section('title')
    {{ $role->name }}
@endsection
@section('content')

<div class="container-fluid">
<div class="card">
    <div class="card-header pb-0">
        <div class="d-flex justify-content-between">
            <div class="col-lg-12 margin-tb">
                <div class="pull-right">
                    {{ $role->name }}
                </div>
            </div>
            <br>
        </div>

    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <!-- col -->
            <div class="col-lg-4">
                <ul id="treeview1">
                    <li><a href="#">{{ $role->name }}</a>
                        <ul>
                            @if(!empty($rolePermissions))
                                @foreach($rolePermissions as $v)
                                    <li>{{ $v->name }}</li>
                                @endforeach
                            @endif
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /col -->
        </div>
    </div>
</div>


</div><!-- /.container-fluid -->
@endsection
@push('js')
    <script src="{{ url('assets/js/treeview.js')}}"></script>
@endpush
