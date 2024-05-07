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
            <h1>{{$profileData->name}}</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{route('index')}}">Home</a></li>
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
                                <h3>Profile Update</h3>


                                <form action="{{route('user.profile.update')}}" method="post" class="default-form" enctype="multipart/form-data">

                                    @csrf

                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="name" value="{{$profileData->name}}" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" name="username" value="{{$profileData->username}}" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" value="{{$profileData->email}}" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" name="phone" value="{{$profileData->phone}}" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" name="address" value="{{$profileData->address}}" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="formFile" class="form-label">Image</label>
                                        <input class="form-control" name="photo" type="file" id="image">
                                    </div>

                                    <div class="form-group">
                                        <label for="formFile" class="form-label"></label>
                                        <img src="{{!empty($profileData->photo) ? url('upload/user_images/'.$profileData->photo) : url('upload/no_image.jpg')}}" style="width: 80px; height: 80px;" id="showImage" alt="">
                                    </div>


                                    <div class="form-group message-btn">
                                        <button type="submit" class="theme-btn btn-one">Save Changes </button>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection
