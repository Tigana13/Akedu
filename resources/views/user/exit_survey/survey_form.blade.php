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
                        <h1 class="title">Exit Survey</h1>
                        <h6 class="subtitle op-8">Kindly complete the form below</h6>
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
               @include('partials.session_alerts')
                <!-- Row -->
                <div class="row">
                    <div class="col-md-7">
                        <h2 class="title">Survey</h2>
                        <h6 class="subtitle"></h6>
                    </div>
                </div>
                <form action="{{route('exit_survey.submit')}}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="bio-name" class="col-5 col-form-label"><b>Name</b></label>
                        <div class="col-7">
                            <p class="btn btn-inverse"><b>{{auth()->user()->name}}</b></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bio-college" class="col-5 col-form-label"><b>Which college did you attend?</b></label>
                        <div class="col-7">
                            @if(auth()->user()->profile->college_id == null)
                                <select class="custom-select col-12" id="bio-college" required name="college">
                                    @foreach(\App\Models\College\College::all() as $college)
                                        <option value="{{$college->id}}">{{$college->college_name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('college'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('college') }}</strong>
                                    </span>
                                @endif
                            @else
                                <p class="btn btn-inverse"><b>{{\App\Models\College\College::findOrFail(auth()->user()->profile->college_id)->college_name}}</b></p>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bio-college" class="col-5 col-form-label"><b>Which course did you do?</b></label>
                        <div class="col-7">
                            <select class="custom-select col-12" id="bio-college" required name="course">
                                @foreach(\App\Models\Course\Course::all() as $course)
                                    <option value="{{$course->id}}">{{$course->course_name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('course'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('course') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bio-college" class="col-5 col-form-label"><b>Start Year</b></label>
                        <div class="col-7">
                            <input class="form-control {{ $errors->has('start_year') ? ' is-invalid' : '' }}" value="{{old('start_year')}}" placeholder="" name="start_year" type="date" id="bio-admission_year">
                            @if ($errors->has('start_year'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('start_year') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bio-college" class="col-5 col-form-label"><b>Completion Year</b></label>
                        <div class="col-7">
                            <input class="form-control {{ $errors->has('completion_year') ? ' is-invalid' : '' }}" value="{{old('completion_year')}}" placeholder="" name="completion_year" type="date" id="bio-admission_year">
                            @if ($errors->has('completion_year'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('completion_year') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <h5 class="mt-5 mb-5">Please provide a brief sentiment to indicate the degree to which your program provided an education that: </h5>
                    <div class="form-group row">
                        <label for="bio-college" class="col-5 col-form-label"><b>Helped me develop professional ethics </b></label>
                        <div class="col-7">
                            <div class="row">
                                <div class="col">
                                    <input type="text" value="{{old('professional_ethics')}}" required name="professional_ethics" class="form-inline form-control {{ $errors->has('professional_ethics') ? ' is-invalid' : '' }}" id="stronglyDisagree">

                                    @if ($errors->has('professional_ethics'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('professional_ethics') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bio-college" class="col-5 col-form-label"><b>Developed my oral communication skills </b></label>
                        <div class="col-7">
                            <div class="row">
                                <div class="col">
                                      <input type="text" value="{{old('communication_skills')}}" required name="communication_skills" class="form-inline form-control {{ $errors->has('communication_skills') ? ' is-invalid' : '' }}" id="stronglyDisagree">

                                    @if ($errors->has('communication_skills'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('communication_skills') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bio-college" class="col-5 col-form-label"><b>Applied theoretical knowledge to practical situations  </b></label>
                        <div class="col-7">
                            <div class="row">
                                <div class="col">
                                    <input type="text" value="{{old('theory_prac_application')}}" required name="theory_prac_application" class="form-inline form-control {{ $errors->has('theory_prac_application') ? ' is-invalid' : '' }}" id="stronglyDisagree">

                                    @if ($errors->has('theory_prac_application'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('theory_prac_application') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bio-college" class="col-5 col-form-label"><b>Helped me understand current issues and trends in the field</b></label>
                        <div class="col-7">
                            <div class="row">
                                <div class="col">
                                    <input type="text" value="{{old('current_field_trends')}}" required name="current_field_trends" class="form-inline form-control {{ $errors->has('current_field_trends') ? ' is-invalid' : '' }}" id="stronglyDisagree">

                                    @if ($errors->has('current_field_trends'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('current_field_trends') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bio-college" class="col-5 col-form-label"><b>Developed my written communication skills</b></label>
                        <div class="col-7">
                            <div class="row">
                                <div class="col">
                                    <input type="text" value="{{old('written_communication')}}" required name="written_communication" class="form-inline form-control {{ $errors->has('written_communication') ? ' is-invalid' : '' }}" id="stronglyDisagree">

                                    @if ($errors->has('written_communication'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('written_communication') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bio-college" class="col-5 col-form-label"><b>Developed my critical thinking skills</b></label>
                        <div class="col-7">
                            <div class="row">
                                <div class="col">
                                    <input type="text" value="{{old('critical_thinking')}}" required name="critical_thinking" class="form-inline form-control {{ $errors->has('critical_thinking') ? ' is-invalid' : '' }}" id="stronglyDisagree">

                                    @if ($errors->has('critical_thinking'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('critical_thinking') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bio-college" class="col-5 col-form-label"><b>Helped me learn to function effectively as a member of a team</b></label>
                        <div class="col-7">
                            <div class="row">
                                <div class="col">
                                    <input type="text" value="{{old('team_member_functionality')}}" required name="team_member_functionality" class="form-inline form-control {{ $errors->has('team_member_functionality') ? ' is-invalid' : '' }}" id="stronglyDisagree">

                                    @if ($errors->has('team_member_functionality'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('team_member_functionality') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bio-college" class="col-5 col-form-label"><b>Helped me function as an independent learner</b></label>
                        <div class="col-7">
                            <div class="row">
                                <div class="col">
                                    <input type="text" value="{{old('independent_learner')}}" required name="independent_learner" class="form-inline form-control {{ $errors->has('independent_learner') ? ' is-invalid' : '' }}" id="stronglyDisagree">

                                    @if ($errors->has('independent_learner'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('independent_learner') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bio-college" class="col-5 col-form-label"><b>Prepared me for further education and/or a career</b></label>
                        <div class="col-7">
                            <div class="row">
                                <div class="col">
                                    <input type="text" value="{{old('further_education_career')}}" required name="further_education_career" class="form-inline form-control {{ $errors->has('further_education_career') ? ' is-invalid' : '' }}" id="stronglyDisagree">

                                    @if ($errors->has('further_education_career'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('further_education_career') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bio-college" class="col-5 col-form-label"><b>Helped me develop strong leadership skills</b></label>
                        <div class="col-7">
                            <div class="row">
                                <div class="col">
                                    <input type="text" value="{{old('strong_leadership_skills')}}" required name="strong_leadership_skills" class="form-inline form-control {{ $errors->has('strong_leadership_skills') ? ' is-invalid' : '' }}" id="stronglyDisagree">

                                    @if ($errors->has('strong_leadership_skills'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('strong_leadership_skills') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <h5 class="mt-5 mb-5">Please provide a brief sentiment to indicate extent to which you agree with the following statements: </h5>
                    <div class="form-group row">
                        <label for="bio-college" class="col-5 col-form-label"><b>Faculty and staff encouraged me to get involved in campus life/activities</b></label>
                        <div class="col-7">
                            <div class="row">
                                <div class="col">
                                    <input type="text" value="{{old('faculty_moral_support')}}" required name="faculty_moral_support" class="form-inline form-control {{ $errors->has('faculty_moral_support') ? ' is-invalid' : '' }}" id="stronglyDisagree">

                                    @if ($errors->has('faculty_moral_support'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('faculty_moral_support') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bio-college" class="col-5 col-form-label"><b>I felt valued during my time at the Institution</b></label>
                        <div class="col-7">
                            <div class="row">
                                <div class="col">
                                    <input type="text" value="{{old('acceptance_at_institution')}}" required name="acceptance_at_institution" class="form-inline form-control {{ $errors->has('acceptance_at_institution') ? ' is-invalid' : '' }}" id="stronglyDisagree">

                                    @if ($errors->has('acceptance_at_institution'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('acceptance_at_institution') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bio-college" class="col-5 col-form-label"><b>At least one faculty or staff member took an interest in my academic or personal development</b></label>
                        <div class="col-7">
                            <div class="row">
                                <div class="col">
                                    <input type="text" value="{{old('faculty_support')}}" required name="faculty_support" class="form-inline form-control {{ $errors->has('faculty_support') ? ' is-invalid' : '' }}" id="stronglyDisagree">

                                    @if ($errors->has('faculty_support'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('faculty_support') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bio-college" class="col-5 col-form-label"><b>I am likely to return to campus for athletic, artistic, or other social events </b></label>
                        <div class="col-7">
                            <div class="row">
                                <div class="col">
                                    <input type="text" value="{{old('return_for_social_activities')}}" required name="return_for_social_activities" class="form-inline form-control {{ $errors->has('return_for_social_activities') ? ' is-invalid' : '' }}" id="stronglyDisagree">

                                    @if ($errors->has('return_for_social_activities'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('return_for_social_activities') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bio-college" class="col-5 col-form-label"><b>I feel prepared for the realities of finding employment and succeeding in the workplace</b></label>
                        <div class="col-7">
                            <div class="row">
                                <div class="col">
                                    <input type="text" value="{{old('employment_preparation')}}" required name="employment_preparation" class="form-inline form-control {{ $errors->has('employment_preparation') ? ' is-invalid' : '' }}" id="stronglyDisagree">

                                    @if ($errors->has('employment_preparation'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('employment_preparation') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <input value="Submit" class="btn btn-success offset-md-10 float-right" type="submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('foot')
    <script src="{{asset('assets/prism/prism.js')}}"></script>
@stop
