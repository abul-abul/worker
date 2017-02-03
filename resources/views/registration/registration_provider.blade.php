@if(Session::has('error_danger'))
<div class="alert alert-danger">
 {{Session::get('error_danger')}}
</div>
@endif

<div class="choose-tabs">
    <!-- Nav tabs -->
    
    <ul class="nav nav-tabs" role="tablist">
        <li role="as-who" id="tab_seeker"><a href="#seeker-tab" aria-controls="seeker-tab" role="tab" data-toggle="tab">as a Seeker <br> I'm looking for</a></li>
        <li role="as-who" class="active" id="tab_provider"><a href="#provider-tab" aria-controls="provider-tab" role="tab" data-toggle="tab">as a Provider <br> I can do</a></li>
    </ul>
    

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane" id="seeker-tab">
   
            {!! Form::open(['action' => ['UsersController@postRegistration'],'files' => 'true','class' => 'form-horizontal', 'role' => 'form', 'id' => 'registration_seeker']) !!}
            <div class="sign-up-top">
                <div class="row">
                    <div class="col-md-6">
                        {!! Form::text('username', null, ['class' => 'form-control seeker_validation' , 'id' => 'form-username', 'placeholder' => 'Username*', 'required' => 'required']) !!}
                    </div>
                    <div class="col-md-6">
                        {!! Form::email('email', null, ['class' => 'form-control seeker_validation' , 'id' => 'form-email', 'placeholder' => 'E-mail*', 'required' => 'required']) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        {!! Form::input('password', 'password', null, ['class' => 'form-control seeker_validation' , 'id' => 'form-password', 'placeholder' => 'Password*', 'required' => 'required']) !!}
                    </div>
                    <div class="col-md-6">
                        {!! Form::input('password', 'password_confirmation', null, ['class' => 'form-control seeker_validation' , 'id' => 'form-confirm-password', 'placeholder' => 'Confirm password*', 'required' => 'required']) !!}
                    </div>
                </div>
            </div>
            <div class="sign-up-bottom">
                <h5>Personal information</h5>
                <input type="hidden" class="seeker_validation" name="role" value="seeker">
                {!! Form::select('country', $coutries, ['' => ['label' => 'Please Select', 'disabled' => true]], ['id' => 'select-country', 'class' => 'form-control seeker_validation country-select','required' => 'required']) !!}
                <select class="form-control seeker_validation" id="select-city" name='city'>
                </select>   
                <div class="input-group">
                    <span class="input-group-addon" id="sizing-addon2">+971</span>
                    <input type="hidden" name="phone_prefix" value="" id="phone_code" class="seeker_validation">
                    <input type="text" name="phone" class="form-control seeker_validation" id="form-mobile" aria-describedby="city-code" placeholder="Mobile-number*" required>
                </div>
            
                {!! Form::text('zip_code', null, ['class' => 'form-control seeker_validation' , 'id' => 'zip_code', 'style' => 'display:none', 'required' => 'required']) !!}   
                </div>
            <div class="terms-agreement">
                <div class="checkbox checkbox-success">
                    <input type="checkbox" id="checkbox3" />
                    <label for="checkbox3">I agree to the terms of use <a href="{{action('TermsController@showPage')}}" target="_blank">Terms of use</a></label>
                </div>
            </div>
            <div class="button-signup">
                <button type="button" class="btn btn-success sign_up_seeker">Sign up</button>
            </div>
            {!! Form::close() !!}
        </div>


        <div role="tabpanel" class="tab-pane active" id="provider-tab">
        
            {!! Form::open(['action' => ['UsersController@postRegistration'],'files' => 'true','class' => 'form-horizontal', 'role' => 'form', 'id' => 'registration_provider']) !!}
            <div class="sign-up-top">
                <div class="row">
                    <div class="col-md-6">
                        {!! Form::text('username', null, ['class' => 'form-control provider_validation' , 'id' => 'form-username', 'placeholder' => 'Username*', 'required' => 'required']) !!}
                    </div>
                    <div class="col-md-6">
                        {!! Form::email('email', null, ['class' => 'form-control provider_validation' , 'id' => 'form-email', 'placeholder' => 'E-mail*', 'required' => 'required']) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        {!! Form::input('password', 'password', null, ['class' => 'form-control provider_validation' , 'id' => 'form-password', 'placeholder' => 'Password*', 'required' => 'required']) !!}
                    </div>
                    <div class="col-md-6">
                        {!! Form::input('password', 'password_confirmation', null, ['class' => 'form-control provider_validation' , 'id' => 'form-confirm-password', 'placeholder' => 'Confirm password*', 'required' => 'required']) !!}
                    </div>
                </div>
            </div>
            <div class="sign-up-bottom">
                <h5>Personal information</h5>
                <input type="hidden" name="role" value="provider" class="provider_validation">
                {!! Form::select('country', $coutries, ['' => ['label' => 'Please Select', 'disabled' => true]], ['id' => 'select-country', 'class' => 'form-control country-select-provider provider_validation','required' => 'required']) !!}
                <select class="form-control provider_validation" id="select-city-provider" name='city'>
                </select>
                <div class="input-group">
                    <span class="input-group-addon" id="sizing-addon2-provider">+971</span>
                    <input type="hidden" name="phone_prefix" value="" id="phone_code_provider" class="provider_validation">
                    <input type="text" name="phone" class="form-control provider_validation" id="form-mobile" aria-describedby="city-code" placeholder="Mobile-number*" required>
                </div>
                {!! Form::text('zip_code', null, ['class' => 'form-control provider_validation' , 'id' => 'zip_code_provider', 'style' => 'display:none', 'required' => 'required']) !!}
                <input type="text" name="company" class="form-control provider_validation" id="form-provider-company" placeholder="Company">
                <input type="text" name="website" class="form-control provider_validation" id="form-provider-websire" placeholder="Website">
            </div>
            <div style="margin-bootom:20px;position:relative">
                <div class="profile sign-up-bottom" style="background:#fff">
                    {!! Form::select('category', $categories, null, ['id' => 'category', 'class' => 'form-control']) !!}
                    <div class="profile-categories" id="category_child_content" style="display:none">
                        <div id="category_content"></div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="categoryData" value="" id="categoryData">
            
            <div class="checkbox checkbox-success col-md-12">
                <input type="checkbox" id="checkbox4"/>
                <label for="checkbox3">I agree to the terms of use <a href="{{action('TermsController@showPage')}}" target="_blank">Terms of use</a></label>
            </div>
            
            <div class="button-signup">
                <button type="button" class="btn btn-success sign_up_provider">Sign up</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div><!-- /#seeker-tab -->
        
    </div>
</div>
<input type="hidden" data='{{ csrf_token() }}' id='token_user'/>