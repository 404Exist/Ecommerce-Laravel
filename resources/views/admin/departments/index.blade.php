@extends('admin.index')
@section('title')
    {{ $title }}
@endsection
@push('css')
<link rel="stylesheet" href="{{ url('assets/adminlte/jsTree/themes/default/style.css') }}" />
@endpush
@section('content')

<div class="container-fluid">
<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{$title}}</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        @if (load_department() === '[]')
            There are no departments
        @else
            <div id="department_btns"></div>
            <div id="jstree"></div>
        @endif
    </div>
</div>

{{-- onclick="delete_admin_modal_ui('.$id.', \''.$name.'\', \'check_cities\', \'deleteDepartmentsForm\')" --}}
{{-- toggleCheckAll(this, \'check_cities\') --}}
<!-- Modal -->
<div id="multipleDelete" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete Departments</h4>
        </div>
        <form id="deleteDepartmentsForm" action="{{ admin_url("departments/destroy")}}" method="POST">
            @method('delete')
            @csrf
            <input type="hidden" name="id" />
            <div class="modal-body">
                <div class="alert alert-danger">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <div id="multipleDelete__submit">

                    <input type="submit" value="Delete" class="btn btn-danger" />
                </div>
            </div>
        </form>
      </div>

    </div>
</div>
</div><!-- /.container-fluid -->
@endsection
@push('js')
<script src="{{ url('assets/adminlte/jsTree/jstree.js') }}"></script>
<script src="{{ url('assets/adminlte/jsTree/jstree.wholerow.js') }}"></script>
<script src="{{ url('assets/adminlte/jsTree/jstree.checkbox.js') }}"></script>
<script>
    $('#jstree').jstree({
        "core" : {
            'data' : {!! load_department() !!},
            'themes' : {
                'variant' : 'large'
            }
        },
        "plugins" : [ "wholerow" ],
    });
    $('#jstree').on("changed.jstree", function (e, data) {
        $('#department_btns').html('');
        let i, j, r = [];
        let name = [];
        for (i=0,j=data.selected.length; i< j; i++) {
            r.push(data.selected[i]);
            name.push(data.instance.get_node(data.selected[i]).text);
        }
        let id = r.join(', ');
        $('input[name=id]').val(id);
        $('#multipleDelete .modal-body .alert').text(`Are you sure you want to delete ${name} ?`);


        if (id != '') {
            $('#department_btns').html(`
                <a href="{{admin_url('departments')}}/${data.selected[0]}/edit" class="btn btn-info"><i class="fa fa-edit"></i>Edit</a>
                <a href="" class="btn btn-danger" data-toggle="modal" data-target="#multipleDelete"><i class="fa fa-trash"></i>Delete</a>
            `);
        }
    });
</script>
@endpush
