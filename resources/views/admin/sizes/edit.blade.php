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
        {!! Form::open(['url' => admin_url('sizes/'.$size->id), 'method' => 'patch']) !!}
            {!! Form::hidden('department_id', $size->department_id) !!}
            <div class="form-group">
                {!! Form::label('name_en', 'Size Name EN') !!}
                {!! Form::text('name_en', $size->getTranslation('name', 'en'), ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('name_ar', 'Size Name AR') !!}
                {!! Form::text('name_ar', $size->getTranslation('name', 'ar'), ['class' => 'form-control']) !!}
            </div>
            @if (load_department() === '[]')
                There are no departments
            @else
                <div id="jstree"></div>
            @endif
            <div class="form-group">
                {!! Form::label('is_public', 'is_public') !!}
                {!! Form::select('is_public', ['yes' => 'yes', 'no' => 'no'], $size->is_public, ['class' => 'form-control']) !!}
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
            'data' : {!! load_department($size->department_id) !!},
            'themes' : {
                'variant' : 'large'
            }
        },
        "plugins" : [ "wholerow" ],
    });
    $('#jstree').on("changed.jstree", function (e, data) {
        $('#department_btns').html('');
        let i, j, r = [];
        for (i=0,j=data.selected.length; i< j; i++) {
            r.push(data.selected[i]);
        }
        let id = r.join(', ');
        if (id != '') {
            $('input[name=department_id]').val(id);
        }
    });
</script>
@endpush
