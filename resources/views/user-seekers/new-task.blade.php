@extends('app-user')
@section('scripts')
    {!! Html::script( asset('assets/js/bootstrap-datepicker.js')) !!}
    {!! Html::script("http://maps.googleapis.com/maps/api/js?sensor=false") !!}
    {!! Html::script(asset('assets/js/map.main.js')) !!}
    {!! Html::script(asset('assets/cropper-master/dist/cropper.js')) !!}
    <!-- {!! HTML::script(asset('assets/cropper-master/media.main.js')) !!} -->
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
    <script src="http://maps.google.com/maps/api/js?libraries=places&region=uk&language=en&sensor=true"></script>
    @if(session('modal'))
    <script type="text/javascript">
        $(document).ready(function(){
          $('#myModal').modal({
              show: 'false'
          });
        })
    </script>
    @endif
@stop
@section('css')
    {!! Html::style( asset('assets/css/datepicker.css')) !!}
    {!! Html::style( asset('assets/css/main.css')) !!}
    {!! Html::style( asset('assets/css/log-in-popup.css')) !!}
    {!! Html::style( asset('assets/css/sign-up.css')) !!}
    {!! Html::style( asset('assets/cropper-master/dist/cropper.css')) !!}
    {!! Html::style( asset('assets/cropper-master/demo/css/main.css')) !!}
    <style type="text/css">
        .new-job{
            padding-bottom: 0px !important;
        }
        .task-questions .question{
            padding: 0px;

        }
        .error_answer{
            color: #a94442;
            background-color: #f2dede;
            border-color: #ebccd1;
            padding: 5px;
        }
        /*.radio_content::before{
          content: none !important;
        }
        .radio_content::after{
          display: none !important;
        }
        .radio_content{
          margin-top: -15px !important;
          padding-left: 0px !important;
        }
        .radion_input{
          opacity: 1 !important;
          margin-left: -22px !important;
          cursor: pointer !important;
          width: 50px !important;
          height: 20px !important;
        }*/

        .text_label::before{
          content: none !important;
        }
        .text_label::after{
          content: none !important;
        }
        .text_content{
          margin-left: -25px !important;
          resize: none;
        }
        
    </style>

@endsection

@section('content-seeker-new-task')
<div class="modal fade" id="myModalCrop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Crop image</h4>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="img-container" id='crop_container'>
                                <img  src="" id="crop_imag" alt="Picture">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-9 docs-buttons">
                            <div class="btn-group">
                                {!! Form::text('imag_data', null, ['id' => 'putData', 'class' => 'form-control','style' => 'display:none']) !!}
                                {!! Form::text('imag_name', null, ['id' => 'imagName', 'class' => 'form-control','style' => 'display:none']) !!}
                                <span id='crop' class="btn btn-primary" data-dismiss="modal" aria-label="Close" data-method="getData" data-option="" data-target="#putData">
                                    Crop image
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="new-job">
    <div class="container">
        @if (count($errors) > 0) 
        <div class="alert alert-danger">
            <ul>
            <li><b>Oops, something went wrong.</b></li>
                @foreach ($errors->all() as $error)                    
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="alert alert-danger validator" style="display:none">
        </div>
        <input type="hidden" id="longitude" value="{{$longitude}}">
        <input type="hidden" id="latitude" value="{{$latitude}}">
        <div class="row">
            <div class="hidden-xs col-sm-4 col-lg-3">
            @if(Auth::user())
                @if(Auth::user()->role == 'seeker')
                    <div class="sidebar-menu">
                        <div class="panel-group">
                            <div class="panel panel-default">
                               <!--  <div class="panel-heading">
                                    <h4 class="panel-title">Menu</h4>
                                </div>  -->
                                <div id="menu" class="">
                                    <ul class="list-group">
                                        <ul class="list-group">
                                          <li class="list-group-item"><a href="{{action('SeekersController@getProfile')}}" style="text-decoration: underline;">My profile</a></li>
                                          <li class="list-group-item"><a href="{{action('SeekersController@getNewTask')}}" style="text-decoration: none;">Create New Task</a></li> 
                                          <li class="list-group-item"><a href="{{action('SeekersController@getMyTasks')}}" style="text-decoration: underline;">My Requests</a></li>  
                                        </ul>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div> <!-- /sidebar-menu -->
                @endif
            @endif     
            </div>
            <div class="col-xs-12 col-sm-8 col-lg-9">
                <div class="task-options">
                    <h4>New task <small>*indicates a required fields</small></h4>
                    <div class="task-questions" style="margin-bottom: 100px">
                    {!! Form::open(['action' => ['SeekersController@postNewTask'],'files' => 'true','class' => 'form-horizontal form-submit', 'role' => 'form']) !!}
                        <input type="hidden" data='{{ csrf_token() }}' id='csrf'/>
                        @if(Auth::user())
                            @if(Auth::user()->role == 'seeker')
                            <label style="margin-left: -15px;">Choose a category</label>
                                {!! Form::select('category', $categories, ['' => ['label' => 'Please Select', 'disabled' => 'disabled']], ['id' => 'category_questions', 'class' => 'form-control category_option validation_text','required' => 'required', 'placeholder' => 'Select Category']) !!}
                            @endif
                        @else
                            <label style="margin-left: -15px;">Choose a category</label>
                            {!! Form::select('category', $categories, ['' => ['label' => 'Please Select', 'disabled' => 'disabled']], ['id' => 'category_questions', 'class' => 'form-control category_option validation_text','required' => 'required', "selected" => "selected"]) !!}
                            <input type="hidden" id="category_id_static" value="{{$category_id}}">
                        @endif
                            {!! Form::hidden('questions_content', null, ['id' => 'questionAnswer','class' => 'validation_text']) !!}
                        <div class="row">
                            <div id='questions_content'>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-ms-6">
                                <label for="dtpick" style="margin:20px 0px 0px -15px">Which date do you need it</label>
                                <input style="margin: 0px 0 20px -15px;" class="datepicker bg-dtp validation_text" type="text" name='choose_date' id="dtpick"  data-date-format="mm/dd/yyyy" placeholder="Which date do you need it?">
                            </div>
                            <div class="add-info">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-10 col-ms-10">
                                        <label for="additional-info" style="margin:20px 0px 0px 0px">Add some additional information here</label>
                                        {!! Form::textarea('description', null, ['id' => 'additional-info', 'placeholder'=>'Additional information', 'class'=>'validation_text form-control', 'size' => '0x5']) !!}
                                    </div>
                                </div>
                                <div class="alert alert-danger error_content" style="display:none;margin-top:10px"></div>
                                <div class="user_img_upload">
                                    <img style="width:172px;margin-top:15px" id="user_img" src="/assets/img/old-camera_512px.png">
                                </div>
                                <div class="progress" style="display: none">
                                    <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                                <label for='photo' class="btn btn-success add-photo" style="margin-top:41px;">
                                    Add Photo's of your job (Optional)
                                    <input type="hidden" data='{{ csrf_token() }}' id='token_user'/>
                                    {!! Form::file('photo', array('id' => 'photo','class'=>'new_task','style'=> 'display:none')) !!}
                                    <input type="hidden" data='{{ csrf_token() }}' id='token_user'/>
                                    <input type="hidden" id='photo_name' class="validation_text" name='photo1'/>
                                </label>
                                @if(Auth::user())
                                    @if(Auth::user()->role == 'seeker')
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-ms-6">
                                            <label for="street-name" style="margin-top:20px;">Enter your address here</label>
                                            {!! Form::text('location', Auth::user()->city, ['id' => 'street-name', 'class' => 'validation_text form-control', 'placeholder' => 'Street name','style' => 'margin-top:0px']) !!}
                                        </div>
                                    </div>
                                    @endif
                                @else
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-ms-6">
                                            <label for="street-name" style="margin-top:20px;">Enter your address here</label>
                                            {!! Form::text('location', null, ['id' => 'street-name', 'class' => 'form-control validation_text', 'placeholder' => 'Street name','style' => 'margin-top:0px']) !!}
                                        </div>
                                    </div>
                                @endif    
                                <div class="row">
                                    <div class="col-xs-12 col-sm-10 col-ms-10 col-lg-8">
                                        <div class="map">
                                            <p>Choose your location on the map</p>
                                            <div class="tab-pane fade in" id="settings-1">  
                                                <div id="map_canvas" style="height: 300px;width: 100%;margin: 0.6em;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn btn-success form_submit">Book now</button>
                        </div> 

                         
                    {!! Form::close() !!}
                    </div>
                </div><!-- /task-options -->
            </div>
            <!--/task-questions-->
            <div class="button-book">  
            </div>
        </div>  
    </div>
</div>

@if(!Auth::user())     
<div class="log-in">
    <div class="container">
        <div class=" col-md-6 col-xs-12 col-sm-6 col-ms-8 col15-lg-7 col15-lg-offset-4 col-md-offset-3 col-sm-offset-3 col-ms-offset-2">
            <!-- Modal -->
            <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                  
                        <div class="login-modal">
                            <a href="#" aria-label="Close" class="close" data-dismiss="modal"><img src="{{asset('assets/img/CloseButton.png')}}" alt=""></a>
                            <h4>Log In</h4>
                            <h6 style="color:red" id='errors'></h6>
                            <div class="choose-tabs">
                            <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="as-who" class="active"><a href="#login-tab" aria-controls="login-tab" role="tab" data-toggle="tab">Log In</a></li>
                                    <li role="as-who"><a href="#signup-tab" aria-controls="signup-tab" role="tab" data-toggle="tab">Sign Up</a></li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="login-tab">
                                        <div class="log-in-popup">
                                            {!! Form::email('email', null, ['class' => 'form-control' , 'id' => 'form-username', 'placeholder' => 'E-mail', 'required' => 'required']) !!}
                                            {!! Form::input('password', 'password', null, ['class' => 'form-control' , 'id' => 'form-password', 'placeholder' => 'Password', 'required' => 'required']) !!}
                                            <div class="checkbox checkbox-success">
                                                <input type="checkbox" id="provider-checkbox3">
                                                <label for="provider-checkbox3">Stay logged in</label>
                                            </div>
                                            <div class="forgot-password">
                                                <a href="{{action('UsersController@getForgotPassword')}}">Forgot password?</a>
                                            </div>
                                            <div class="no-account">
                                                <p>No account?</p>
                                                <a href="{{action('UsersController@getRegistration')}}">Sign Up</a>
                                            </div>
                                            <div class="button-login">
                                                <button type="button" class="btn btn-success" id="login">Log in</button>
                                            </div>
                                        </div>
                          
                                    </div><!-- /#seeker-tab -->

                                    <div role="tabpanel" class="tab-pane" id="signup-tab">
                                        {!! Form::open(['action' => ['UsersController@postRegistration'],'files' => 'true','class' => 'seeker-form', 'role' => 'form', 'id' => 'registration']) !!}
                                        <div class="sign-up-top">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    {!! Form::text('username', null, ['class' => 'form-control' , 'id' => 'form-username', 'placeholder' => 'Username*', 'required' => 'required']) !!}
                                                </div>
                                                <div class="col-md-6">
                                                    {!! Form::email('email', null, ['class' => 'form-control' , 'id' => 'form-email', 'placeholder' => 'E-mail*', 'required' => 'required']) !!}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    {!! Form::input('password', 'password', null, ['class' => 'form-control' , 'id' => 'form-password', 'placeholder' => 'Password*', 'required' => 'required']) !!}
                                                </div>
                                                <div class="col-md-6">
                                                    {!! Form::input('password', 'password_confirmation', null, ['class' => 'form-control' , 'id' => 'form-confirm-password', 'placeholder' => 'Confirm password*', 'required' => 'required']) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="sign-up-bottom">
                                            <h5>Personal information</h5>
                                             <!--      <select class="form-control" id="select-city" required>
                                                                <option value="" disabled selected>Select your city*</option>
                                                                <option>1</option>
                                                                <option>2</option>
                                                                <option>3</option>
                                                                <option>4</option>
                                                              </select>
                                                              <select class="form-control" id="select-country" required>
                                                                <option value="" disabled selected>Select your country*</option>
                                                                <option>1</option>
                                                                <option>2</option>
                                                                <option>3</option>
                                                                <option>4</option>
                                                              </select> -->
                                            <input type="hidden" data='{{ csrf_token() }}' id='csrf'/>
                                            {!! Form::select('role', $role, ['' => ['label' => 'Please Select', 'disabled' => true]], ['id' => 'select-role', 'class' => 'form-control', 'required' => 'required']) !!}
                                            {!! Form::select('country', $countries, ['' => ['label' => 'Please Select', 'disabled' => true]], ['id' => 'select-country', 'class' => 'form-control country-select','required' => 'required']) !!}
                                            <select class="form-control" id="select-city" name='city'>
                                            </select>
                                            <div class="input-group" >
                                                {!! Form::hidden('zip_code', null, ['class' => 'form-control' , 'id' => 'zip_code', 'placeholder' => 'Zip code', 'required' => 'required']) !!}
                                                <span class="input-group-addon" id="sizing-addon2"></span>
                                                <input type="hidden" name="phone_prefix" value="" id="phone_code">
                                
                                                <input type="text" name="phone"  class="form-control" id="form-mobile" aria-describedby="city-code" placeholder="Mobile-number*" required="">

                                                {!! Form::text('company', null, ['class' => 'form-control' , 'id' => 'company', 'placeholder' => 'Company*', 'required' => 'required']) !!}

                                                {!! Form::text('website', null, ['class' => 'form-control' , 'id' => 'website', 'placeholder' => 'Website*', 'required' => 'required']) !!}

                                            </div>
                                            {!! Form::hidden('job_success', 'true', ['class' => 'form-control' ]) !!}
                                            <!--               <div class="row">
                                                            <div class="col-md-6">
                                                              <div class="input-group">
                                                                <span class="input-group-addon" id="city-code">+971</span>
                                                                <input type="text" class="form-control" id="form-mobile" aria-describedby="city-code" placeholder="Mobile-number*" required>
                                                              </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                              <input class="form-control" id="form-zipcode" placeholder="Zip code*" required>
                                                            </div>
                                                          </div> -->

                                        </div>
                                        <div class="terms-agreement">
                                            <div class="checkbox checkbox-success">
                                                <input type="checkbox" id="checkbox3" />
                                                <label for="checkbox3" >I agree to the terms of use <a href="{{action('TermsController@showPage')}}" target="_blank">Terms of use</a></label>
                                            </div>
                                        </div>
                                        <div class="button-signup">
                                            <button type="submit" class="btn btn-success sign_up">Sign up</button>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<div class="modal fade" id='myModal' tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content col-md-12">
            <p style="padding:10px;border-bottom:1px solid #333;color:#333">Do you have a same day requests?</p>
            <p style="text-align:center;padding:0px;color:#9B9B9B">Call this number to be connected</p>
            <p style="text-align:center;padding:0px;color:#9B9B9B">With a provider right away</p>
            <h2 style="text-align:center;padding:10px;color:#333">+97151234567</h2>
        </div>
    </div>
</div>



@stop
