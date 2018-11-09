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
        <div class="banner-innerpage" style="background-image:url('{{asset('images/pencils-1280558_1920.jpg')}}');">
            <div class="container">
                <!-- Row  -->
                <div class="row justify-content-center ">
                    <!-- Column -->
                    <div class="col-md-6 align-self-center text-center" data-aos="fade-down" data-aos-duration="1200">
                        <h1 class="title">{{$course->course_name}}</h1>
                        <h6 class="subtitle op-8">{{($course->profile) ? $course->profile->course_description : ''}}</h6>
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
        <div class="feature24">
            <div class="container">
                <div class="col-md-7 p-r-40 m-t-30 m-b-30">
                    <h4 class="card-title">Sentiment Ratings </h4>
                    <h6 class="card-subtitle">
                        Get to know how well approved this course is.
                    </h6>
                    <h5 class="m-t-30">Rating: <span class="pull-right">{{round($course->sentiment_score_average * 100, 4)}}%</span></h5>
                    <div class="progress ">
                        <div class="progress-bar bg-success wow animated progress-animated" style="width: {{$course->sentiment_score_average * 100}}%; height:6px;" role="progressbar"> <span class="sr-only">{{round($course->sentiment_score_average * 100, 4)}} %</span> </div>
                    </div>
                    <h5 class="m-t-30">Popularity degree: <span class="pull-right">{{round($course->sentiment_magnitude_average * 100, 4)}}%</span></h5>
                    <div class="progress">
                        <div class="progress-bar bg-info wow animated progress-animated" style="width: {{round($course->sentiment_magnitude_average * 100, 4)}}%; height:6px;" role="progressbar"> <span class="sr-only">{{round($course->sentiment_magnitude_average * 100, 4)}}</span> </div>
                    </div>
                </div>
            </div>
        </div>

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
                            {{($course->profile != null)? $course->profile->course_qualifications: ''}}
                        </div>
                    </div>
                </div>
                <div class="row wrap-feature-22">
                    <div class="col-lg-12">
                        <div class="text-box">
                            <ul style="list-style-type: circle;">
                                <li><h3>Course Credits : {{($course->profile != null)? $course->profile->course_credits: ''}}</h3></li>
                                <li><h3>Course Duration : {{($course->profile != null)? $course->profile->course_duration: ''}}</h3></li>
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
                                    @if($college->exitSurveys->where('course_id', $course->id)->count() > 0)
                                        <span class="label label-lg label-danger">
                                            {{round((($course->sentiment_score_average) + rand(-0.5, 0.5)) * 100, 4)}}%
                                        </span>
                                    @endif
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
                                    @foreach ($comment->comments as $reply)
                                        <div class="media">
                                            <span class="d-flex mr-3" style="font-weight: bold; color: #0c5460">{{$comment->user->name}}</span>
                                            <div class="media-body">
                                                <p>{{$reply->body}}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                    @auth
                                        <form class="row comment-reply" action="{{route('comment.comment', ['comment_id' =>$comment->id, 'course_id' => $course->id])}}" method="post">
                                            @csrf
                                            <div class="form-group col-md-12">
                                                <input type="text" class="form-control text-input" name="comment_body" placeholder="Write a reply here ..."/>
                                            </div>
                                            <div class="form-group col-md-12 m-t-10">
                                                <button type="submit" class="btn btn-secondary waves-effect waves-light m-r-10">Reply</button>
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
