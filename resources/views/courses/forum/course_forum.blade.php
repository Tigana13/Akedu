@extends('layouts.akedu.akedu')

@section('head')
    <link href="{{asset('assets/prism/prism.css')}}" rel="stylesheet">
    <link href="{{asset('assets/perfect-scrollbar/dist/css/perfect-scrollbar.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/features/features21-30.css')}}" rel="stylesheet">
    <link href="{{asset('css/form/form.css')}}" rel="stylesheet">

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
                        <h1 class="title">Forum</h1>
                        <h3 >{{$course->course_name}}</h3>
                        <h6 class="subtitle op-8">{{$course->profile->course_description}}</h6> 
                        @if ($course->certified)
                            <span class="label label-success">CERTIFIED</span>
                        @else
                            <span class="label label-danger">NOT CERTIFIED</span>
                        @endif
                        <br><br><br>
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
                <div class="row justify-content-center">
                    <div class="col-md-7 text-center">
                        <h2 class="title"></h2>
                        <h6 class="subtitle"></h6>
                        @include('partials.session_alerts')
                    </div>
                </div>
                <div class="row p-4">
                    <form action="{{route('course.threads.search')}}" method="post" id="banner1" class="banner" style="background: none">
                        @csrf
                        <div class="row text-center justify-content-center">
                            <div class="col-md-7 col-lg-5 align-self-center" data-aos="fade-right" data-aos-duration="1500">
                                <h6 class="subtitle op-8">Search for threads</h6>
                                <h2 class="title"></h2>
                                <input type="hidden" name="course_id" value="{{$course->id}}">
                                <input type="text" name="search_query" placeholder="..." class="font-16" />
                                <input type="submit" value="Search" class="bg-success-gradiant font-semibold font-16 btn-rounded text-uppercase text-white text-center" />
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="row">
                            <div class="col">
                                <h3>Topics</h3>
                            </div>
                            {{--@auth--}}
                                {{--<div class="col">--}}
                                    {{--<a href="" class="btn btn-primary float-right" data-toggle="modal" data-target="#createThreadModal">--}}
                                        {{--<i class="fa fa-plus"></i> Create a Topic--}}
                                    {{--</a>--}}
                                {{--</div>--}}
                            {{--@endauth--}}
                        </div>
                        <div class="row">
                            <ul style="list-style-type: circle;">
                                @forelse ($topics as $topic)
                                    <li>
                                        <a href="" class="d-flex mr-3" style="font-weight: bold; color: #0c5460">{{$topic->title}}</a>
                                    </li>
                                @empty
                                    No Topics yet
                                @endforelse
                            </ul>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="row">
                            <div class="col">
                                <h3>Conversation Threads</h3>
                            </div>
                            @auth
                                <div class="col">
                                    <a href="" class="btn btn-primary float-right" data-toggle="modal" data-target="#createThreadModal">
                                        <i class="fa fa-plus"></i> Create a Thread
                                    </a>
                                </div>
                            @endauth
                        </div>
                        <div class="row">
                            <ul style="list-style-type: circle;">
                                @forelse ($threads as $thread)
                                    <li>
                                        <a href="{{route('course.thread.show', ['course_id' => $course->id, 'thread_id' => $thread->id])}}" class="d-flex mr-3" style="font-weight: bold; color: #0c5460">{{$thread->subject}} - <span style="font-weight: normal;">{{str_limit($thread->thread, 28)}}</span></a>
                                    </li>
                                @empty
                                    No threads yet
                                @endforelse
                            </ul>
                        </div>
                    </div>
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
                                        <form class="row comment-reply" action="{{route('comment.comment', $comment->id)}}" method="post">
                                            @csrf
                                            <div class="form-group col-md-12">
                                                <input type="text" class="form-control text-input" name="comment_body" placeholder="Write a reply here ..."/>
                                            </div>
                                            <div class="form-group col-md-12 m-t-10">
                                                <button type="submit" class="btn btn-secondary waves-effect waves-light m-r-10">Reply</button>
                                            </div>
                                        </form>
                                    @endauth
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

        <!-- Start Create Thread Modal -->
        <div class="modal fade" id="createThreadModal" tabindex="-1" role="dialog" aria-labelledby="creatThreadModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Start a Thread</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="create-thread-form" class="row" action="{{route('thread.store')}}" method="post">
                            @csrf
                            <input type="hidden" name="course_id" value="{{$course->id}}">
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control" required name="thread_title" placeholder="Thread title"/>
                            </div>
                            <div class="form-group col-md-12">
                                <textarea type="text" class="form-control" rows="8" name="thread_subject" placeholder="Description (optional)"></textarea>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button tlype="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('create-thread-form').submit();">Submit</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Create Thread Modal -->

        @stop

@section('foot')
    <script src="{{asset('assets/prism/prism.js')}}"></script>
@stop
