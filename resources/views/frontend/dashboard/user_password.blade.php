@extends('frontend.frontend_dashboard')
@section('main')
@section('title')
    User Dashboard
@endsection

<!--Page Title-->
<section class="page-title centred"
    style="background-image: url({{ asset('frontend/assets/images/background/page-title-5.jpg') }});">
    <div class="auto-container">
        <div class="content-box clearfix">
            <h1>{{ $profileData->name }}</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('index') }}">Home</a></li>
                <li>User Password </li>
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
                                <h3>Profile Password Update</h3>


                                <form action="{{ route('user.password.update') }}" method="post" class="default-form">

                                    @csrf

                                    <div class="form-group">
                                        <label>Old Password</label>
                                        <input type="password" name="old_password" autocomplete="off" class="@error('old_password') is-invalid @enderror"
                                            required>

                                        @error('old_password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>New Password</label>
                                        <input type="password" name="new_password" autocomplete="off" class="@error('new_password') is-invalid @enderror"
                                            required>

                                        @error('new_password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input type="password" name="new_password_confirmation" autocomplete="off" 
                                            required>
                                    </div>




                                    <div class="form-group message-btn">
                                        <button type="submit" class="theme-btn btn-one">Password Update </button>
                                    </div>
                                </form>

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
