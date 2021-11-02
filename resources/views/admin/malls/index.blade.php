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
        {{-- table-bordered --}}
        <form id="deleteMallsForm" action="{{ admin_url('malls/destroy')}}" method="POST">
            @method('delete')
            @csrf
            {{  $dataTable->table(['class' => 'dataTable table table-striped table-hover',], true) }}
        </form>
    </div>
</div>

<!-- Modal -->
<div id="multipleDelete" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Delete Malls</h4>
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
@push('js')
    <!-- DataTables  & Plugins -->
    <script src="{{ url('assets/adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('assets/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ url('assets/adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ url('vendor/datatables/buttons.server-side.js') }}"></script>
    {{ $dataTable->scripts() }}
@endpush
