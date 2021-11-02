@extends('user.index')
@section('title')
    Maintenance
@endsection
@section('content')
    <!--main area-->
    <main id="main" class="main-site">

        <div class="container">

            <div class="wrap-breadcrumb">
                <ul>
                    <li class="item-link"><a href="#" class="link">home</a></li>
                    <li class="item-link"><span>maintenance</span></li>
                </ul>
            </div>
        </div>

        <div class="container pb-60">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2>Website is under Maintenance status</h2>
                    <p>{{website_setting()->message_maintenance}}</p>
                    <a href="index.html" class="btn btn-submit btn-submitx">Continue Shopping</a>
                </div>
            </div>
        </div><!--end container-->

    </main>
    <!--main area-->
@endsection
