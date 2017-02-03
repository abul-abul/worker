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
      <div class="services">
        <div class="container">
          <div class="row">
            <div class="col-md-2 col-lg-2 col-xs-12"></div>
            <div class="col-sm-12 col-md-8 col-lg-8 col-xs-12">
              <div class="marketplace">
                <div class="name">
                  <h1><b>Africa's <span class="orange">#<img src="{{ asset('assets/img/1-logo.png')}}" alt=""></span> Marketplace for Services</b></h1>
                  <h3>Receive FREE offers!</h3>
                </div>
                <div class="icons clearfix">
                @foreach($categories as $category)
                    <div class="service-link">
                      <a href="{{action('SeekersController@getNewTask', $category->id)}}" class="service service{{$category->id}} col-md-1">
                        <div class="icon icon{{$category->id}}"></div>
                        <p>{{$category->name}}</p>
                      </a>
                    </div>
                @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
      </div><!-- /services -->

      <div class="how-to" id="how_to_container">
        <div class="container">
          <h1 class="title">How it works</h1>
          <div class="row">
            <div class="col-sm-4 col-xs-12">
              <div class="number">1</div>
              <img  src="{{ asset('assets/img/screen1.png')}}" alt="" class='img-responsive'>
              <h2>Choose a Service Category & Post Your Request</h2>
            </div>
            <div class="col-sm-4 col-xs-12">
              <div class="number">2</div>
              <img src="{{ asset('assets/img/screen2.png')}}" alt="" class='img-responsive'>
              <h2>Receive Quotes & Compare Providers</h2>
            </div>
            <div class="col-sm-4 col-xs-12">
              <div class="number">3</div>
              <img  src="{{ asset('assets/img/screen3.png')}}" alt="" class='img-responsive'>
              <h2>Hire the BEST Provider!</h2>
            </div>
          </div>
        </div>
      </div><!-- /how-to -->
       
      <div class="create-profile">
         <div class="container">
            <a href="#"><img src="{{ asset('assets/img/africa.png')}}" alt="" class="img-left hidden-xs"></a>
            <a href="#"><img  src="{{ asset('assets/img/Mr-Shasha(character).png')}}" alt="" class="img-right hidden-xs"></a>
            <h1 class="title">Want to become a <img  src="{{ asset('assets/img/logo-small.png')}}" alt=""></h1>
            <p class="white">Calling all Service Providers across AFRICA... this is your opportunity to <br>
                              connect with THOUSANDS of potential customers</p>
            <p>Create your own Business Profile, Receive Jobs and Send Quotes</p>
            <a href="{{action('UsersController@getRegistration',['UAuILc.GbuZFAiTwV5cc.p2YPkuTIls4qNbSm'])}}"><button type="button" class="red-button">Click to SIGN UP NOW <br>It's FREE !</button></a>
         </div>
      </div><!-- /create-profile -->

      <div class="responds">
        <div class="container">
          <h1 class="title">Words from Our Customers</h1>
          <div class="row">
            <div class="col-sm-6 col-md-4 col-xs-12">
              <div class="feedback clearfix">
                <div class="work-type type1">
                  <div class="fade-bg">
                    <div class="icon"></div>
                    <div class="hired">
                      <p>Hired a Provider</p>
                      <span>Packing & moving</span>
                    </div>
                  </div>
                </div>
                <div class="work-description">
                  <p>XYZ Movers provided an excellent service with full wrapping and all items were handled with maximum care!</p>
                  <div class="stars"></div>
                </div>
                <div class="user">
                  <img  src="{{ asset('assets/img/ref1.jpg')}}" alt="">
                  <p>Greame joe</p>
                  <span class="blue">Marking Manager</span>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-md-4 col-xs-12">
              <div class="feedback clearfix">
                <div class="work-type type2">
                  <div class="fade-bg">
                    <div class="icon"></div>
                    <div class="hired">
                      <p>Hired a Provider</p>
                      <span>Pest Control</span>
                    </div>
                  </div>
                </div>
                <div class="work-description">
                  <p>Eliphas completed the job for lower than his estimated price. He was prompt, communicated well and always answered my calls.</p>
                  <div class="stars"></div>
                </div>
                <div class="user">
                  <img src="{{ asset('assets/img/ref2.jpg')}}" alt="">
                  <p>Greame joe</p>
                  <span class="blue">Marking Manager</span>
                </div>
              </div>
            </div>
            <div class="hidden-sm col-md-4 col-xs-12">
              <div class="feedback clearfix">
                <div class="work-type type3">
                  <div class="fade-bg">
                    <div class="icon"></div>
                    <div class="hired">
                      <p>Hired a Provider</p>
                      <span>Cleaning and Housekeeping</span>
                    </div>
                  </div>
                </div>
                <div class="work-description">
                  <p>I was surprised by how well the work went. XYZ Cleaning Services were professional and trustworthy. I had a truly good experience.</p>
                  <div class="stars"></div>
                </div>
                <div class="user">
                  <img src="{{ asset('assets/img/ref3.jpg')}}" alt="">
                  <p>Greame joe</p>
                  <span class="blue">Marking Manager</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div><!-- /responds -->
      
      <div class="statistic">
        <div class="container">
          <h1 class="title white">Our Story in Numbers</h1>
          <div class="row">
            <div class="col-xs-4">
              <div class="counter">
                <div class="sprite"></div>
                <span class="count">2,365</span>
                <span class="hash"># of satisfied customers</span>
              </div>
            </div>
            <div class="col-xs-4">
              <div class="counter">
                <div class="sprite sprite2"></div>
                <span class="count">2,365</span>
                <span class="hash big"># of satisfied customers</span>
              </div>
            </div>
            <div class="col-xs-4">
              <div class="counter">
                <div class="sprite sprite3"></div>
                <span class="count">2,365</span>
                <span class="hash"># of satisfied customers</span>
              </div>
            </div>
          </div>
          <h4>...and multiplying</h4>
        </div>
      </div><!-- /statistic -->

      @include('partial.footer')
    
    </div><!-- /landing-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    {!! Html::script( asset('assets/js/jquery-2.1.4.min.js')) !!}

    <!-- {!! Html::script( asset('assets/js/script.js')) !!} -->

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    {!! Html::script( asset('assets/js/bootstrap.min.js')) !!}
    <script type="text/javascript">
        $(document).ready(function(){
            $('#how_it_works').click(function(){
            var howToPlayTop = document.getElementById('how_to_container').offsetTop;
            $('html, body').animate({
               scrollTop: howToPlayTop
            }, 1000);
        })
      })
    </script>
    @if(Session::has('howTo'))
    <script type="text/javascript">
        $(document).ready(function(){
            var howToPlayTop = document.getElementById('how_to_container').offsetTop;
            $('html, body').animate({
                scrollTop: howToPlayTop
            }, 1000);
      })
    </script>
    @endif
  </body>
</html>