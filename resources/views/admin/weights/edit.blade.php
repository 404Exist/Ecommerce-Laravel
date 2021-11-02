@extends('admin.index')
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
        {!! Form::open(['url' => admin_url('weights/'.$weight->id), 'method' => 'patch']) !!}
            <div class="form-group">
                {!! Form::label('name_en', 'Weight Name EN') !!}
                {!! Form::text('name_en', $weight->getTranslation('name', 'en'), ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('name_ar', 'Weight Name AR') !!}
                {!! Form::text('name_ar', $weight->getTranslation('name', 'ar'), ['class' => 'form-control']) !!}
            </div>
            {!! Form::submit($title, ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
</div>

</div><!-- /.container-fluid -->
@endsection

