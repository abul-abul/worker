@extends('app-user')
@section('css')
    {!! Html::style( asset('assets/css/main.css')) !!}
    {!! Html::style( asset('assets/cropper-master/dist/cropper.css')) !!}
    {!! Html::style( asset('assets/cropper-master/demo/css/main.css')) !!}
@stop
@section('content-provider')
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

    <div class="loader" style="z-index:9999;position:absolute;left:50%;top:50%">Loading...</div>
    <div class="alert alert-danger validator" style="display:none"></div>
    <div class="profile">
            <div class="container">
                <div class="row">
                    @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif 
                    <div class="hidden-xs col-sm-4 col-lg-3">
                        <div class="sidebar-menu">
                            <div class="panel-group">
                                <div class="panel panel-default">
                                    <!-- <div class="panel-heading">
                                        <h4 class="panel-title">Menu</h4>
                                    </div> -->
                                    <div id="menu" class="">
                                        <ul class="list-group">
                                            <li class="list-group-item"><a href="{{action('ProvidersController@getProfile')}}" style="text-decoration: none;">My profile</a></li>
                                            <li class="list-group-item"><a href="{{action('ProvidersController@getMyRequests')}}" style="text-decoration: underline;">My requests</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- /sidebar-menu -->
                    </div>
                    <div class="col-xs-12 col-sm-8 col-lg-9">
                        <div class="profile-expanded">
                            <h4>My profile <button type="button" class="btn btn-success" id="active_editing" style="float: right;">Edit</button><button type="button" class="btn btn-danger" id="stop_editing" style="float: right;display:none">Stop Editing</button></h4>
                            {!! Form::open(['action' => ['ProvidersController@postChangeProfile'],'files' => 'true','class' => 'form-horizontal save_edit', 'role' => 'form']) !!}
                            <div class="forms">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="row">
                                            <div class="col-xs-12 col-ms-6 col-sm-6">
                                                <label class="my_profile_label">First Name</label>
                                                {!! Form::text('first_name', $authUser->first_name, ['id' => 'form-name', 'placeholder'=>'First Name', 'class'=>'form-control edit_user']) !!}
                                            </div>
                                            <div class="col-xs-12 col-ms-6 col-sm-6">
                                                <label class="my_profile_label">Surname</label>
                                                {!! Form::text('surname', $authUser->surname, ['id' => 'form-surname', 'placeholder'=>'Surname', 'class'=>'form-control edit_user']) !!}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-ms-6 col-sm-6">
                                                <label class="my_profile_label">Location</label>
                                                {!! Form::text('location', $authUser->location, ['id' => 'form-control', 'placeholder'=>'Location', 'class'=>'form-control edit_user']) !!}
                                            </div>
                                            <div class="col-xs-12 col-ms-6 col-sm-6">
                                                <label class="my_profile_label">City</label>
                                                {!! Form::text('city', $authUser->city, ['id' => 'form-control', 'placeholder'=>'City', 'class'=>'form-control edit_user']) !!}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-ms-6 col-sm-6">
                                                <label class="my_profile_label">Country</label>
                                                {!! Form::text('country', $authUser->country, ['id' => 'form-control', 'placeholder'=>'Country', 'class'=>'form-control edit_user']) !!}
                                            </div>
                                            <div class="col-xs-12 col-ms-6 col-sm-6">
                                                <label class="my_profile_label">Phone</label>

                                            {!! Form::text('phone', $authUser->phone, ['id' => 'form-control', 'placeholder'=>'Phone', 'class'=>'form-control edit_user']) !!}                                      
                                            </div>
                                        </div>
                                        <!-- <div class="row">
                                            <div class="col-xs-12 col-ms-6 col-sm-6">
                                                {!! Form::text('pin', $authUser->zip_code, ['id' => 'form-control', 'placeholder'=>'Pin', 'class'=>'form-control edit_user']) !!}
                                            </div>
                                            <div class="col-xs-12 col-ms-6 col-sm-6">
                                            {!! Form::email('email', $authUser->email, ['id' => 'form-control', 'placeholder'=>'Email', 'class'=>'form-control', 'disabled']) !!}
                                            </div>
                                        </div> -->
                                        <div class="row">
                                            <div class="col-xs-12 col-ms-6 col-sm-6">
                                                <label class="my_profile_label">Company</label>

                                                {!! Form::text('company', $authUser->company, ['id' => 'form-control', 'placeholder'=>'Company', 'class'=>'form-control edit_user']) !!} 
                                            </div>
                                            <div class="col-xs-12 col-ms-6 col-sm-6">
                                                <label class="my_profile_label">Website</label>
                                                {!! Form::text('website', $authUser->website, ['id' => 'form-control', 'placeholder'=>'Website', 'class'=>'form-control edit_user']) !!}
                                            </div>
                                        </div>
                                        <label class="my_profile_label">Brief description</label>
                                        {!! Form::textarea('description', $authUser->description, ['id' => 'brief-description', 'placeholder'=>'Brief description', 'class'=>'form-control edit_user', 'size' => '0x5']) !!}
                                        <!-- <div class="col-xs-12 col-ms-6 col-sm-6 "> -->
                                            
                                           <div class="alert alert-danger error_content" style="display:none;margin-top:10px"></div>
                                           <div style="margin: 20px 0px 20px 0px;" class="profile_img">
                                                @if(Auth::user()->profile_img != "")
                                                    <img class="prof" style="width:190px" src="/assets/uploads/{{Auth::user()->profile_img}}">
                                                @else
                                                    <img class="prof" style="width:172px;margin-top: 20px;margin-bottom:15px" src="/assets/img/user_512px.png">
                                                @endif
                                                    <div class="progress" style="display: none">
                                                        <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                            </div>
                                            <label for='photo' class="btn btn-success add-photo" >
                                             <input type="hidden" data='{{ csrf_token() }}' class='tok'/>
                                                    Add Photo
                                                    {!! Form::file('profile_img', array('id' => 'photo', 'class' => 'img_prof edit_user','style'=> 'display:none')) !!}
                                                    <input type="hidden" id='photo_name' class="validation_text" name='photo1'/>
                                            </label>
                                        <!-- </div> -->
                                    </div>
                                </div>
                            </div><!-- /forms -->
                        </div><!-- /profile-expanded -->
                            <div class="profile-categories">
                            {!! Form::select('category', $categories, ['' => ['label' => 'Please Select', 'disabled' => 'disabled']], ['id' => 'select_category', 'class' => 'form-control edit_user']) !!}
                                <div class="row" id="categories_content"> 
                                    @foreach($selectedCategory as $key => $value)
                                        <div class='col-md-5 col-xs-12 col-ms-6 col-sm-6 toclose'>
                                            <div class='category edit_user'><a href='#'>{{$value}}</a>
                                            <img src='/assets/img/profile/Removecategory.png' alt="{{$key}}" class='remove'>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>   
                            {!! Form::hidden('name', $countCategory,array('id' => 'category_count')) !!}
                            </div><!-- /profile-categories -->
                            <input type="hidden" data='{{ csrf_token() }}' id='csrf'/>
                            <div class="profile-available">
                                <div class="row">
                                    <div class="col-md-3 col-xs-12 col-ms-4">
                                        <div class="checkbox checkbox-success">
                                            <input type="checkbox" id="checkbox1" class="edit_user">
                                            <label for="checkbox1">Available 24/7</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-xs-12 col-ms-4">
                                       <div class="checkbox checkbox-success">
                                            <input type="checkbox" id="checkbox2" class="edit_user">
                                            <label for="checkbox2">SMS notification</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-xs-12 col-ms-4">
                                        <div class="checkbox checkbox-success">
                                            <input type="checkbox" id="checkbox3" class="edit_user">
                                            <label for="checkbox3">Email notification</label>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /profile-available -->
                        <div class="button-save">
                            <button type="submit" class="btn btn-success edit_user">Save</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div><!-- /container -->
        </div><!-- /profile -->
@stop
@section('scripts')
    {!! Html::script(asset('assets/cropper-master/dist/cropper.js')) !!}
@stop