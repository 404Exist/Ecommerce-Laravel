@include('user.layouts.header')
{{-- @if (admin_auth()->user()) --}}
    @include('user.layouts.navbar')
{{-- @endif --}}
<!-- Main content -->
<main class="py-4">
    @include('user.layouts.message')
    @yield('content')
</main>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

@include('user.layouts.footer')

