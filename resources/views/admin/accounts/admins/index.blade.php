@extends('admin.index')

@section('title')
    {{ $title }}
@endsection
@section('content')

<div class="container-fluid">
<div class="card">
    <div class="card-header">
        <a class="btn btn-info" href="{{admin_url('accounts/admins/create')}}">
            <i class="fa fa-plus"></i> Create Admin
        </a>
        <a class="btn btn-danger delAdminsBtn"
            data-toggle="modal" data-target="#multipleDelete" onClick="delete_admin_modal_ui()"
            href="{{admin_url('accounts/admins/create')}}">
            <i class="fa fa-trash"></i> Delete Selected
        </a>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        {{-- table-bordered --}}
        <form id="deleteAdminsForm" action="{{ admin_url('accounts/admins/destroy')}}" method="POST">
            @method('delete')
            @csrf
            <div class="table-responsive hoverable-table">
                <table class="table table-hover" id="example1" data-page-length='50' style=" text-align: center;">
                    <thead>
                        <tr>
                            <th class="wd-10p border-bottom-0">#</th>
                            <th class="wd-15p border-bottom-0">Name</th>
                            <th class="wd-20p border-bottom-0">Email</th>
                            <th class="wd-20p border-bottom-0">Admin Roles</th>
                            <th class="wd-10p border-bottom-0">Edit</th>
                            <th class="wd-10p border-bottom-0">Delete</th>
                            <th class="wd-10p border-bottom-0">
                                <input type="checkbox" class="checkall" onclick="toggleCheckAll(this, 'check_admins')">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($admins as $key => $admin)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $admin->name }}</td>
                                <td>{{ $admin->email }}</td>

                                <td>
                                    @if (!empty($admin->getRoleNames()))
                                        @foreach ($admin->getRoleNames() as $roleName)
                                            <label class="badge badge-success">{{ $roleName }}</label>
                                        @endforeach
                                    @endif
                                </td>

                                <td>
                                    {{-- @can('Edit Admin Account') --}}
                                        <a href="{{ admin_url('accounts/admins/'.$admin->id.'/edit')}}" class="btn btn-info btn-sm"> <i class="fa fa-edit"></i></a>
                                    {{-- @endcan --}}
                                </td>
                                <td>
                                    @can('Delete Admin Account')
                                        <a data-toggle="modal" data-target="#multipleDelete"
                                            onclick="delete_admin_modal_ui({{$admin->id}}, '{{$admin->name}}')"
                                            class="btn btn-danger btn-sm"
                                        >
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    @endcan
                                </td>
                                <td>
                                    <input type="checkbox" name="item[]" value="{{$admin->id}}" class="check_admins">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>

    </div>
</div>

<!-- Modal -->
<div id="multipleDelete" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Delete Admins</h4>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <div id="multipleDelete__submit">

        </div>
      </div>
    </div>

  </div>
</div>


</div><!-- /.container-fluid -->
@endsection
