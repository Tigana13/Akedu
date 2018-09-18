@extends('layouts.akedu.akedu')

@section('head')
    <link href="{{asset('assets/prism/prism.css')}}" rel="stylesheet">
    <link href="{{asset('assets/perfect-scrollbar/dist/css/perfect-scrollbar.min.css')}}" rel="stylesheet">
@stop

@section('content')
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Static Slider 10  -->
        <!-- ============================================================== -->
        <div class="banner-innerpage" style="background-image:url({{$college->profile->bannerimages->random()->image}}); ">
            <div class="container">
                <!-- Row  -->
                <div class="row justify-content-center ">
                    <!-- Column -->
                    <div class="col-md-6 align-self-center text-center" data-aos="fade-down" data-aos-duration="1200">
                        <h1 class="title">{{$college->college_name}}</h1>
                        <h6 class="subtitle op-8">{{$college->profile->college_description}}</h6> </div>
                    <!-- Column -->
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Static Slider 10  -->
        <!-- ============================================================== -->

        <!-- ============================================================== -->
        <!-- College Portfolio-->
        <!-- ============================================================== -->
        <div class="spacer feature2" id="work">
            <div class="container">
                <div class="row m-t-40">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">College Gallery</h4>
                                <h6 class="card-subtitle"></h6>
                                <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner" role="listbox">
                                        <div class="carousel-item active"> <img class="img-responsive" src="{{$college->images->random()->image}}" alt="First slide"> </div>
                                        <div class="carousel-item"> <img class="img-responsive" src="{{$college->images->random()->image}}" alt="Second slide"> </div>
                                        <div class="carousel-item"> <img class="img-responsive" src="{{$college->images->random()->image}}" alt="Third slide"> </div>
                                    </div>
                                </div>
                                <div class="highlight"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- Contact 1  -->
                <!-- ============================================================== -->
                <div class="contact1">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="title">Branches</h4>
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1619902.0054433027!2d-122.68851282163044!3d37.534535608111824!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80859a6d00690021%3A0x4a501367f076adff!2sSan+Francisco%2C+CA%2C+USA!5e0!3m2!1sen!2sin!4v1507725785789" width="100%" height="450" frameborder="0" style="border:0"></iframe>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Contact 1  -->
                <!-- ============================================================== -->
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End College portfolio -->
        <!-- ============================================================== -->
    </div>
@stop

@section('foot')
    <script src="{{asset('assets/prism/prism.js')}}"></script>
@stop
