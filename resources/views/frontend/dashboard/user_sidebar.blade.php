@php
    $id = Auth::user()->id;
    $profileData = App\Models\User::find($id);
@endphp

<div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
    <div class="blog-sidebar">
        <div class="sidebar-widget post-widget">
            
            <div class="post-inner">
                <div class="post">
                    <figure class="post-thumb"><a href="blog-details.html">
                            <img src="{{!empty($profileData->photo) ? url('upload/user_images/'.$profileData->photo) : url('upload/no_image.jpg')}}" alt=""></a></figure>
                    <h5><a href="#">{{$profileData->name }}</a></h5>
                    <p>{{$profileData->email}}</p>
                </div>
            </div>
        </div>

        <div class="sidebar-widget category-widget">
            <div class="widget-title">
                <h4>Category</h4>
            </div>
            <div class="widget-content">
                <ul class="category-list ">

                    <li class="current"> <a href="{{route('dashboard')}}"><i class="fab fa fa-envelope "></i>
                            Dashboard </a></li>


                    <li><a href="{{route('user.profile')}}"><i class="fa fa-cog" aria-hidden="true"></i>
                            Profile</a></li>

                    <li><a href="blog-details.html"><i class="fa fa-credit-card" aria-hidden="true"></i> Buy
                            credits<span class="badge badge-info">( 10 credits)</span></a></li>
                    <li><a href="blog-details.html"><i class="fa fa-list-alt" aria-hidden="true"></i></i>
                            Properties </a></li>
                    <li><a href="blog-details.html"><i class="fa fa-indent" aria-hidden="true"></i> Add a
                            Property </a></li>
                    <li><a href="{{route('user.password')}}"><i class="fa fa-key" aria-hidden="true"></i> Security
                        </a></li>
                    <li><a href="{{ route('user.logout') }}"><i class="fa fa-chevron-circle-up" aria-hidden="true"></i>
                            Logout </a></li>
                </ul>
            </div>
        </div>

    </div>
</div>
