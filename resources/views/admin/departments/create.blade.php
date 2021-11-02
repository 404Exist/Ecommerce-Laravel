@extends('admin.index')
@push('css')
<link rel="stylesheet" href="{{ url('assets/adminlte/jsTree/themes/default/style.css') }}" />
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
        {!! Form::open(['url' => admin_url('departments'), 'files' => true]) !!}
            {!! Form::hidden('parent_id', old('parent_id')) !!}
            <div class="form-group">
                {!! Form::label('name_en', 'Department Name EN') !!}
                {!! Form::text('name_en', old('name_en'), ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('name_ar', 'Department Name AR') !!}
                {!! Form::text('name_ar', old('name_ar'), ['class' => 'form-control']) !!}
            </div>
            <div id="jstree"></div>
            <div class="form-group">
                {!! Form::label('description', 'Description') !!}
                {!! Form::textarea('description', old('description'), ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('keyword', 'Keyword') !!}
                {!! Form::textarea('keyword', old('keyword'), ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('icon', 'Icon') !!}
                {!! Form::file('icon', ['class' => 'form-control']) !!}
            </div>
            {!! Form::submit($title, ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
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
            'data' : {!! load_department(old('parent_id')) !!},
            'themes' : {
                'variant' : 'large'
            }
        },
        "plugins" : [ "wholerow" ]
    });
    $('#jstree').on("changed.jstree", function (e, data) {
        let i, j, r = [];
        for (i=0,j=data.selected.length; i< j; i++) {
            r.push(data.selected[i]);
        }
        $('input[name=parent_id]').val(r.join(', '));
        $('input[name=parents]').val(data.node.parents);
        console.log(data.node.children_d);
        console.log(data);
    });
</script>
@endpush
