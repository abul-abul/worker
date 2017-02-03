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
    {!! Html::style( asset('assets/css/landing-style.css')) !!}
    {!! Html::style( asset('assets/css/landing-contacts.css')) !!}

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  
  <body>
    <div class="contacts">

     <!--HEADER -->
      
       <header>
        <div class="container">
          <img src="{{ asset('assets/img/logo-small.png')}}" alt="" class="img-responsive logo hidden-xs">
          <img src="{{ asset('assets/img/logo-small.png')}}" alt="" class="img-responsive logo visible-xs">
          <a href="{{action('UsersController@getLogin')}}"><button type="button" class="red-button">Login</button></a>
          <a href="{{action('UsersController@getRegistration')}}"><button type="button" class="red-button">Sign Up</button></a>
        </div>
      </header>
        
<!-- CONTENT -->
      <div class="container">
          <div class="content">
              <h4>Contact</h4>
              <p>For general feed back or suggestions fell free to contact us via the form below. Or send a mail to info@mrshasha.com</p>
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
              {!! Form::open(['action' => ['ContactController@postSendEmail'],'files' => 'true','class' => 'contact-form', 'role' => 'form']) !!}

                  <div class="row">
                      <div class="col-xs-12 col-sm-6">
                          <p>First and last name</p>
                          <input name='full_name' type="text" placeholder="First and last name">
                      </div>
                      <div class="col-xs-12 col-sm-6">
                          <p>Email adress</p>
                          <input name="email" type="text" placeholder="Email adress">
                      </div>
                      <div class="col-xs-12">
                          <p>Subject</p>
                          <input name='subject' type="text" placeholder="Subject">
                      </div>
                      <div class="col-xs-12">
                          <p>Message</p>
                          <textarea name="message" id="msg" cols="30" rows="10" placeholder="Message"></textarea>
                      </div>
                      <div class="col-xs-12">
                          <button type="submit" class="btn btn-success add-photo">Send</button>
                      </div>
                  </div>
              {!! Form::close() !!}
              <p><b>Managment team</b></p>
              <p>Saurabh Mittal - Founder<br>
                saurabh@mrshasha.com</p>
                <p>Hubertus von Drabich - Founder<br>
                hubi@mrshasha.com</p>
          </div>
      </div>
      
      
<!-- FOOTER -->
        
        @include('partial.footer')
    
      </div><!-- /landing-->
  </body>
</html>