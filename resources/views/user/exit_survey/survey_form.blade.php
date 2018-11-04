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
                            <input class="form-control" value="{{old('start_year')}}" placeholder="" name="start_year" type="date" id="bio-admission_year">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bio-college" class="col-5 col-form-label"><b>Completion Year</b></label>
                        <div class="col-7">
                            <input class="form-control" value="{{old('completion_year')}}" placeholder="" name="completion_year" type="date" id="bio-admission_year">
                        </div>
                    </div>
                    <h5 class="mt-5 mb-5">Please indicate the degree to which your program provided an education that: </h5>
                    <div class="form-group row">
                        <label for="bio-college" class="col-5 col-form-label"><b>Helped me develop professional ethics </b></label>
                        <div class="col-7">
                            <div class="row">
                                <div class="col-2">
                                    <input type="radio" value="-1" required name="professional_ethics" class="form-check-input" id="stronglyDisagree">
                                    <label class="form-check-label" for="stronglyDisagree">Strongly disagree</label>
                                </div>

                                <div class="col-2">
                                    <input type="radio" value="0" required name="professional_ethics" class="form-check-input" id="Disagree">
                                    <label class="form-check-label" for="Disagree">Disagree</label>
                                </div>

                                <div class="col-2">
                                    <input type="radio" value="1" required name="professional_ethics" class="form-check-input" id="Agree">
                                    <label class="form-check-label" for="Agree">Agree</label>
                                </div>

                                <div class="col-2">
                                    <input type="radio" value="2" required name="professional_ethics" class="form-check-input" id="stronglyAgree">
                                    <label class="form-check-label" for="stronglyAgree">Strongly Agree</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bio-college" class="col-5 col-form-label"><b>Developed my oral communication skills </b></label>
                        <div class="col-7">
                            <div class="row">
                                <div class="col-2">
                                    <input type="radio" value="-1" required name="communication_skills" class="form-check-input" id="stronglyDisagree">
                                    <label class="form-check-label" for="stronglyDisagree">Strongly disagree</label>
                                </div>

                                <div class="col-2">
                                    <input type="radio" value="0" required name="communication_skills" class="form-check-input" id="Disagree">
                                    <label class="form-check-label" for="Disagree">Disagree</label>
                                </div>

                                <div class="col-2">
                                    <input type="radio" value="1" required name="communication_skills" class="form-check-input" id="Agree">
                                    <label class="form-check-label" for="Agree">Agree</label>
                                </div>

                                <div class="col-2">
                                    <input type="radio" value="2" required name="communication_skills" class="form-check-input" id="stronglyAgree">
                                    <label class="form-check-label" for="stronglyAgree">Strongly Agree</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bio-college" class="col-5 col-form-label"><b>Applied theoretical knowledge to practical situations  </b></label>
                        <div class="col-7">
                            <div class="row">
                                <div class="col-2">
                                    <input type="radio" value="-1" required name="theory_prac_application" class="form-check-input" id="stronglyDisagree">
                                    <label class="form-check-label" for="stronglyDisagree">Strongly disagree</label>
                                </div>

                                <div class="col-2">
                                    <input type="radio" value="0" required name="theory_prac_application" class="form-check-input" id="Disagree">
                                    <label class="form-check-label" for="Disagree">Disagree</label>
                                </div>

                                <div class="col-2">
                                    <input type="radio" value="1" required name="theory_prac_application" class="form-check-input" id="Agree">
                                    <label class="form-check-label" for="Agree">Agree</label>
                                </div>

                                <div class="col-2">
                                    <input type="radio" value="2" required name="theory_prac_application" class="form-check-input" id="stronglyAgree">
                                    <label class="form-check-label" for="stronglyAgree">Strongly Agree</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bio-college" class="col-5 col-form-label"><b>Helped me understand current issues and trends in the field</b></label>
                        <div class="col-7">
                            <div class="row">
                                <div class="col-2">
                                    <input type="radio" value="-1" required name="current_field_trends" class="form-check-input" id="stronglyDisagree">
                                    <label class="form-check-label" for="stronglyDisagree">Strongly disagree</label>
                                </div>

                                <div class="col-2">
                                    <input type="radio" value="0" required name="current_field_trends" class="form-check-input" id="Disagree">
                                    <label class="form-check-label" for="Disagree">Disagree</label>
                                </div>

                                <div class="col-2">
                                    <input type="radio" value="1" required name="current_field_trends" class="form-check-input" id="Agree">
                                    <label class="form-check-label" for="Agree">Agree</label>
                                </div>

                                <div class="col-2">
                                    <input type="radio" value="2" required name="current_field_trends" class="form-check-input" id="stronglyAgree">
                                    <label class="form-check-label" for="stronglyAgree">Strongly Agree</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bio-college" class="col-5 col-form-label"><b>Developed my written communication skills</b></label>
                        <div class="col-7">
                            <div class="row">
                                <div class="col-2">
                                    <input type="radio" value="-1" required name="written_communication" class="form-check-input" id="stronglyDisagree">
                                    <label class="form-check-label" for="stronglyDisagree">Strongly disagree</label>
                                </div>

                                <div class="col-2">
                                    <input type="radio" value="0" required name="written_communication" class="form-check-input" id="Disagree">
                                    <label class="form-check-label" for="Disagree">Disagree</label>
                                </div>

                                <div class="col-2">
                                    <input type="radio" value="1" required name="written_communication" class="form-check-input" id="Agree">
                                    <label class="form-check-label" for="Agree">Agree</label>
                                </div>

                                <div class="col-2">
                                    <input type="radio" value="2" required name="written_communication" class="form-check-input" id="stronglyAgree">
                                    <label class="form-check-label" for="stronglyAgree">Strongly Agree</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bio-college" class="col-5 col-form-label"><b>Developed my critical thinking skills</b></label>
                        <div class="col-7">
                            <div class="row">
                                <div class="col-2">
                                    <input type="radio" value="-1" required name="critical_thinking" class="form-check-input" id="stronglyDisagree">
                                    <label class="form-check-label" for="stronglyDisagree">Strongly disagree</label>
                                </div>

                                <div class="col-2">
                                    <input type="radio" value="0" required name="critical_thinking" class="form-check-input" id="Disagree">
                                    <label class="form-check-label" for="Disagree">Disagree</label>
                                </div>

                                <div class="col-2">
                                    <input type="radio" value="1" required name="critical_thinking" class="form-check-input" id="Agree">
                                    <label class="form-check-label" for="Agree">Agree</label>
                                </div>

                                <div class="col-2">
                                    <input type="radio" value="2" required name="critical_thinking" class="form-check-input" id="stronglyAgree">
                                    <label class="form-check-label" for="stronglyAgree">Strongly Agree</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bio-college" class="col-5 col-form-label"><b>Helped me learn to function effectively as a member of a team</b></label>
                        <div class="col-7">
                            <div class="row">
                                <div class="col-2">
                                    <input type="radio" value="-1" required name="team_member_functionality" class="form-check-input" id="stronglyDisagree">
                                    <label class="form-check-label" for="stronglyDisagree">Strongly disagree</label>
                                </div>

                                <div class="col-2">
                                    <input type="radio" value="0" required name="team_member_functionality" class="form-check-input" id="Disagree">
                                    <label class="form-check-label" for="Disagree">Disagree</label>
                                </div>

                                <div class="col-2">
                                    <input type="radio" value="1" required name="team_member_functionality" class="form-check-input" id="Agree">
                                    <label class="form-check-label" for="Agree">Agree</label>
                                </div>

                                <div class="col-2">
                                    <input type="radio" value="2" required name="team_member_functionality" class="form-check-input" id="stronglyAgree">
                                    <label class="form-check-label" for="stronglyAgree">Strongly Agree</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bio-college" class="col-5 col-form-label"><b>Helped me function as an independent learner</b></label>
                        <div class="col-7">
                            <div class="row">
                                <div class="col-2">
                                    <input type="radio" value="-1" required name="independent_learner" class="form-check-input" id="stronglyDisagree">
                                    <label class="form-check-label" for="stronglyDisagree">Strongly disagree</label>
                                </div>

                                <div class="col-2">
                                    <input type="radio" value="0" required name="independent_learner" class="form-check-input" id="Disagree">
                                    <label class="form-check-label" for="Disagree">Disagree</label>
                                </div>

                                <div class="col-2">
                                    <input type="radio" value="1" required name="independent_learner" class="form-check-input" id="Agree">
                                    <label class="form-check-label" for="Agree">Agree</label>
                                </div>

                                <div class="col-2">
                                    <input type="radio" value="2" required name="independent_learner" class="form-check-input" id="stronglyAgree">
                                    <label class="form-check-label" for="stronglyAgree">Strongly Agree</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bio-college" class="col-5 col-form-label"><b>Prepared me for further education and/or a career</b></label>
                        <div class="col-7">
                            <div class="row">
                                <div class="col-2">
                                    <input type="radio" value="-1" required name="further_education_career" class="form-check-input" id="stronglyDisagree">
                                    <label class="form-check-label" for="stronglyDisagree">Strongly disagree</label>
                                </div>

                                <div class="col-2">
                                    <input type="radio" value="0" required name="further_education_career" class="form-check-input" id="Disagree">
                                    <label class="form-check-label" for="Disagree">Disagree</label>
                                </div>

                                <div class="col-2">
                                    <input type="radio" value="1" required name="further_education_career" class="form-check-input" id="Agree">
                                    <label class="form-check-label" for="Agree">Agree</label>
                                </div>

                                <div class="col-2">
                                    <input type="radio" value="2" required name="further_education_career" class="form-check-input" id="stronglyAgree">
                                    <label class="form-check-label" for="stronglyAgree">Strongly Agree</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bio-college" class="col-5 col-form-label"><b>Helped me develop strong leadership skills</b></label>
                        <div class="col-7">
                            <div class="row">
                                <div class="col-2">
                                    <input type="radio" value="-1" required name="strong_leadership_skills" class="form-check-input" id="stronglyDisagree">
                                    <label class="form-check-label" for="stronglyDisagree">Strongly disagree</label>
                                </div>

                                <div class="col-2">
                                    <input type="radio" value="0" required name="strong_leadership_skills" class="form-check-input" id="Disagree">
                                    <label class="form-check-label" for="Disagree">Disagree</label>
                                </div>

                                <div class="col-2">
                                    <input type="radio" value="1" required name="strong_leadership_skills" class="form-check-input" id="Agree">
                                    <label class="form-check-label" for="Agree">Agree</label>
                                </div>

                                <div class="col-2">
                                    <input type="radio" value="2" required name="strong_leadership_skills" class="form-check-input" id="stronglyAgree">
                                    <label class="form-check-label" for="stronglyAgree">Strongly Agree</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h5 class="mt-5 mb-5">Please indicate extent to which you agree with the following statements: </h5>
                    <div class="form-group row">
                        <label for="bio-college" class="col-5 col-form-label"><b>Faculty and staff encouraged me to get involved in campus life/activities</b></label>
                        <div class="col-7">
                            <div class="row">
                                <div class="col-2">
                                    <input type="radio" value="-1" required name="faculty_moral_support" class="form-check-input" id="stronglyDisagree">
                                    <label class="form-check-label" for="stronglyDisagree">Strongly disagree</label>
                                </div>

                                <div class="col-2">
                                    <input type="radio" value="0" required name="faculty_moral_support" class="form-check-input" id="Disagree">
                                    <label class="form-check-label" for="Disagree">Disagree</label>
                                </div>

                                <div class="col-2">
                                    <input type="radio" value="1" required name="faculty_moral_support" class="form-check-input" id="Agree">
                                    <label class="form-check-label" for="Agree">Agree</label>
                                </div>

                                <div class="col-2">
                                    <input type="radio" value="2" required name="faculty_moral_support" class="form-check-input" id="stronglyAgree">
                                    <label class="form-check-label" for="stronglyAgree">Strongly Agree</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bio-college" class="col-5 col-form-label"><b>I felt valued during my time at the Institution</b></label>
                        <div class="col-7">
                            <div class="row">
                                <div class="col-2">
                                    <input type="radio" value="-1" required name="acceptance_at_institution" class="form-check-input" id="stronglyDisagree">
                                    <label class="form-check-label" for="stronglyDisagree">Strongly disagree</label>
                                </div>

                                <div class="col-2">
                                    <input type="radio" value="0" required name="acceptance_at_institution" class="form-check-input" id="Disagree">
                                    <label class="form-check-label" for="Disagree">Disagree</label>
                                </div>

                                <div class="col-2">
                                    <input type="radio" value="1" required name="acceptance_at_institution" class="form-check-input" id="Agree">
                                    <label class="form-check-label" for="Agree">Agree</label>
                                </div>

                                <div class="col-2">
                                    <input type="radio" value="2" required name="acceptance_at_institution" class="form-check-input" id="stronglyAgree">
                                    <label class="form-check-label" for="stronglyAgree">Strongly Agree</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bio-college" class="col-5 col-form-label"><b>At least one faculty or staff member took an interest in my academic or personal development</b></label>
                        <div class="col-7">
                            <div class="row">
                                <div class="col-2">
                                    <input type="radio" value="-1" required name="faculty_support" class="form-check-input" id="stronglyDisagree">
                                    <label class="form-check-label" for="stronglyDisagree">Strongly disagree</label>
                                </div>

                                <div class="col-2">
                                    <input type="radio" value="0" required name="faculty_support" class="form-check-input" id="Disagree">
                                    <label class="form-check-label" for="Disagree">Disagree</label>
                                </div>

                                <div class="col-2">
                                    <input type="radio" value="1" required name="faculty_support" class="form-check-input" id="Agree">
                                    <label class="form-check-label" for="Agree">Agree</label>
                                </div>

                                <div class="col-2">
                                    <input type="radio" value="2" required name="faculty_support" class="form-check-input" id="stronglyAgree">
                                    <label class="form-check-label" for="stronglyAgree">Strongly Agree</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bio-college" class="col-5 col-form-label"><b>I am likely to return to campus for athletic, artistic, or other social events </b></label>
                        <div class="col-7">
                            <div class="row">
                                <div class="col-2">
                                    <input type="radio" value="-1" required name="return_for_social_activities" class="form-check-input" id="stronglyDisagree">
                                    <label class="form-check-label" for="stronglyDisagree">Strongly disagree</label>
                                </div>

                                <div class="col-2">
                                    <input type="radio" value="0" required name="return_for_social_activities" class="form-check-input" id="Disagree">
                                    <label class="form-check-label" for="Disagree">Disagree</label>
                                </div>

                                <div class="col-2">
                                    <input type="radio" value="1" required name="return_for_social_activities" class="form-check-input" id="Agree">
                                    <label class="form-check-label" for="Agree">Agree</label>
                                </div>

                                <div class="col-2">
                                    <input type="radio" value="2" required name="return_for_social_activities" class="form-check-input" id="stronglyAgree">
                                    <label class="form-check-label" for="stronglyAgree">Strongly Agree</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bio-college" class="col-5 col-form-label"><b>I feel prepared for the realities of finding employment and succeeding in the workplace</b></label>
                        <div class="col-7">
                            <div class="row">
                                <div class="col-2">
                                    <input type="radio" value="-1" required name="employment_preparation" class="form-check-input" id="stronglyDisagree">
                                    <label class="form-check-label" for="stronglyDisagree">Strongly disagree</label>
                                </div>

                                <div class="col-2">
                                    <input type="radio" value="0" required name="employment_preparation" class="form-check-input" id="Disagree">
                                    <label class="form-check-label" for="Disagree">Disagree</label>
                                </div>

                                <div class="col-2">
                                    <input type="radio" value="1" required name="employment_preparation" class="form-check-input" id="Agree">
                                    <label class="form-check-label" for="Agree">Agree</label>
                                </div>

                                <div class="col-2">
                                    <input type="radio" value="2" required name="employment_preparation" class="form-check-input" id="stronglyAgree">
                                    <label class="form-check-label" for="stronglyAgree">Strongly Agree</label>
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
