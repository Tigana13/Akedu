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
                        <h1 class="title">{{$thread->subject}}</h1>
                        <h3 >{{$course->course_name}}</h3>
                        <br><br><br>
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
                        <h2 class="title">Description</h2>
                        <h6 class="subtitle">{{$thread->thread}}</h6>
                        @include('partials.session_alerts')
                    </div>
                </div>
            </div>
        </div>

        <!-- ============================================================== -->
        <!-- Thread comments  -->
        <!-- ============================================================== -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="mini-spacer p-b-0">
                    <h3>Comments ({{$thread->comments->count()}})</h3>
                    @include('partials.session_alerts')
                    <ul class="list-unstyled with-noborder m-t-30">
                        @foreach ($thread->comments as $comment)
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
                        <h3>Add a Comment</h3>
                        <form class="row" action="{{route('course.thread.comment', $thread->id)}}" method="post">
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
        <!-- End Blog example -->
        <!-- ============================================================== -->

        <!-- Start Create Thread Modal -->
        <div class="modal fade" id="createThreadModal" tabindex="-1" role="dialog" aria-labelledby="creatThreadModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create a Thread</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="create-thread-form" class="row" action="{{route('thread.store', $course->id)}}" method="post">
                            @csrf
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control" required name="thread_title" placeholder="Thread title"/>
                            </div>
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control" name="thread_subject" placeholder="Description (optional)"/>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
