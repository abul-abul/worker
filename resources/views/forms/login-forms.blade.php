{!! Form::open(['action' => ['UsersController@postLogin'],'files' => 'true','class' => 'form-horizontal', 'role' => 'form', 'id' => 'registration']) !!}
  {!! Form::email('email', null, ['class' => 'form-control' , 'id' => 'form-username', 'placeholder' => 'E-mail', 'required' => 'required']) !!}
  {!! Form::input('password', 'password', null, ['class' => 'form-control' , 'id' => 'form-password', 'placeholder' => 'Password', 'required' => 'required']) !!}
  <div class="terms-agreement" style="text-align: left;">
        <div class="checkbox checkbox-success">
          <input type="checkbox" id="checkbox3" name="remember_me">
          <label for="checkbox">Stay logged in</label>
        </div>
    </div>
  <div class="forgot-password">
    <a href="{{action('UsersController@getForgotPassword')}}">Forgot password?</a>
  </div>
  <div class="no-account">
    <p>No account?</p>
    <a href="{{action('UsersController@getRegistration')}}">Sign Up</a>
  </div>
  <div class="button-login">
        <button type="submit" class="btn btn-success">Log in</button>
  </div>
{!! Form::close() !!}  