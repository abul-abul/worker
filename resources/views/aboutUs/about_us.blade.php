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

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  
  <body>
    <div class="landing">

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
      <div class="how-to">
        <div class="container">
          <h1 class="title h1padding">ABOUT MR SHASHA</h1><br><br>     
          <p> 
              Mr ShaSha is the leading online platform for connecting service seekers looking for

              professional services with quality, pre-screened independent service providers.<br><br>

              From hairstylists to handyman services, Mr ShaSha matches thousands of

              customers every week with trusted professionals in many major cities across Africa.<br><br>

              It takes less than 1 minute to do a booking with Mr ShaSha. On top of that, it is

              secure and FREE of CHARGE!<br><br>

              Mr ShaSha is simply the easiest and most convenient way to book professional

              service providers in your city.

              <h2>OUR STORY</h2>

              Mr ShaSha was founded in April 2015 by two friends who wanted to find a practical

              solution to one of our key problems in life: finding trusted, reliable service providers

              at a low charge.<br><br>

              The founders' passion with Africa has driven the concept for this platform to be

              launched in Africa. At the same time, the business idea was born on the back of a

              necessity for finding good service providers at low costs. The founders spent time

              talking to people from various different countries and one common scheme arose-

              people did not struggle to find service providers, but they had problems finding them

              at competitive pricing. In fact, price offers do differ in many cases substantially. As a

              result, they developed Mr ShaSha to provide a platform with the goal of building the

              easiest, most convenient way for people to book professional services.
          </p>

          </div>
      </div><!-- /how-to -->
       
      
      
        @include('partial.footer')
    
      </div><!-- /landing-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    
  </body>
</html>
 