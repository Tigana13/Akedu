@extends('layouts.akedu.akedu')

@section('head')
    <link href="{{asset('assets/prism/prism.css')}}" rel="stylesheet">
    <link href="{{asset('assets/perfect-scrollbar/dist/css/perfect-scrollbar.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/features/features21-30.css')}}" rel="stylesheet">

@stop

@section('content')
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Static Slider 10  -->
        <!-- ============================================================== -->
        <div class="banner-innerpage" style="background-image:url('{{asset('storage/colleges/'.$college->college_name.'/'.$college->bannerimages->random()->image)}}'); background-color: grey">
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

        <div class="spacer feature24">
            <div class="container">
                <!-- Row -->
                <div class="row justify-content-center">
                    <div class="col-md-7 text-center">
                        <h2 class="title">Branches</h2>
                        <h6 class="subtitle"></h6>
                    </div>
                </div>
                <!-- Row -->
                <div class="row wrap-feature-24">
                    @forelse($college->locations as $location)
                        <div class="col-lg-3 col-md-6">
                            <div class="card card-shadow">
                                <a href="javascript:void(0)" class="service-24"> <i class="icon-Target"></i>
                                    <h6 class="ser-title">{{$location->address}}</h6>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="row justify-content-center text-center">
                            <span class="label label-warning label-rounded">No branches listed</span>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="spacer feature24">
            <div class="container">
                <!-- Row -->
                <div class="row justify-content-center">
                    <div class="col-md-7 text-center">
                        <h2 class="title">Courses</h2>
                        <h6 class="subtitle">Listed under {{$college->college_name}}</h6>
                    </div>
                </div>
                <!-- Row -->
                <div class="row wrap-feature-24">
                    @forelse($college->courses as $course)
                        <div class="col-lg-3 col-md-6">
                            <a href="{{route('course.show', $course->id)}}">
                                <div class="card card-shadow">
                                    <a href="{{route('course.show', $course->id)}}" class="service-24"> <i class="icon-Target"></i>
                                        <h6 class="ser-title">{{$course->course_name}}</h6>
                                        <p>Credits: {{$course->course_credits}}</p>
                                        <p>Duration: {{$course->course_duration}}</p>
                                        <p>Certified:
                                            @if ($course->active)
                                                <span class="label label-success">True</span>
                                            @else
                                                <span class="label label-warning">False</span>
                                            @endif
                                        </p>
                                    </a>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="row justify-content-center text-center">
                            <span class="label label-warning label-rounded">No courses listed</span>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

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
                                        <div class="carousel-item active"> <img class="img-responsive" src="{{asset('storage/colleges/'.$college->college_name.'/'.$college->images->random()->image)}}" alt="{{asset('storage/colleges/'.$college->college_name.'/'.$college->images->random()->image)}}"> </div>
                                        <div class="carousel-item"> <img class="img-responsive" src="{{asset('storage/colleges/'.$college->college_name.'/'.$college->images->random()->image)}}" alt="{{asset('storage/colleges/'.$college->college_name.'/'.$college->images->random()->image)}}"> </div>
                                        <div class="carousel-item"> <img class="img-responsive" src="{{asset('storage/colleges/'.$college->college_name.'/'.$college->images->random()->image)}}" alt="{{asset('storage/colleges/'.$college->college_name.'/'.$college->images->random()->image)}}"> </div>
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
                            <h4 class="title">Branch Locator</h4>

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
