@extends('frontend.frontend_dashboard')
@section('main')
@section('title')
    User Dashboard
@endsection

<!--Page Title-->
<section class="page-title centred" style="background-image: url({{asset('frontend/assets/images/background/page-title-5.jpg')}});">
    <div class="auto-container">
        <div class="content-box clearfix">
            <h1>User Profile </h1>
            <ul class="bread-crumb clearfix">
                <li><a href="index.html">Home</a></li>
                <li>User Profile </li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Title-->


<!-- sidebar-page-container -->
<section class="sidebar-page-container blog-details sec-pad-2">
    <div class="auto-container">
        <div class="row clearfix">

            @include('frontend.dashboard.user_sidebar')

            <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                <div class="blog-details-content">
                    <div class="news-block-one">
                        <div class="inner-box">

                            <div class="lower-content">
                                <h3>Including Profile</h3>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="card-body" style="background-color: #1baf65;">
                                            <h1 class="card-title" style="color: white; font-weight: bold;">0</h1>
                                            <h5 class="card-text"style="color: white;"> Approved properties</h5>

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="card-body" style="background-color: #ffc107;">
                                            <h1 class="card-title" style="color: white; font-weight: bold; ">0</h1>
                                            <h5 class="card-text"style="color: white;"> Pending approve properties</h5>

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="card-body" style="background-color: #002758;">
                                            <h1 class="card-title" style="color: white; font-weight: bold;">0</h1>
                                            <h5 class="card-text"style="color: white; "> Rejected properties</h5>

                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- sidebar-page-container -->

<!-- subscribe-section -->
@include('frontend.home.subscribe')
<!-- subscribe-section end -->
@endsection
