<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="shortcut icon" href="#" type="image/x-icon">
    <title>Mr Shasha</title>
    
    <!-- Bootstrap -->
    {!! Html::style( asset('assets/css/bootstrap.min.css')) !!}
    {!! Html::style( asset('assets/css/bootstrap_col_15.css')) !!}
    {!! Html::style( asset('assets/css/bootstrap_ms.css')) !!}
    {!! Html::style( asset('assets/css/font-awesome.min.css')) !!}
    {!! Html::style( asset('assets/css/bs-checkbox.css')) !!}
    {!! Html::style( asset('assets/css/style.css')) !!}

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  
  <body>
   
<!--HEADER-CONTENT  -->
       
        <div class="header-content">
            <div class="container">
                <h3>Mr Shasha</h3>
                <div class="hidden-xs">
                    <ul>
                        <li><a href="{{action('UsersController@getLogin')}}">Log in</a></li>
                        <li><a href="{{action('UsersController@getRegistration')}}">Sign up</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
                <div class="mobile-menu visible-xs">
                    <a href="#"><span class="glyphicon glyphicon-align-justify"></span></a>
                </div>
                <div class="menu">
                    <h3>Mr Shasha</h3>
                    <ul>
                        <li><a href="#">Log in</a></li>
                    </ul>
                </div><!-- /menu -->
            </div>
        </div><!-- /header-content -->

      <!-- CONTENT -->
        <div class="log-in">
            @if (!$errors->isEmpty())
              <p class="error">{{ $errors->first() }}</p>
            @endif
            @if (Session::has('message'))
                <p class="success">
                    {{ Session::get('message') }}   
                </p>
            @endif
            <div class="container">
                  <div class=" col-md-4 col-xs-12 col-sm-6 col-ms-8 col-md-offset-4 col-sm-offset-3 col-ms-offset-2">
                    <div class="log-in-popup">
                      <a href="#"><img src="{{asset('assets/img/Close20Button.png')}}" ></a>
                      <h4>Reset Password </h4>
                      {!! Form::open(['action' => ['UsersController@postSetNewPassword', '$hash'],'files' => 'true','class' => 'form-horizontal', 'role' => 'form' ]) !!}
                      {!! Form::input('password', 'password', null, ['class' => 'form-control' , 'id' => 'form-password', 'placeholder' => 'Password', 'required' => 'required']) !!}
                      {!! Form::input('password', 'password_confirmation', null, ['class' => 'form-control' , 'id' => 'form-confirm-password', 'placeholder' => 'Confirm password', 'required' => 'required']) !!}
                      <input type="hiiden" value='{{$hash}}' name="hash" style="display:none" />
                          <div class="button-login">
                                <button type="submit" class="btn btn-success">Reset</button>
                          </div>
                        {!! Form::close() !!} 
                    </div>
                  </div>
            </div><!-- /container -->
        </div><!-- /log-in -->
        
<!-- FOOTER -->
        
        <div class="footer">
            <div class="container">
                <div class="footer-top">
                    <ul>
                        <li><a href="#">About</a></li>
                        <li><a href="#">Legal Ingormation</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">Terms Of Service</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div><!-- /footer-top -->
                <div class="footer-bottom">
                    <p>&#169 2015 Mr Shasha All rights reserved</p>
                </div><!-- /footer-bottom -->
            </div><!-- /container footer -->
        </div><!-- /footer -->
        
    
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    {!! Html::script( asset('assets/js/jquery-2.1.4.min.js')) !!}
    {!! Html::script( asset('assets/js/main.js')) !!}
    {!! Html::script( asset('assets/js/script.js')) !!}
    {!! Html::script( asset('assets/js/Chart.js')) !!}
    {!! Html::script( asset('assets/js/Chart.Bar.js')) !!}

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    {!! Html::script( asset('assets/js/bootstrap.min.js')) !!}

    @yield('scripts')
  </body>
</html>