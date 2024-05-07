@php
    $site = App\Models\SiteSetting::find(1);
@endphp

<header class="main-header">
    <!-- header-top -->
    <div class="header-top">
        <div class="top-inner clearfix">
            <div class="left-column pull-left">
                <ul class="info clearfix">
                    <li><i class="far fa-map-marker-alt"></i>{{$site->address}}</li>
                    <li><i class="far fa-clock"></i>{{$site->open_time}}</li>
                    <li><i class="far fa-phone"></i><a href="tel:2512353256">{{$site->mobile}}</a></li>
                </ul>
            </div>
            <div class="right-column pull-right">
                <ul class="social-links clearfix">
                    <li><a href="{{$site->facebook}}" target="blank"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="{{$site->facebook}}" target="blabk"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="{{$site->facebook}}" target="blabk"><i class="fab fa-pinterest-p"></i></a></li>
                    <li><a href="{{$site->facebook}}" target="blabk"><i class="fab fa-google-plus-g"></i></a></li>
                    <li><a href="{{$site->facebook}}" target="blabk"><i class="fab fa-vimeo-v"></i></a></li>
                </ul>
                @auth
                    <div class="sign-box">
                        <a href="{{ route('dashboard') }}"><i class="fas fa-user"></i>Dashboard</a>
                    </div>
                    <div class="sign-box">
                        <a href="{{ route('user.logout') }}"><i class="fas fa-user"></i>Logout</a>
                    </div>
                @else
                    <div class="sign-box">
                        <a href="{{ route('login') }}"><i class="fas fa-user"></i>Sign In</a>
                    </div>

                @endauth
            </div>
        </div>
    </div>
    <!-- header-lower -->
    <div class="header-lower">
        <div class="outer-box">
            <div class="main-box">
                <div class="logo-box">
                    <figure class="logo"><a href="index.html"><img
                                src="{{ asset('frontend/assets/images/logo.png') }}" alt=""></a>
                    </figure>
                </div>
                <div class="menu-area clearfix">
                    <!--Mobile Navigation Toggler-->
                    <div class="mobile-nav-toggler">
                        <i class="icon-bar"></i>
                        <i class="icon-bar"></i>
                        <i class="icon-bar"></i>
                    </div>
                    <nav class="main-menu navbar-expand-md navbar-light">
                        <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                            <ul class="navigation clearfix">

                                <li class="{{ Route::is('index') ? 'current' : '' }}"><a
                                        href="{{ route('index') }}"><span>Home</span></a>
                                </li>

                                <li class="{{ Route::is('index') ? 'current' : '' }}"><a
                                        href="{{ route('index') }}"><span>About</span></a>
                                </li>

                                <li class="dropdown {{ Route::is('frontend.all.property') ? 'current' : '' }}"><a
                                        href="{{ route('frontend.all.property') }}"><span>Property</span></a>
                                    <ul>
                                        <li><a href="property-list.html">Ror Rent</a></li>
                                        <li><a href="property-grid.html">Ror Buy</a></li>
                                    </ul>
                                </li>

                                <li class="dropdown {{ Route::is('agent.login') ? 'current' : '' }}"><a
                                        href="{{ route('agent.login') }}"><span>Agent</span></a>
                                    <ul>
                                        <li><a href="{{ route('agent.login') }}">Sign In</a></li>
                                        <li><a href="{{ route('agent.login') }}">Sign Up</a></li>
                                    </ul>
                                </li>

                                <li class="{{ Route::is('all.blog') ? 'current' : '' }}"><a
                                        href="{{ route('all.blog') }}"><span>Blog</span></a>
                                </li>

                                <li><a href="contact.html"><span>Contact</span></a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="btn-box">
                    <a href="{{ route('login') }}" class="theme-btn btn-one">Sign In</a>
                </div>
            </div>
        </div>
    </div>

    <!--sticky Header-->
    <div class="sticky-header">
        <div class="outer-box">
            <div class="main-box">
                <div class="logo-box">
                    <figure class="logo"><a href="index.html"><img
                                src="{{ asset('frontend/assets/images/logo.png') }}" alt=""></a>
                    </figure>
                </div>
                <div class="menu-area clearfix">
                    <nav class="main-menu clearfix">
                        <!--Keep This Empty / Menu will come through Javascript-->
                    </nav>
                </div>
                <div class="btn-box">
                    <a href="{{ route('login') }}" class="theme-btn btn-one">Sign In</a>
                </div>
            </div>
        </div>
    </div>
</header>
