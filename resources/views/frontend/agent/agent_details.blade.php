@extends('frontend.frontend_dashboard')
@section('main')
@section('title')
    Agent Details
@endsection

<!--Page Title-->
<section class="page-title centred" style="background-image: url(assets/images/background/page-title.jpg);">
    <div class="auto-container">
        <div class="content-box clearfix">
            <h1>Agent Details</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('index') }}">Home</a></li>
                <li>{{ $agent->name }}</li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Title-->


<!-- agent-details -->
<section class="agent-details">
    <div class="auto-container">
        <div class="agent-details-content">
            <div class="agents-block-one">
                <div class="inner-box mr-0">
                    <figure class="image-box"><img
                            src="{{ !empty($agent->photo) ? url('upload/agent_images/' . $agent->photo) : url('upload/no_image.jpg') }}"
                            style="width: 270px; height: 320px;" alt=""></figure>
                    <div class="content-box">
                        <div class="upper clearfix">
                            <div class="title-inner pull-left">
                                <h4>{{ $agent->name }}</h4>
                                <span class="designation">{{ $agent->address }}</span>
                            </div>
                            <ul class="social-list pull-right clearfix">
                                <li><a href="agents-details.html"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="agents-details.html"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="agents-details.html"><i class="fab fa-linkedin-in"></i></a></li>
                            </ul>
                        </div>
                        <div class="text">
                            <p>{{ $agent->description }}</p>
                        </div>
                        <ul class="info clearfix mr-0">
                            <li><i class="fab fa fa-envelope"></i><a href="#">{{ $agent->email }}</a></li>
                            <li><i class="fab fa fa-phone"></i><a href="#">{{ $agent->phone }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- agent-details end -->


<!-- agents-page-section -->
<section class="agents-page-section agent-details-page">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                <div class="agents-content-side tabs-box">
                    <div class="group-title">
                        <h3>Property By {{ $agent->name }}</h3>
                    </div>
                    <div class="item-shorting clearfix">

                    </div>

                    <div class="tabs-content">
                        <div class="tab active-tab" id="tab-1">
                            <div class="wrapper list">
                                <div class="deals-list-content list-item">

                                    @foreach ($property as $item)
                                        <div class="deals-block-one">
                                            <div class="inner-box">
                                                <div class="image-box">

                                                    <figure class="image"><img src="{{ asset($item->image) }}"
                                                            style="width: 300px; height:350px;" alt=""></figure>

                                                    <div class="batch"><i class="icon-11"></i></div>

                                                    <span class="category">{{ $item['type']['type_name'] }}</span>

                                                    <div class="buy-btn"><a href="#">For
                                                            {{ $item->property_status }}</a></div>
                                                </div>
                                                <div class="lower-content">
                                                    <div class="title-text">
                                                        <h4><a href="#">{{ $item->property_name }}</a>
                                                        </h4>
                                                    </div>
                                                    <div class="price-box clearfix">
                                                        <div class="price-info pull-left">
                                                            <h6>Start From</h6>
                                                            <h4>${{ $item->min_price }}</h4>
                                                        </div>

                                                    </div>
                                                    <p>{{ $item->short_descp }}</p>
                                                    <ul class="more-details clearfix">
                                                        <li><i class="icon-14"></i>{{ $item->bedroom }} Beds</li>
                                                        <li><i class="icon-15"></i>{{ $item->bathroom }} Baths</li>
                                                        <li><i class="icon-16"></i>{{ $item->property_size }} Sq Ft
                                                        </li>
                                                    </ul>
                                                    <div class="other-info-box clearfix">
                                                        <div class="btn-box pull-left"><a
                                                                href="{{ url('property/details/' . $item->id . '/' . $item->property_slug) }}"
                                                                class="theme-btn btn-two">See Details</a></div>
                                                        <ul class="other-option pull-right clearfix">
                                                            <li><a href="property-details.html"><i
                                                                        class="icon-12"></i></a></li>
                                                            <li><a href="property-details.html"><i
                                                                        class="icon-13"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                <div class="default-sidebar agent-sidebar">
                    <div class="agents-contact sidebar-widget">
                        <div class="widget-title">
                            <h5>Contact To {{ $agent->name }}</h5>
                        </div>

                        @auth
                            <div class="form-inner">

                                @php
                                    $id = Auth::user()->id;
                                    $userData = App\Models\User::find($id);
                                @endphp

                                <form action="{{ route('agent.property.message') }}" method="post" class="default-form">

                                    @csrf

                                    <input type="hidden" name="agent_id" value="{{ $agent->id }}">


                                    <div class="form-group">
                                        <input type="text" value="{{ $userData->name }}" name="msg_name"
                                            placeholder="Your name" autocomplete="off" required="">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" value="{{ $userData->email }}" autocomplete="off"
                                            name="msg_email" placeholder="Your Email" required="">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" value="{{ $userData->phone }}" autocomplete="off"
                                            name="msg_phone" placeholder="Phone" required="">
                                    </div>
                                    <div class="form-group">
                                        <textarea name="message" placeholder="Message"></textarea>
                                    </div>
                                    <div class="form-group message-btn">
                                        <button type="submit" class="theme-btn btn-one">Send Message</button>
                                    </div>
                                </form>

                            </div>
                        @else
                            <div class="form-inner">

                                <form action="{{ route('agent.property.message') }}" method="post"
                                    class="default-form">

                                    @csrf

                                    <input type="hidden" name="agent_id" value="{{ $agent->id }}">

                                    <div class="form-group">
                                        <input type="text" name="msg_name" placeholder="Your name" autocomplete="off"
                                            required="">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" autocomplete="off" name="msg_email"
                                            placeholder="Your Email" required="">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" autocomplete="off" name="msg_phone" placeholder="Phone"
                                            required="">
                                    </div>
                                    <div class="form-group">
                                        <textarea name="message" placeholder="Message"></textarea>
                                    </div>
                                    <div class="form-group message-btn">
                                        <button type="submit" class="theme-btn btn-one">Send Message</button>
                                    </div>
                                </form>

                            </div>
                        @endauth
                        
                    </div>

                    <div class="category-widget sidebar-widget">
                        <div class="widget-title">
                            <h5>Status Of Property</h5>
                        </div>
                        <ul class="category-list clearfix">
                            @php
                                $rent = App\Models\Property::where('property_status', 'Rent')
                                    ->where('status', 1)
                                    ->get();
                            @endphp

                            <li><a href="#">For Rent <span>({{ count($rent) }})</span></a></li>

                            @php
                                $buy = App\Models\Property::where('property_status', 'Buy')
                                    ->where('status', 1)
                                    ->get();
                            @endphp

                            <li><a href="#">For Sale <span>({{ count($buy) }})</span></a></li>
                        </ul>
                    </div>

                    <div class="featured-widget sidebar-widget">
                        <div class="widget-title">
                            <h5>Featured Properties</h5>
                        </div>

                        @php
                            $property = App\Models\Property::where('featured', 1)
                                ->where('status', 1)
                                ->limit(3)
                                ->get();
                        @endphp

                        <div class="single-item-carousel owl-carousel owl-theme owl-nav-none dots-style-one">

                            @foreach ($property as $item)
                                <div class="feature-block-one">
                                    <div class="inner-box">

                                        <div class="image-box">
                                            <figure class="image"><img src="{{ asset($item->image) }}"
                                                    style="width: 370px; height: 250px;" alt=""></figure>
                                            <div class="batch"><i class="icon-11"></i></div>
                                            <span class="category">Featured</span>
                                        </div>

                                        <div class="lower-content">

                                            <div class="title-text">
                                                <h4><a
                                                        href="{{ url('property/details/' . $item->id . '/' . $item->property_slug) }}">{{ $item->property_name }}</a>
                                                </h4>
                                            </div>

                                            <div class="price-box clearfix">
                                                <div class="price-info">
                                                    <h6>Start From</h6>
                                                    <h4>${{ $item->min_price }}</h4>
                                                </div>
                                            </div>
                                            {{-- <p>{{$item->short_descp}}</p> --}}
                                            <div class="btn-box"><a
                                                    href="{{ url('property/details/' . $item->id . '/' . $item->property_slug) }}"
                                                    class="theme-btn btn-two">See Details</a></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- agents-page-section end -->


<!-- subscribe-section -->
@include('frontend.home.subscribe')
<!-- subscribe-section end -->

@endsection
