@php
    $blog = App\Models\BlogPost::latest()
        ->limit(3)
        ->get();
@endphp

<section class="news-section sec-pad">
    <div class="auto-container">
        <div class="sec-title centred">
            <h5>News & Article</h5>
            <h2>Stay Update With Realshed</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing sed do eiusmod tempor incididunt <br />labore
                dolore magna aliqua enim.</p>
        </div>
        <div class="row clearfix">

            @foreach ($blog as $item)
                <div class="col-lg-4 col-md-6 col-sm-12 news-block">
                    <div class="news-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image"><a href="blog-details.html"><img
                                            src="{{ asset($item->post_image) }}" style="width:370px; height: 250px;"
                                            alt=""></a>
                                </figure>
                                <span class="category">New</span>
                            </div>
                            <div class="lower-content">
                                <h4><a href="{{ route('blog.details',$item->id) }}">{{ $item->post_title }}</a></h4>
                                <ul class="post-info clearfix">
                                    <li class="author-box">

                                        @if ($item->user_id == null)
                                            <figure class="author-thumb"><img src="{{ url('upload/no_image.jpg') }}"
                                                    alt="">
                                            </figure>

                                            <h5><a href="#">No Name</a></h5>
                                        @else
                                            <figure class="author-thumb"><img
                                                    src="{{ !empty($item->user->photo) ? url('upload/admin_images/' . $item->user->photo) : url('upload/no_image.jpg') }}"
                                                    style="width: 40px;height: 40px;" alt="">
                                            </figure>

                                            <h5><a href="#">Admin</a></h5>
                                        @endif

                                    </li>
                                    <li>{{ $item->created_at->format('M d,Y') }}</li>
                                </ul>
                                <div class="text">
                                    <p>{{ $item->short_descp }}</p>
                                </div>
                                <div class="btn-box">
                                    <a href="{{ route('blog.details',$item->id) }}"
                                        class="theme-btn btn-two">See Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>
    </div>
</section>
