@php
$colleges = \App\Models\College\College::all();
$courses = \App\Models\Course\Course::all();

@endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" type="image/png" sizes="16x16" href="">
    <title>Akedu Student Connect</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Styles -->
    <link href="{{asset('assets/aos/dist/aos.css')}}" rel="stylesheet">
    <link href="{{asset('assets/bootstrap-touch-slider/bootstrap-touch-slider.css')}}" rel="stylesheet">
    <link href="{{asset('assets/owl.carousel/dist/assets/owl.theme.green.css')}}" rel="stylesheet">
    <link href="{{asset('css/demo.css')}}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/yourstyle.css')}}" rel="stylesheet">

    @yield('head')
</head>

<body class="">
<div class="preloader">
    <div class="loader">
        <div class="loader__figure"></div>
        <p class="loader__label">Akedu Student Connect</p>
    </div>
</div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Top header  -->
        <!-- ============================================================== -->
        <div class="topbar">
            <!-- ============================================================== -->
            <!-- Header 2  -->
            <!-- ============================================================== -->
            <div class="header2">
                <div class="container po-relative">
                    <!-- Header 1 code -->
                    <nav class="navbar navbar-expand-md h2-nav">
                        <a class="navbar-brand" href="{{route('home')}}">
                            {{--<img src="" alt="Akedu Student Connect" />--}}
                        </a>
                        <button class="navbar-toggler text-white" type="button" data-toggle="collapse" data-target="#header2" aria-controls="header2" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="ti-menu"></span>
                        </button>
                        <div class="collapse navbar-collapse hover-dropdown" id="header2">
                            <ul class="navbar-nav">
                                <li class="nav-item dropdown mega-dropdown active">
                                    <a class="nav-link dropdown-toggle" href="{{route('home')}}" id="h6-mega-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Colleges <i class="fa fa-angle-down m-l-5"></i>
                                    </a>
                                    <div class="dropdown-menu b-none font-14 animated fadeInUp" aria-labelledby="h6-mega-dropdown">
                                        <div class="row">
                                            <div class="col-lg-3 inside-bg hidden-md-down">
                                                <div class="bg-img" style="background-image:url({{asset('images/mega-bg.jpg')}})">
                                                    <h3 class="text-white font-light">Colleges</h3> </div>
                                            </div>
                                            <div class="col-lg-2 col-md-6">
                                                <ul class="list-style-none">
                                                    <li><h6>Featured</h6></li>
                                                    @foreach($colleges->random(5) as $college)
                                                        <li><a href="{{route('college.show', $college->id)}}" >{{$college->college_name}}</a></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div class="col-lg-2 col-md-6">
                                                <ul class="list-style-none">
                                                    <li><h6>Top rated</h6></li>
                                                    @foreach($colleges->random(5) as $college)
                                                        <li><a href="{{route('college.show', $college->id)}}" >{{$college->college_name}}</a></li>
                                                    @endforeach                                                </ul>
                                            </div>
                                            <div class="col-lg-2 col-md-6">
                                                <ul class="list-style-none">
                                                    <li><h6>Recent Additions</h6></li>
                                                    @foreach($colleges->random(5) as $college)
                                                        <li><a href="{{route('college.show', $college->id)}}" >{{$college->college_name}}</a></li>
                                                    @endforeach                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item dropdown mega-dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="h6-mega-dropdown1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Courses <i class="fa fa-angle-down m-l-5"></i>
                                    </a>
                                    <div class="dropdown-menu b-none font-14 animated fadeInUp" aria-labelledby="h6-mega-dropdown1">
                                        <div class="row">
                                            <div class="col-lg-4 inside-bg hidden-md-down">
                                                <div class="bg-img" style="background-image:url({{asset('images/mega-bg2.jpg')}})">
                                                    <h3 class="text-white font-light">Courses</h3> </div>
                                            </div>
                                            <div class="col-lg-2 col-md-6">
                                                <ul class="list-style-none">
                                                    <li><h6>Featured</h6></li>
                                                    @foreach($courses->random(5) as $course)
                                                        <li><a href="{{route('course.show', $course->id)}}" >{{$course->course_name}}</a></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div class="col-lg-2 col-md-6">
                                                <ul class="list-style-none">
                                                    <li><h6>Top rated</h6></li>
                                                    @foreach($courses->random(5) as $course)
                                                        <li><a href="{{route('course.show', $course->id)}}" >{{$course->course_name}}</a></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div class="col-lg-2 col-md-6">
                                                <ul class="list-style-none">
                                                    <li><h6>Recent Additions</h6></li>
                                                    @foreach($courses->random(5) as $course)
                                                        <li><a href="{{route('course.show', $course->id)}}" >{{$course->course_name}}</a></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @if (Route::has('login'))
                                    @auth
                                        <li class="nav-item float-right"><a class="nav-link" href="{{route('home')}}"><i class="fa fa-comments"></i>Home</a></li><li class="nav-item mt-4 float-right">
                                            <a class="btn btn-rounded btn-dark" href="#"><i class="fa fa-user"></i>{{auth()->user()->name}}</a></li>
                                        <li class="nav-item float-right">
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                                <a class="dropdown-item" href="{{ route('logout') }}"
                                                   onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                                    {{ __('Sign Out') }}
                                                </a>

                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            </div>
                                        </li>

                                    @else
                                        <li class="nav-item pull-right"><a class="nav-link" href="{{route('login')}}">Login</a></li>
                                        <li class="nav-item mt-4 pull-right">
                                            <a class="btn btn-rounded btn-dark" href="{{route('register')}}">Sign up</a>
                                        </li>
                                    @endauth
                                @endif
                            </ul>

                        </div>
                    </nav>
                    <!-- End Header 1 code -->
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Header 2  -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- Top header  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div id="app">
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->

            @yield('content')

            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Back to top -->
            <!-- ============================================================== -->
            <a class="bt-top btn btn-circle btn-lg btn-success" href="#top"><i class="ti-arrow-up"></i></a>
        </div>
            <!-- ============================================================== -->
            <!-- End Page wrapper  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer 4  -->
            <!-- ============================================================== -->
            <div class="footer4 spacer b-t">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 m-b-30">
                            <h5 class="m-b-20">Contacts</h5>
                            <p>Akedu </p>
                        </div>

                    </div>
                    <div class="f4-bottom-bar">
                        <div class="row">
                            <div class="col-md-12">
                                <nav class="navbar navbar-expand-lg h1-nav p-l-0 p-r-0">
                                    <a class="navbar-brand" href="{{route('home')}}">
                                        <img src="" alt="" width="50" />
                                    </a>
                                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#header1" aria-expanded="false" aria-label="Toggle navigation">
                                        <span class="ti-menu"></span>
                                    </button>
                                    <div class="collapse navbar-collapse" id="header1">
                                        <span class="hidden-lg-down">Akedu Student Connect.</span>
                                        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                                            <li class="nav-item active"><a class="nav-link" href="{{route('home')}}">Colleges</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#">Courses</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#">College Facilities</a></li>
                                        </ul>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- footer 4  -->
            <!-- ============================================================== -->
        </div>

    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{asset('assets/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap popper Core JavaScript -->
    <script src="{{asset('assets/popper/dist/popper.min.js')}}"></script>
    <script src="{{asset('assets/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- This is for the animation -->
    <script src="{{asset('assets/aos/dist/aos.js')}}"></script>
    <!--Custom JavaScript -->
    <script src="{{asset('js/custom.min.js')}}"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <script src="{{asset('assets/owl.carousel/dist/owl.carousel.min.js')}}"></script>
    @yield('foot')

    <script>
        /*******************************/
        // this is for the testimonial 2
        /*******************************/
        $('.testi2').owlCarousel({
            loop: true,
            margin: 20,
            nav: false,
            dots: true,
            autoplay: true,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                    nav: false
                },
                1170: {
                    items: 1
                }
            }
        })
        $(function() {
            // 1) ASSIGN EACH 'DOT' A NUMBER
            dotcount = 1;
            $('.testi2 .owl-dot').each(function() {
                $(this).addClass('dotnumber' + dotcount);
                $(this).attr('data-info', dotcount);
                dotcount = dotcount + 1;
            });
            // 2) ASSIGN EACH 'SLIDE' A NUMBER
            slidecount = 1;
            $('.testi2 .owl-item').not('.cloned').each(function() {
                $(this).addClass('slidenumber' + slidecount);
                slidecount = slidecount + 1;
            });
            $('.testi2 .owl-dot').each(function() {
                grab = jQuery(this).data('info');
                slidegrab = $('.slidenumber' + grab + ' img').attr('src');
                console.log(slidegrab);
                $(this).css("background-image", "url(" + slidegrab + ")");
            });
            // THIS FINAL BIT CAN BE REMOVED AND OVERRIDEN WITH YOUR OWN CSS OR FUNCTION, I JUST HAVE IT
            // TO MAKE IT ALL NEAT

        });
    </script>
</body>

</html>
