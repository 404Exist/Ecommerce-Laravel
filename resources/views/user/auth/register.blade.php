@extends('layouts.app')
@section('title')
    Register
@endsection
@section('content')
<main id="main" class="main-site left-sidebar">
    <div class="container">
        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="/" class="link">home</a></li>
                <li class="item-link"><span>{{ __('Register') }}</span></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 col-md-offset-3">
                <div class=" main-content-area">
                    <div class="wrap-login-item ">
                        <div class="login-form form-item form-stl">
                            <form name="frm-login" method="POST" action="{{ route('register') }}">
                                @csrf
                                <fieldset class="wrap-title">
                                    <h3 class="form-title">Create an account</h3>
                                    <h4 class="form-subtitle">Personal infomation</h4>
                                </fieldset>
                                <fieldset class="wrap-input">
                                    <label for="frm-reg-lname">{{ __('Name') }}*</label>
                                    <input id="name" type="text" placeholder="{{ __('Name') }}*" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  required autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </fieldset>
                                <fieldset class="wrap-input">
                                    <label for="frm-login-uname">{{ __('E-Mail Address') }}</label>
                                    <input type="email" id="frm-login-uname" name="email" placeholder="Type your email address" value="{{ old('email') }}" required autofocus>
                                    @error('email')
                                        <span class="invalid-feedback text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </fieldset>
                                <fieldset class="wrap-input">
                                    <label for="frm-login-pass">{{ __('Password') }}</label>
                                    <input type="password" id="frm-login-pass" name="password" placeholder="************" required autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </fieldset>
                                <fieldset class="wrap-input">
                                    <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                    <input type="password" id="password-confirm" name="password_confirmation" placeholder="************" required autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </fieldset>


                                <fieldset class="wrap-input">
                                    <input type="submit" class="btn btn-sign" value="{{ __('Register') }}" name="register">
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
