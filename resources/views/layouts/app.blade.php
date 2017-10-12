<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DrawYourThoughts</title>

    <!-- Bootstrap -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/responsive-slider.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}"  rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}"  rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
<style>
    .navbar > .container .navbar-brand, .navbar > .container-fluid .navbar-brand {
        margin-left: -60px !important;
    }
    .btn-primary-cs {
        margin-bottom: 0px !important;
    }
    label {
        font-size: 14px;
        font-weight: 600;
        text-transform: uppercase;
        color: #000;
    }
    #notification_div {
        left: 185px;
        position: absolute;
        top: 83px;
        z-index: 9999;
    }
    @yield('style')
</style>
</head>
<body>
<header>
    <div class="container">
        <div class="row">
            <nav class="navbar navbar-default" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <div class="navbar-brand">
                            <a href="{{ url('/') }}"><h1>DrawYourThoughts</h1></a>
                        </div>
                    </div>
                    <div class="menu">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation">
                                <a href="{{ route('rssFeeds') }}" style="padding:4px;"><img src="{{ url('/').'/assets/img/feed-icon.png' }}" /></a>
                            </li>
                            <li role="presentation" {!! (Request::is('/') ? 'class="active"' : '') !!}>
                                <a href="{{ url('/') }}">Home</a>
                            </li>

                            <li role="presentation" {!! (Request::is('news') || Request::is('news/*') ? 'class="active"' : '') !!}>
                                <a href="{{ url('/news') }}">News</a>
                            </li>
                            {{--<li role="presentation" {!! (Request::is('contact') ? 'class="active"' : '') !!}>
                                <a href="{{ url('/contact') }}">Contact</a>
                            </li>--}}
                            <li role="presentation" {!! (Request::is('Newsstand') || Request::is('Newsstand/*') ? 'class="active"' : '') !!}>
                                <a href="{{ route('newsStand') }}">Newsstand</a>
                            </li>
                            @if (Route::has('login'))
                                @if (Auth::check())
                                    <li role="presentation" {!! (Request::is('posts') || Request::is('posts/*') ? 'class="active"' : '') !!}>
                                        <a href="{{ route('userPosts') }}">My Posts</a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#" class="logout-click">Logout</a>
                                    </li>
                                @else
                                    <li role="presentation" {!! (Request::is('login') ? 'class="active"' : '') !!}>
                                        <a href="{{ url('/login') }}">Login</a>
                                    </li>
                                    <li role="presentation" {!! (Request::is('register') ? 'class="active"' : '') !!}>
                                        <a href="{{ url('/register') }}">Register</a>
                                    </li>
                                @endif
                            @endif
                        </ul>
                    </div>
                    <div class="hide">
                        <form method="post" id="logoutForm" action="{{ URL::route('logout') }}">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</header>

@yield('content')

<!--start footer-->
<footer>
    <div class="container">
        <div class="row">
            <hr>
        </div>
    </div>
    <div id="sub-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="copyright">
                        <p>
                            <span>&copy; Shine, All right reserved.</span>
                        </p>
                        <div class="credits">
                            <a href="#">Bootstrap Themes</a> by <a href="#">shine</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    {{--<ul class="social-network">
                        <li><a href="#" data-placement="top" title="Facebook"><i class="fa fa-facebook fa-1x"></i></a></li>
                        <li><a href="#" data-placement="top" title="Twitter"><i class="fa fa-twitter fa-1x"></i></a></li>
                        <li><a href="#" data-placement="top" title="Linkedin"><i class="fa fa-linkedin fa-1x"></i></a></li>
                        <li><a href="#" data-placement="top" title="Pinterest"><i class="fa fa-pinterest fa-1x"></i></a></li>
                        <li><a href="#" data-placement="top" title="Google plus"><i class="fa fa-google-plus fa-1x"></i></a></li>
                    </ul>--}}
                </div>
            </div>
        </div>
    </div>
</footer>
<!--end footer-->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{ asset('assets/js/jquery.js') }}"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/responsive-slider.js') }}"></script>
<script src="{{ asset('assets/js/wow.min.js') }}"></script>
@yield('script')
<script>
    wow = new WOW({}).init();
    $(document).on('click', '.logout-click', function (e) {
        $("#logoutForm").submit();
        e.preventDefault();
    });
    setTimeout(function () {
        $("#notification_div").remove();
    }, 4000);
</script>
</body>
</html>