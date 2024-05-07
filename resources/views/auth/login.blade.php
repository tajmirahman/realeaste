@extends('frontend.frontend_dashboard')
@section('main')
@section('title')
    Login | Realshed
@endsection
<!--Page Title-->
<section class="page-title-two bg-color-1 centred">
    <div class="pattern-layer">
        <div class="pattern-1" style="background-image: url({{ asset('frontend/assets/images/shape/shape-9.png') }});">
        </div>
        <div class="pattern-2" style="background-image: url({{ asset('frontend/assets/images/shape/shape-10.png') }});">
        </div>
    </div>
    <div class="auto-container">
        <div class="content-box clearfix">
            <h1>Sign In Or Up</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="index.html">Home</a></li>
                <li>Sign In</li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Title-->


<!-- ragister-section -->
<section class="ragister-section centred sec-pad">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-xl-8 col-lg-12 col-md-12 offset-xl-2 big-column">
                <div class="sec-title">
                    <h5>Sign in</h5>
                    <h2>Sign In With Realshed</h2>
                </div>
                <div class="tabs-box">
                    <div class="tab-btn-box">
                        <ul class="tab-btns tab-buttons centred clearfix">
                            <li class="tab-btn active-btn" data-tab="#tab-1">Login</li>
                            <li class="tab-btn" data-tab="#tab-2">Register</li>
                        </ul>
                    </div>
                    <div class="tabs-content">

                        <div class="tab active-tab" id="tab-1">
                            <div class="inner-box">
                                <h4>Sign in</h4>

                                <form action="{{ route('login') }}" method="post" class="default-form">

                                    @csrf

                                    <div class="form-group">
                                        <label>Email Or Phone</label>
                                        <input type="text" name="login" id="login" required="" autocomplete="off" class="@error('login') is-invalid @enderror">

                                        @error('login')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="password" id="password" required="" autocomplete="off">
                                    </div>

                                    <div class="form-group message-btn">
                                        <button type="submit" class="theme-btn btn-one">Sign in</button>
                                    </div>


                                </form>
                                <div class="othre-text">
                                    <p>Have not any account? <a href="{{ route('register') }}">Register Now</a></p>
                                </div>
                            </div>
                        </div>

                        <div class="tab" id="tab-2">
                            <div class="inner-box">
                                <h4>Sign in</h4>
                                <form action="{{ route('register') }}" method="post" class="default-form">
                                    @csrf

                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="name" id="name" autocomplete="off" required="">
                                    </div>

                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" id="email" autocomplete="off" class="@error('email') is-invalid @enderror" required>

                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" name="phone" id="phone" autocomplete="off" required="">
                                    </div>

                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="password" id="password" autocomplete="off" class="@error('password') is-invalid @enderror" required="">

                                        @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input type="password" name="password_confirmation" id="password_confirmation" autocomplete="off" required="">
                                    </div>
                                   
                                    <div class="form-group message-btn">
                                        <button type="submit" class="theme-btn btn-one">Sign Up</button>
                                    </div>
                                </form>
                                <div class="othre-text">
                                    <p>Have not any account? <a href="{{route('login')}}">Register Now</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ragister-section end -->


<!-- subscribe-section -->
@include('frontend.home.subscribe')
<!-- subscribe-section end -->
@endsection
