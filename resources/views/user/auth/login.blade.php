@extends('layouts.app')
@section('title')
    Login
@endsection
@section('content')

<main id="main" class="main-site left-sidebar">
    <div class="container">
        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="/" class="link">home</a></li>
                <li class="item-link"><span>login</span></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 col-md-offset-3">
                <div class=" main-content-area">
                    <div class="wrap-login-item ">
                        <div class="login-form form-item form-stl">
                            <form name="frm-login" method="POST" action="{{ route('login') }}">
                                @csrf
                                <fieldset class="wrap-title">
                                    <h3 class="form-title">Log in to your account</h3>
                                </fieldset>
                                <fieldset class="wrap-input">
                                    <label for="frm-login-uname">{{ __('E-Mail Address') }}</label>
                                    <input class="@error('email') is-invalid @enderror" type="email" id="frm-login-uname" name="email" placeholder="Type your email address" value="{{ old('email') }}" required autofocus>
                                    @error('email')
                                        <span class="invalid-feedback text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </fieldset>
                                <fieldset class="wrap-input">
                                    <label for="frm-login-pass">{{ __('Password') }}</label>
                                    <input type="password" id="frm-login-pass" class="@error('password') is-invalid @enderror" name="password" placeholder="************" required autocomplete="current-password">
                                    @error('password')
                                        <span class="invalid-feedback text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </fieldset>

                                <fieldset class="wrap-input">
                                    <div class="form-check">
                                        <input class="frm-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} style="display: inline-block">

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                        @if (Route::has('password.request'))
                                            <a class="link-function left-position" href="{{ route('password.request') }}" title="{{ __('Forgot Your Password?') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </div>

                                    <input type="submit" class="btn btn-submit" value="{{ __('Login') }}" name="submit">
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div><!--end main products area-->
            </div>
        </div><!--end row-->

    </div><!--end container-->

</main>
<!--main area-->
@endsection
