@extends('frontend.frontend_dashboard')
@section('main')
@section('title')
    Home | All Type
@endsection

<!--Page Title-->
<section class="page-title-two bg-color-1 centred">
    <div class="pattern-layer">
        <div class="pattern-1" style="background-image: url({{ asset('frontend/assets/images/shape/shape-9.png') }});">
        </div>
        <div class="pattern-2" style="background-image: url({{ asset('frontend/assets/images/shape/shape-10.png)') }};">
        </div>
    </div>
    <div class="auto-container">
        <div class="content-box clearfix">
            <h1>Property Type</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('index') }}">Home</a></li>
                <li>Property Type</li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Title-->


<!-- category-section -->
<section class="category-section category-page centred mr-0 pt-120 pb-90">
    <div class="auto-container">
        <div class="inner-container wow slideInLeft animated" data-wow-delay="00ms" data-wow-duration="1500ms">
            <ul class="category-list clearfix">

                @foreach ($type as $item)
                    @php
                        $property = App\Models\Property::where('type_id', $item->id)
                            ->where('status', 1)
                            ->get();
                    @endphp

                    <li>
                        <div class="category-block-one">
                            <div class="inner-box">
                                <div class="icon-box"><i class="{{ $item->type_icon }}"></i></div>
                                <h5><a href="{{route('type.wise.property',$item->id)}}">{{ $item->type_name }}</a></h5>
                                <span>{{ count($property) }}</span>
                            </div>
                        </div>
                    </li>
                @endforeach


            </ul>
        </div>
    </div>
</section>
<!-- category-section end -->

<!-- subscribe-section -->
@include('frontend.home.subscribe')
<!-- subscribe-section end -->
@endsection
