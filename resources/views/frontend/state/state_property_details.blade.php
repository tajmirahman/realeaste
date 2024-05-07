@extends('frontend.frontend_dashboard')
@section('main')
    @section('title')
        State Property
    @endsection

    <!--Page Title-->
<section class="page-title-two bg-color-1 centred">
    <div class="pattern-layer">
        <div class="pattern-1" style="background-image: url(assets/images/shape/shape-9.png);"></div>
        <div class="pattern-2" style="background-image: url(assets/images/shape/shape-10.png);"></div>
    </div>
    <div class="auto-container">
        <div class="content-box clearfix">
            <h1>{{$state_bread->state_name}}</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{route('index')}}">Home</a></li>
                <li>{{$state_bread->state_name}}</li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Title-->


<!-- property-page-section -->
<section class="property-page-section property-grid">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                <div class="default-sidebar property-sidebar">
                    <div class="filter-widget sidebar-widget">
                        <div class="widget-title">
                            <h5>Property</h5>
                        </div>
                        <div class="widget-content">
                            <div class="select-box">
                                <select class="wide">
                                    <option data-display="All Type">All Type</option>
                                    <option value="1">Villa</option>
                                    <option value="2">Commercial</option>
                                    <option value="3">Residential</option>
                                </select>
                            </div>
                            <div class="select-box">
                                <select class="wide">
                                    <option data-display="Select Location">Select Location</option>
                                    <option value="1">New York</option>
                                    <option value="2">California</option>
                                    <option value="3">London</option>
                                    <option value="4">Maxico</option>
                                </select>
                            </div>
                            <div class="select-box">
                                <select class="wide">
                                    <option data-display="This Area Only">This Area Only</option>
                                    <option value="1">New York</option>
                                    <option value="2">California</option>
                                    <option value="3">London</option>
                                    <option value="4">Maxico</option>
                                </select>
                            </div>
                            <div class="select-box">
                                <select class="wide">
                                    <option data-display="All Type">Max Rooms</option>
                                    <option value="1">2+ Rooms</option>
                                    <option value="2">3+ Rooms</option>
                                    <option value="3">4+ Rooms</option>
                                    <option value="4">5+ Rooms</option>
                                </select>
                            </div>
                            <div class="select-box">
                                <select class="wide">
                                    <option data-display="Most Popular">Most Popular</option>
                                    <option value="1">Villa</option>
                                    <option value="2">Commercial</option>
                                    <option value="3">Residential</option>
                                </select>
                            </div>
                            <div class="select-box">
                                <select class="wide">
                                    <option data-display="All Type">Select Floor</option>
                                    <option value="1">2x Floor</option>
                                    <option value="2">3x Floor</option>
                                    <option value="3">4x Floor</option>
                                </select>
                            </div>
                            <div class="filter-btn">
                                <button type="submit" class="theme-btn btn-one"><i
                                        class="fas fa-filter"></i>&nbsp;Filter</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                <div class="property-content-side">
                    <div class="item-shorting clearfix">
                        <div class="left-column pull-left">
                            <h5>Search Reasults: <span>Showing 1-5 of 20 Listings</span></h5>
                        </div>

                    </div>
                    <div class="wrapper grid">

                        <div class="deals-grid-content grid-item">

                            <div class="row clearfix">

                                @foreach ($property as $item)
                                    <div class="col-lg-6 col-md-6 col-sm-12 feature-block">
                                        <div class="feature-block-one wow fadeInUp animated" data-wow-delay="00ms"
                                            data-wow-duration="1500ms">
                                            <div class="inner-box">
                                                <div class="image-box">
                                                    <figure class="image"><img src="{{ asset($item->image) }}"
                                                            alt="">
                                                    </figure>
                                                    <div class="batch"><i class="icon-11"></i></div>
                                                    <span class="category">{{ $item['type']['type_name'] }}</span>
                                                </div>
                                                <div class="lower-content">
                                                    <div class="author-info clearfix">
                                                        <div class="author pull-left">

                                                            @if ($item->agent_id == null)
                                                                <figure class="author-thumb"><img
                                                                        src="{{ url('upload/no_image.jpg') }}"
                                                                        alt="">
                                                                </figure>
                                                                <h6>Admin</h6>
                                                            @else
                                                                <figure class="author-thumb"><img
                                                                        src="{{ !empty($item->user->photo) ? url('upload/agent_images/' . $item->user->photo) : url('upload/no_image.jpg') }}"
                                                                        alt="">
                                                                </figure>
                                                                <h6>{{ $item['user']['name'] }}</h6>
                                                            @endif

                                                        </div>
                                                        <div class="buy-btn pull-right"><a href="#">For
                                                                {{ $item->property_status }}</a>
                                                        </div>
                                                    </div>
                                                    <div class="title-text">
                                                        <h4><a
                                                                href="{{ url('property/details/' . $item->id . '/' . $item->property_slug) }}">{{ $item->property_name }}</a>
                                                        </h4>
                                                    </div>
                                                    <div class="price-box clearfix">
                                                        <div class="price-info pull-left">
                                                            <h6>Start From</h6>
                                                            <h4>${{ $item->min_price }}</h4>
                                                        </div>
                                                        <ul class="other-option pull-right clearfix">
                                                            <li><a href="property-details.html"><i
                                                                        class="icon-12"></i></a></li>
                                                            <li><a href="property-details.html"><i
                                                                        class="icon-13"></i></a></li>
                                                        </ul>
                                                    </div>
                                                    <p>{{ $item->short_descp }}</p>
                                                    <ul class="more-details clearfix">
                                                        <li><i class="icon-14"></i>{{ $item->bedroom }} Beds</li>
                                                        <li><i class="icon-15"></i>{{ $item->bathroom }} Baths</li>
                                                        <li><i class="icon-16"></i>{{ $item->property_size }} Sq Ft
                                                        </li>
                                                    </ul>
                                                    <div class="btn-box"><a
                                                            href="{{ url('property/details/' . $item->id . '/' . $item->property_slug) }}"
                                                            class="theme-btn btn-two">See Details</a></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                    <div class="pagination-wrapper">
                        <ul class="pagination clearfix">
                            <li><a href="property-grid.html" class="current">1</a></li>
                            <li><a href="property-grid.html">2</a></li>
                            <li><a href="property-grid.html">3</a></li>
                            <li><a href="property-grid.html"><i class="fas fa-angle-right"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- property-page-section end -->


<!-- subscribe-section -->
@include('frontend.home.subscribe')
<!-- subscribe-section end -->

@endsection