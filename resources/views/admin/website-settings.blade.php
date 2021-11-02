@extends('admin.index')
@section('title')
    {{ $title }}
@endsection
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <b style="font-size: 1.1rem;">
                <i class="fas fa-sliders-h"></i>
                {{ $title }}
            </b>

        </div><!-- /.card-header -->
        <div class="card-body">
            {!! Form::open(['url' => admin_url('settings'), 'files' => true]) !!}
                <div class="form-group">
                    {!! Form::label('sitename_ar', 'Website name in arabic') !!}
                    {!! Form::text('sitename_ar', website_setting()->getTranslation('sitename', 'ar'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('sitename_en', 'Website name in english') !!}
                    {!! Form::text('sitename_en', website_setting()->getTranslation('sitename', 'en'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('email', 'Email') !!}
                    {!! Form::email('email', website_setting()->email, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('logo', 'Logo') !!}
                    {!! Form::file('logo', ['class' => 'form-control']) !!}
                    @if (!empty(website_setting()->logo))
                        <img src="{{ asset('storage/'.website_setting()->logo) }}" style="width: 50px;height: 50px;" />
                    @endif
                </div>
                <div class="form-group">
                    {!! Form::label('icon', 'Icon') !!}
                    {!! Form::file('icon', ['class' => 'form-control']) !!}
                    @if (!empty(website_setting()->icon))
                        <img src="{{ asset('storage/'.website_setting()->icon) }}" style="width: 50px;height: 50px;" />
                    @endif
                </div>
                <div class="form-group">
                    {!! Form::label('description', 'Description') !!}
                    {!! Form::textarea('description', website_setting()->description, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('keywords', 'Keywords') !!}
                    {!! Form::textarea('keywords', website_setting()->keywords, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('main_lang', 'Website Language') !!}
                    {!! Form::select('main_lang', ['ar' => 'Arabic', 'en'=>'English'], website_setting()->main_lang, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('status', 'Status') !!}
                    {!! Form::select('status', ['open' => 'Open', 'close'=>'Close'], website_setting()->status, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('message_maintenance_ar', 'Maintenance Message in Arabic') !!}
                    {!! Form::textarea('message_maintenance_ar', website_setting()->getTranslation('message_maintenance', 'ar'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('message_maintenance_en', 'Maintenance Message in English') !!}
                    {!! Form::textarea('message_maintenance_en', website_setting()->getTranslation('message_maintenance', 'en'), ['class' => 'form-control']) !!}
                </div>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div><!-- /.card-body -->
    </div>
    <!-- /.card -->
</div><!-- /.container-fluid -->
@endsection
