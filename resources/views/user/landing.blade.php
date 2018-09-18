@extends('layouts.akedu.akedu')

@section('head')
    <link href="{{asset('css/form/form.css')}}" rel="stylesheet">

@stop

@section('content')
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Static Slider 10  -->
        <!-- ============================================================== -->
        <div class="banner-innerpage" style="background-image:url({{asset('images/stuff/god_of_war_kratos_sony_santa_monica_110295_3840x2160.jpg')}})">
            <div class="container">
                <!-- Row  -->
                <div class="row justify-content-center ">
                    <!-- Column -->
                    <div class="col-md-6 align-self-center text-center" data-aos="fade-down" data-aos-duration="1200">
                        <h1 class="title">Colleges Listing</h1>
                        <h6 class="subtitle op-8"></h6> </div>
                    <!-- Column -->
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Static Slider 10  -->
        <!-- ============================================================== -->

        <!-- ============================================================== -->
        <!-- Portfolio 5 -->
        <!-- ============================================================== -->
        <div class="spacer feature2" id="work">
            <div class="container">
                <div class="row">
                    <form action="{{route('search')}}" method="post" id="banner1" class="banner" style="background: none">
                        @csrf
                        <div class="row text-center justify-content-center">
                            <div class="col-md-7 col-lg-5 align-self-center" data-aos="fade-right" data-aos-duration="1500">
                                <div class="m-t-40">
                                    <h2 class="title"></h2>
                                    <input type="text" name="search_query" placeholder="Course, College, ..." class="font-16" />
                                    <input type="submit" value="Search" class="bg-success-gradiant font-semibold font-16 btn-rounded text-uppercase text-white text-center" />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row m-t-40 popup-gallery">
                    @foreach ($colleges as $college)
                        <div class="col-md-4">
                            <div class="card">
                                <a href="{{route('college.show', $college->id)}}" class="img-ho" title="{{$college->college_name}}"><img class="card-img-top" src="{{$college->images->random()->image}}" alt="{{$college->images->random()->image}}" /></a>
                                <div class="">
                                    <h5 class="title">{{$college->college_name}}</h5>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{$colleges->appends(Request::except('page'))->links()}}

                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Projects -->
        <!-- ============================================================== -->
    </div>
@stop

