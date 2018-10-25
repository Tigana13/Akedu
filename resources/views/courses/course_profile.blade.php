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
        <div class="banner-innerpage" style="background-image:url(); background-color: grey">
            <div class="container">
                <!-- Row  -->
                <div class="row justify-content-center ">
                    <!-- Column -->
                    <div class="col-md-6 align-self-center text-center" data-aos="fade-down" data-aos-duration="1200">
                        <h1 class="title">{{$course->course_name}}</h1>
                        <h6 class="subtitle op-8">{{$course->profile->course_description}}</h6> 
                        @if ($course->certified)
                            <span class="label label-success">CERTIFIED</span>
                        @else
                            <span class="label label-danger">NOT CERTIFIED</span>
                        @endif
                        <br><br><br>
                        <a href="{{route('course.forum.show', $course->id)}}" class="btn btn-warning">TO FORUM</a>
                    </div>
                    <!-- Column -->
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Static Slider 10  -->
        <!-- ============================================================== -->

        <div class="spacer feature24">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-7 text-center">
                        <h2 class="title">Qualifications</h2>
                        <h6 class="subtitle"></h6>
                    </div>
                </div>
                <div class="row wrap-feature-22">
                    <div class="col-lg-12">
                        <div class="text-box">
                            <h3 class="font-light"></h3>
                            {{$course->profile->course_qualifications}}
                        </div>
                    </div>
                </div>
                <div class="row wrap-feature-22">
                    <div class="col-lg-12">
                        <div class="text-box">
                            <ul style="list-style-type: circle;">
                                <li><h3>Course Credits : {{$course->profile->course_credits}}</h3></li>
                                <li><h3>Course Duration : {{$course->profile->course_duration}}</h3></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-7 text-center">
                        <h2 class="title">Offered In: </h2>
                        <h6 class="subtitle"></h6>
                    </div>
                </div>
                <div class="row wrap-feature-24">
                    @forelse($course->colleges as $college)
                        <div class="col-lg-3 col-md-6">
                            <a href="{{route('college.show', $college->id)}}">
                                <div class="card card-shadow">
                                    <a href="{{route('college.show', $college->id)}}" class="service-24"> <i class="icon-Target"></i>
                                        <h6 class="ser-title">{{$college->college_name}}</h6>
                                    </a>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="row justify-content-center text-center">
                            <span class="label label-warning label-rounded">No Colleges</span>
                        </div>
                    @endforelse
                </div>

            </div>
        </div>

        <!-- ============================================================== -->
        <!-- Comments about this course  -->
        <!-- ============================================================== -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <hr class="op-5" />
                <div class="mini-spacer p-b-0">
                    <h3>Comments about this course ({{$course->comments->count()}})</h3>
                    @include('partials.session_alerts')
                    <ul class="list-unstyled with-noborder m-t-30">
                        @foreach ($course->comments as $comment)
                            <li class="media">
                                <span class="d-flex mr-3" style="font-weight: bold; color: #0c5460">{{$comment->user->name}}</span>
                                <div class="media-body">
                                    <p>{{$comment->body}}</p>
                                    <br/>
                                    <br/>
                                    @foreach ($comment->comments as $reply)
                                        <div class="media">
                                            <span class="d-flex mr-3" style="font-weight: bold; color: #0c5460">{{$comment->user->name}}</span>
                                            <div class="media-body">
                                                <p>{{$reply->body}}</p>
                                                <br/>
                                                <br/>
                                            </div>
                                        </div>
                                    @endforeach
                                    @auth
                                        <form class="row" action="{{route('comment.comment', $comment->id)}}" method="post">
                                            @csrf
                                            <div class="form-group col-md-12">
                                                <input type="text" class="form-control" name="comment_body" placeholder="Comment"/>
                                            </div>
                                            <div class="form-group col-md-12 m-t-10">
                                                <button type="submit" class="btn btn-info waves-effect waves-light m-r-10">Submit</button>
                                            </div>
                                        </form>
                                    @endauth
                                    <br>
                                    <p style="color: orangered;">Replies <span class="badge badge-success">{{$comment->comments->count()}}</span> </p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                @auth
                    <hr class="op-5" />
                    <div class="mini-spacer">
                        <h3>Add Comment</h3>
                        <h6 class="subtitle">Comment on this course</h6>
                        <form class="row" action="{{route('course.comment', $course->id)}}" method="post">
                            @csrf
                            <div class="form-group col-md-12 m-t-20">
                                <textarea class="form-control" name="comment_body" rows="5" placeholder="Comment"></textarea>
                            </div>
                            <div class="form-group col-md-12 m-t-20">
                                <button type="submit" class="btn btn-info waves-effect waves-light m-r-10">Submit</button>
                            </div>
                        </form>
                    </div>
                @endauth
                <hr class="op-5" />
                <div class="mini-spacer">
                    <div class="d-flex no-block font-13">
                        <a href="#" class="link font-medium"><i class="ti-arrow-left m-r-10"></i> PREVIOUS</a>
                        <a href="#" class="link ml-auto font-medium"> NEXT <i class="ti-arrow-right m-l-10 "></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!--  Comments about this course  -->
        <!-- ============================================================== -->

@stop

@section('foot')
    <script src="{{asset('assets/prism/prism.js')}}"></script>
@stop
