<header id="header" role="banner">
{{--    <div class="collapse navbar-white special-for-mobile bg-lightgrey" id="header-search-form">--}}
{{--        <div class="container">--}}
{{--            <form name="faqs-form" action="{{ asset('/faqs/search') }}" class="navbar-form animated fadeInDown" autocomplete="off" role="search">--}}
{{--                <input type="search" id="search" name="search" class="form-control" placeholder="Got a Question?">--}}
{{--                <button type="submit" class="btn-circle" title="Search"><i class="fa fa-search"></i></button>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </div>--}}
    <nav class="navbar navbar-white animated-dropdown ttb-dropdown" role="navigation">
        <div class="navbar-inner sticky-menu">
            <div class="container-custom">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle btn-circle pull-right collapsed"
                            data-toggle="collapse" data-target="#main-navbar-container">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                    </button>

                    <a class="navbar-logo" href="{{ asset('/') }}" title="Home Dream Builder">
{{--                        <img src="{{ asset('images/cml/logo.jpg') }}" alt="Home Dream Builder"/>--}}
                    </a>

{{--                    <button type="button" class="navbar-btn btn-icon btn-circle pull-right last visible-xs"--}}
{{--                            data-toggle="collapse" data-target="#header-search-form">--}}
{{--                        <i class="fa fa-search"></i>--}}
{{--                    </button>--}}
                </div>
                <div class="collapse navbar-collapse" id="main-navbar-container">
{{--                    <button type="button" class="navbar-btn btn-icon btn-circle navbar-right last hidden-xs"--}}
{{--                            data-toggle="collapse" data-target="#header-search-form">--}}
{{--                        <i class="fa fa-search"></i>--}}
{{--                    </button>--}}

                    <ul class="nav navbar-nav pull-right">
                        <li><a href="{{ asset('/ready-to-dream') }}">Ready to Dream</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>