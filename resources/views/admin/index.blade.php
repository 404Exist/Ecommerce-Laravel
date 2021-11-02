@include('admin.layouts.header')
@if (admin_auth()->user())
    @include('admin.layouts.navbar')
@endif
<!-- Main content -->
<section class="content">
    @include('admin.layouts.message')
    @yield('content')
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

@include('admin.layouts.footer')

