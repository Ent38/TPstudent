<header id="header-part">

    <div class="header-top d-none d-lg-block">
        <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <div class="logo">
                            </div>
                                <a href="/">
                                    <img src="{{ asset('josue/frontend/images/all-icon/map.png') }} " width="40" alt="Logo">
                                </a>
                            </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </div> <!-- header top -->



    <div class="navigation">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-9 col-sm-9 col-8">
                    <nav class="navbar navbar-expand-lg">
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item">
                                    <a class="{{ is_active('/') }}" href="{{ url('/') }}">@lang('Home')</a>
                                </li>
                                <li class="nav-item">
                                    <a class="{{ is_active('aboutUs.*') }}"
                                        href="{{ route('aboutUs.index') }}">@lang('About us')</a>
                                </li>

                            </ul>
                        </div>
                    </nav> <!-- nav -->
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-4">
                    <div class="right-icon text-right">
                        <ul>

                            @auth
                                <li><a href="{{ route('home') }}"><i class="fa fa-user"></i>
                                        @lang('Account')</a></li>
                            @endauth
                            @guest
                                <li><a href="#" data-toggle="modal" data-target="#globalloginModal"><i
                                            class="fa fa-signin"></i>
                                        @lang('Login')</a></li>
                            @endguest
                        </ul>
                    </div> <!-- right icon -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </div>




</header>

@livewire('global-login')
