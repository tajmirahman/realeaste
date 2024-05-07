@extends('frontend.frontend_dashboard')
@section('main')
@section('title')
    Blog Details
@endsection

<!--Page Title-->
<section class="page-title centred"
    style="background-image: url({{ asset('frontend/assets/images/background/page-title-5.jpg') }});">
    <div class="auto-container">
        <div class="content-box clearfix">
            <h1>{{ $post->post_title }}</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('index') }}">Home</a></li>
                <li>Blog Details</li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Title-->


<!-- sidebar-page-container -->
<section class="sidebar-page-container blog-details sec-pad-2">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                <div class="blog-details-content">
                    <div class="news-block-one">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image"><img src="{{ asset($post->post_image) }}" alt="">
                                </figure>

                            </div>
                            <div class="lower-content">
                                <h3>{{ $post->post_title }}</h3>
                                <ul class="post-info clearfix">

                                    <li class="author-box">

                                        @if ($post->user_id == null)
                                            <figure class="author-thumb"><img src="{{ url('upload/no_image.jpg') }}"
                                                    alt="">
                                            </figure>

                                            <h5><a href="#">No Name</a></h5>
                                        @else
                                            <figure class="author-thumb"><img
                                                    src="{{ !empty($post->user->photo) ? url('upload/admin_images/' . $post->user->photo) : url('upload/no_image.jpg') }}"
                                                    style="width: 40px;height: 40px;" alt="">
                                            </figure>

                                            <h5><a href="#">Admin</a></h5>
                                        @endif

                                    </li>
                                    <li>{{ $post->created_at->format('M d,Y') }}</li>

                                </ul>
                                <div class="text">
                                    <p>{!! $post->long_descp !!}</p>
                                </div>
                                <div class="post-tags">
                                    <ul class="tags-list clearfix">
                                        <li>
                                            <h5>Tags:</h5>
                                        </li>
                                        @foreach ($tagpost as $tpost)
                                            <li><a href="#">{{ ucwords($tpost) }}</a></ @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    @php
                        $ucomment = App\Models\Comment::where('blog_id', $post->id)
                            ->where('parent_id', null)
                            ->where('status', 1)
                            ->get();
                    @endphp

                    {{-- Comment  --}}

                    <div class="comments-area">
                        <div class="group-title">
                            <h4>Comments</h4>
                        </div>
                        @foreach ($ucomment as $ucom)
                            <div class="comment-box">
                                <div class="comment">
                                    <figure class="thumb-box">
                                        <img src="{{ asset('upload/no_image.jpg') }}" alt="">
                                    </figure>
                                    <div class="comment-inner">
                                        <div class="comment-info clearfix">
                                            <h5>{{ $ucom->user->name }}</h5>
                                            <span>{{ $ucom->created_at->format('M d,Y') }}</span>
                                        </div>
                                        <div class="text">
                                            <p>{{ $ucom->message }}</p>
                                            <a href="blog-details.html"><i class="fas fa-share"></i>Reply</a>
                                        </div>
                                    </div>
                                </div>
                                @php
                                    $replys = App\Models\Comment::Where('parent_id', $ucom->id)
                                        ->where('status', 1)
                                        ->get();
                                @endphp
                                @foreach ($replys as $reply)
                                    <div class="comment replay-comment">
                                        <figure class="thumb-box">
                                            <img src="{{ asset('upload/no_image.jpg') }}" alt="">
                                        </figure>
                                        <div class="comment-inner">
                                            <div class="comment-info clearfix">
                                                <h5>Admin</h5>
                                                <span>{{ $reply->created_at->format('M d,Y') }}</span>
                                            </div>
                                            <div class="text">
                                                <p>{{ $reply->message }}</p>
                                                <a href="blog-details.html"><i class="fas fa-share"></i>Reply</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>

                    {{-- Comment  --}}
                    <div class="comments-form-area">
                        <div class="group-title">
                            <h4>Leave a Comment</h4>
                        </div>

                        @auth
                            <form action="{{ route('store.comment') }}" method="post" class="comment-form default-form">
                                <div class="row">

                                    <input type="hidden" name="blog_id" value="{{ $post->id }}">

                                    @csrf

                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <input type="text" autocomplete="off" name="subject" placeholder="Subject"
                                            required="">
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <textarea name="message" autocomplete="off" placeholder="Your message"></textarea>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn">
                                        <button type="submit" class="theme-btn btn-one">Submit Now</button>
                                    </div>

                                </div>
                            </form>
                        @else
                            <h6>Comment At this blog Please Login First. <a href="{{ route('login') }}"> Login Here</a>
                            </h6>
                        @endauth

                    </div>
                    {{-- Comment  --}}

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
                                            href="{{ route('cat.wise.post', $item->id) }}">{{ $item->category_name }}<span>({{ count($post) }})</span></a>
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
