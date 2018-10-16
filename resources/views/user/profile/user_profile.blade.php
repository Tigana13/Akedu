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
        <div class="banner-innerpage" style="background-image:url(''); background-color: grey">
            <div class="container">
                <!-- Row  -->
                <div class="row justify-content-center ">
                    <!-- Column -->
                    <div class="col-md-6 align-self-center text-center" data-aos="fade-down" data-aos-duration="1200">
                        <h1 class="title">{{auth()->user()->name}}</h1>
                        <h6 class="subtitle op-8"></h6> </div>
                    <!-- Column -->
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Static Slider 10  -->
        <!-- ============================================================== -->

        <div class="spacer feature24">
            <div class="container">
               @include('partials.session_alerts')
                <!-- Row -->
                <div class="row">
                    <div class="col-md-7">
                        <h2 class="title">Bio</h2>
                        <h6 class="subtitle"></h6>
                    </div>
                </div>
                <form action="{{route('user.bio.update')}}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="bio-name" class="col-2 col-form-label">Name</label>
                        <div class="col-10">
                            <input class="form-control" name="name" type="text" value="{{auth()->user()->name}}" id="bio-name" readonly="">
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bio-email" class="col-2 col-form-label">Email</label>
                        <div class="col-10">
                            <input class="form-control" name="email" type="email" value="{{auth()->user()->email}}" id="bio-email" readonly>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bio-phone" class="col-2 col-form-label">Phone Number</label>
                        <div class="col-10">
                            <input class="form-control" value="{{auth()->user()->profile->phone_number}}" name="phone_number" type="number" placeholder="+254..." id="bio-phone">
                            @if ($errors->has('phone_number'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('phone_number') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bio-dob" class="col-2 col-form-label">
                            Date of Birth
                            <br>
                            <span class="label label-success">{{date('d-M-Y', strtotime(auth()->user()->profile->dob))}}</span>
                        </label>
                        <div class="col-10">
                            <input class="form-control" value="{{date('d-M-Y', strtotime(auth()->user()->profile->dob))}}" placeholder="{{auth()->user()->profile->dob}}" name="dob" type="date" id="bio-dob">
                            @if ($errors->has('dob'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('dob') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bio-occupation" class="col-2 col-form-label">Occupation</label>
                        <div class="col-10">
                            <input class="form-control" value="{{auth()->user()->profile->occupation}}" name="occupation" type="text" id="bio-occupation">
                            @if ($errors->has('occupation'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('occupation') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bio-occupation" class="col-2 col-form-label">
                            Are you a student?
                            <br>
                            @if(auth()->user()->profile->is_student)
                                <span class="label label-success">Active</span>
                            @endif
                        </label>
                        <div class="col-10">
                            <input class="form-control" value="1"  name="is_student" type="checkbox" id="bio-occupation">
                            @if ($errors->has('is_student'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('is_student') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bio-college" class="col-2 col-form-label">College</label>
                        <div class="col-10">
                            <select class="custom-select col-12" id="bio-college" name="college">
                                <option selected="">Choose...</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                            @if ($errors->has('college'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('college') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <input value="Submit" class="btn btn-lg btn-success offset-md-10 float-right" type="submit">
                    </div>
                </form>
            </div>
        </div>


        <div class="spacer feature24">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <h2 class="title">Interests</h2>
                        <h6 class="subtitle"></h6>
                    </div>
                </div>
                <!-- Row -->
                <div class="row wrap-feature-24">
                    @forelse($interests as $interest)
                        <div class="col-lg-3 col-md-6">
                            <a href="#">
                                <div class="card card-shadow">
                                    <a href="#" class="service-24"> <i class="icon-Target"></i>
                                        <h6 class="ser-title">{{$interest->interest_name}}</h6>
                                    </a>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="row justify-content-center text-center">
                            <span class="label label-warning label-rounded">No interests selected</span>
                        </div>
                    @endforelse

            </div>
        </div>

    </div>
@stop

@section('foot')
    <script src="{{asset('assets/prism/prism.js')}}"></script>
@stop
