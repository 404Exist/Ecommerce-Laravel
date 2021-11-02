@extends('admin.index')
@section('title')
  {{ $title }}
@endsection
@push('css')
  <link rel="stylesheet" type="text/css" href="{{ url('assets/css/select2.min.css') }}" />
@endpush
@section('content')

  <div class="container-fluid">
    <div class="card">
      {!! Form::open(['url' => admin_url('products'), 'method' => 'post', 'files' => true, 'id' => 'product_form']) !!}
      <div class="card-header">
        <a class="btn btn-primary">Save <span><i class="fa fa-save"></i></span> </a>
        <a class="btn btn-success" onclick="productCrud(this, 'POST', '{{ admin_url('products') }}','',false )">Save and continue <span><i class="fa fa-save"></i></span></a>
        <a class="btn btn-info" onclick="productCrud(this, 'POST', '{{ admin_url('product/copy') }}','',false, true )">Copy <span><i class="fa fa-copy"></i></span></a>
        <div id="validation">
          <ul style="margin: 0">

          </ul>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#info">Product Info <i class="fa fa-info"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#department">Product Department <i
                class="fa fa-list"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#setting">Product Setting <i class="fa fa-cog"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#media">Product Media <i class="fas fa-photo-video"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#shipping">Shipping information <i
                class="fas fa-exclamation-circle"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#additional_data">Additional Data <i
                class="fa fa-database"></i></a>
          </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
          @include('admin.products.form.info')
          @include('admin.products.form.department')
          @include('admin.products.form.setting')
          @include('admin.products.form.media')
          @include('admin.products.form.shipping')
          @include('admin.products.form.additional_data')
        </div>
      </div>
      {!! Form::close() !!}
    </div>

  </div><!-- /.container-fluid -->
@endsection

@push('js')
  <script src="{{ url('assets/js/select2.min.js') }}"></script>
@endpush
