@php
    $type = App\Models\Type::orderBy('type_name','ASC')->limit(5)->get();
@endphp

<section class="category-section centred">
    <div class="auto-container">
        <div class="inner-container wow slideInLeft animated" data-wow-delay="00ms" data-wow-duration="1500ms">
            <ul class="category-list clearfix">

                @foreach ($type as $item)

                @php
                    $property = App\Models\Property::where('type_id',$item->id)->where('status',1)->get();
                @endphp

                <li>
                    <div class="category-block-one">
                        <div class="inner-box">
                            <div class="icon-box"><i class="{{$item->type_icon}}"></i></div>
                            <h5><a href="property-details.html">{{$item->type_name}}</a></h5>
                            <span>{{count($property)}}</span>
                        </div>
                    </div>
                </li>
                @endforeach

            </ul>
            <div class="more-btn"><a href="{{route('type.all')}}" class="theme-btn btn-one">All Type</a>
            </div>
        </div>
    </div>
</section>