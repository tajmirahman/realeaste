@extends('frontend.frontend_dashboard')
@section('main')
@section('title')
    Category Wise Blog
@endsection

<!--Page Title-->
<section class="page-title centred" style="background-image: url({{asset('frontend/assets/images/background/page-title-5.jpg')}});">
    <div class="auto-container">
        <div class="content-box clearfix">
            <h1>{{$bbread->category_name}}</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('index') }}">Home</a></li>
                <li>Category Wise Blog</li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Title-->


<!-- sidebar-page-container -->
<section class="sidebar-page-container blog-grid sec-pad-2">
    <div class="auto-container">
        <div class="row clearfix">

            <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                <div class="blog-grid-content">
                    <div class="row clearfix">

                        @foreach ($catwisepost as $item)
                            <div class="col-lg-6 col-md-6 col-sm-12 news-block">
                                <div class="news-block-one wow fadeInUp animated" data-wow-delay="00ms"
                                    data-wow-duration="1500ms">
                                    <div class="inner-box">
                                        <div class="image-box">
                                            <figure class="image"><a href="blog-details.html"><img
                                                        src="{{ asset($item->post_image) }}" alt=""></a>
                                            </figure>

                                        </div>
                                        <div class="lower-content">
                                            <h4><a
                                                    href="{{ route('blog.details', $item->id) }}">{{ $item->post_title }}</a>
                                            </h4>
                                            <ul class="post-info clearfix">
                                                <li class="author-box">
                                                    @if ($item->user_id == null)
                                                        <figure class="author-thumb"><img
                                                                src="{{ url('upload/no_image.jpg') }}" alt="">
                                                        </figure>

                                                        <h5><a href="#">No Name</a></h5>
                                                    @else
                                                        <figure class="author-thumb"><img
                                                                src="{{ !empty($item->user->photo) ? url('upload/admin_images/' . $item->user->photo) : url('upload/no_image.jpg') }}"
                                                                style="width: 40px;height: 40px;" alt="">
                                                        </figure>

                                                        <h5><a href="#">Admin</a></h5>
                                                    @endif
                                            </ul>
                                            <div class="text">
                                                <p>{{ $item->short_descp }}</p>
                                            </div>
                                            <div class="btn-box">
                                                <a href="{{ route('blog.details',$item->id) }}" class="theme-btn btn-two">See Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach



                    </div>
                    <div class="pagination-wrapper">
                        <ul class="pagination clearfix">
                            <li><a href="blog-1.html" class="current">1</a></li>
                            <li><a href="blog-1.html">2</a></li>
                            <li><a href="blog-1.html">3</a></li>
                            <li><a href="blog-1.html"><i class="fas fa-angle-right"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                <div class="blog-sidebar">

                    @php
                        $category = App\Models\BlogCategory::latest()->get();
                    @endphp

                    <div class="sidebar-widget category-widget">

                        <div class="widget-title">
                            <h4>Blog Category</h4>
                        </div>
                        <div class="widget-content">
                            <ul class="category-list clearfix">

                                @foreach ($category as $item)
                                    @php
                                        $post = App\Models\BlogPost::where('blogcat_id', $item->id)->get();
                                    @endphp
                                    <li><a
                                            href="{{route('cat.wise.post',$item->id)}}">{{ $item->category_name }}<span>({{ count($post) }})</span></a>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>

                    <div class="sidebar-widget social-widget">
                        <div class="widget-title">
                            <h4>Follow Us On</h4>
                        </div>
                        <ul class="social-links clearfix">
                            <li><a href="blog-1.html"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="blog-1.html"><i class="fab fa-google-plus-g"></i></a></li>
                            <li><a href="blog-1.html"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="blog-1.html"><i class="fab fa-linkedin-in"></i></a></li>
                            <li><a href="blog-1.html"><i class="fab fa-instagram"></i></a></li>
                        </ul>
                    </div>

                    @php
                        $bpost = App\Models\BlogPost::orderBy('post_title', 'ASC')
                            ->limit(3)
                            ->get();
                    @endphp

                    <div class="sidebar-widget post-widget">
                        <div class="widget-title">
                            <h4>Recent Posts</h4>
                        </div>
                        <div class="post-inner">

                            @foreach ($bpost as $item)
                                <div class="post">
                                    <figure class="post-thumb"><a href="blog-details.html"><img
                                                src="{{ asset($item->post_image) }}"
                                                style="width: 80px;height: 80px;" alt=""></a></figure>

                                    <h5><a href="{{ route('blog.details', $item->id) }}">{{ $item->post_title }}</a>
                                    </h5>

                                    <span class="post-date">{{ $item->created_at->format('M d,Y') }}</span>
                                </div>
                            @endforeach

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
