@extends('layouts.akedu.akedu')

@section('content')
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Static Slider 10  -->
        <!-- ============================================================== -->
        <div class="banner-innerpage" style="background-image:url({{asset('images/innerpage/banner-bg3.jpg')}})">
            <div class="container">
                <!-- Row  -->
                <div class="row justify-content-center ">
                    <!-- Column -->
                    <div class="col-md-6 align-self-center text-center" data-aos="fade-down" data-aos-duration="1200">
                        <h1 class="title">Portfolio Masonry</h1>
                        <h6 class="subtitle op-8">We are Small Team of Creative People working together</h6> </div>
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
                <!-- Row  -->
                <div class="row justify-content-center">
                    <div class="col-md-7 text-center">
                        <h2 class="title text-white">Project with light box / Popup</h2>
                        <h6 class="subtitle">You can relay on our amazing features list and also our customer services will be great experience for you without doubt and in no-time</h6>
                    </div>
                </div>
                <!-- Row  -->
                <div class="row m-t-40 popup-gallery">
                    <!-- Column -->
                    <div class="col-md-4">
                        <div class="card">
                            <a href="../assets/images/portfolio/img1.jpg" class="img-ho" title="Bridge at NY Central"><img class="card-img-top" src="../assets/images/portfolio/img1.jpg" alt="wrappixel kit" /></a>
                            <div class="">
                                <p class="m-b-0 font-16 m-t-20 subtitle">Bridge at NY Central</p>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-4">
                        <div class="card">
                            <a href="../assets/images/portfolio/img2.jpg" class="img-ho" title="Pine Tree Building"><img class="card-img-top" src="../assets/images/portfolio/img2.jpg" alt="wrappixel kit" /></a>
                            <div class="">
                                <p class="m-b-0 font-16 m-t-20 subtitle">Pine Tree Building</p>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-4">
                        <div class="card">
                            <a href="../assets/images/portfolio/img3.jpg" class="img-ho" title="Rodger and Sons Factory"><img class="card-img-top" src="../assets/images/portfolio/img3.jpg" alt="wrappixel kit" /></a>
                            <div class="">
                                <p class="m-b-0 font-16 m-t-20 subtitle">Rodger and Sons Factory</p>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-4">
                        <div class="card">
                            <a href="../assets/images/portfolio/img4.jpg" class="img-ho" title="Largest Construction"><img class="card-img-top" src="../assets/images/portfolio/img4.jpg" alt="wrappixel kit" /></a>
                            <div class="">
                                <p class="m-b-0 font-16 m-t-20 subtitle">Largest Construction</p>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-4">
                        <div class="card">
                            <a href="../assets/images/portfolio/img5.jpg" class="img-ho" title="Mechanical Work"><img class="card-img-top" src="../assets/images/portfolio/img5.jpg" alt="wrappixel kit" /></a>
                            <div class="">
                                <p class="m-b-0 font-16 m-t-20 subtitle">Mechanical Work</p>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-4">
                        <div class="card">
                            <a href="../assets/images/portfolio/img6.jpg" class="img-ho" title="Power & Energy Project"><img class="card-img-top" src="../assets/images/portfolio/img6.jpg" alt="wrappixel kit" /></a>
                            <div class="">
                                <p class="m-b-0 font-16 m-t-20 subtitle">Power & Energy Project</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Projects -->
        <!-- ============================================================== -->
    </div>
@stop

