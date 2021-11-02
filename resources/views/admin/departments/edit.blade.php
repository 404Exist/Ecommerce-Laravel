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
        {!! Form::open(['url' => admin_url('departments/'.$department->id), 'method' => 'patch', 'files' => true]) !!}
        {!! Form::hidden('parent_id', $department->parent_id) !!}
            <div class="form-group">
                {!! Form::label('name_en', 'Department Name EN') !!}
                {!! Form::text('name_en', $department->getTranslation('name', 'en'), ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('name_ar', 'Department Name AR') !!}
                {!! Form::text('name_ar', $department->getTranslation('name', 'ar'), ['class' => 'form-control']) !!}
            </div>
            <div id="jstree"></div>
            <div class="form-group">
                {!! Form::label('description', 'Description') !!}
                {!! Form::textarea('description', $department->description, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('keyword', 'Keyword') !!}
                {!! Form::textarea('keyword', $department->keyword, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('icon', 'Icon') !!}
                {!! Form::file('icon', ['class' => 'form-control']) !!}
                @if (!empty($department->icon))
                    <img src="{{ asset('storage/'.$department->icon) }}" style="width: 50px;height: 50px;" />
                @endif
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
            'data' : {!! load_department($department->parent_id, $department->id) !!},
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
    });

    $('#jstree').on("ready.jstree", function (e, data) {
        function changeStatus(node_id, changeTo) {
            var node = $("#jstree").jstree().get_node(node_id);
                node.state.disabled = true;
                console.log(node);
                node.children_d.forEach( function(child_id) {
                    changeStatus( child_id, changeTo );
                })
        }
        changeStatus({{$department->id}}, 'enable1');
    });


</script>
@endpush
