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
    {!! Html::style( asset('assets/css/new-styles.css')) !!}

    {!! Html::style( asset('assets/css/landing-style.css')) !!}
    @yield('css')

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>
  
  <body>
   <div class="landing">

<!--HEADER-CONTENT  -->
    <div class="header-content">
            <div class="container">
            @if(Auth::user())
                @if(Auth::user()->role == 'provider')
                    <img src="{{ asset('assets/img/logo.png')}}"  alt="" class="logo">
                @endif
                @if(Auth::user()->role == 'seeker')
                    <img src="{{ asset('assets/img/logo.png')}}"  alt="" class="logo">
                @endif
            @endif     
                @if(Auth::user())
                    <div class="hidden-xs">
                    <ul>
                        <li><a href="{{action('UsersController@getLogout')}}">Log out</a></li>
                        <li><a href="{{action('ContactController@showPage')}}">Contact</a></li>
                    </ul>
                    </div>
                @else
                <img src="{{ asset('assets/img/logo.png')}}"  alt="" class="logo">
                <div class="hidden-xs">
                    <ul>
                        <li><a href="{{action('UsersController@getLogin')}}">Log in</a></li>
                        <li><a href="{{action('UsersController@getRegistration')}}">Sign up</a></li>
                        <li><a href="{{action('ContactController@showPage')}}">Contact</a></li>
                    </ul>
                </div>
                <div class="mobile-menu visible-xs">
                    <a href="#"><span class="glyphicon glyphicon-align-justify"></span></a>
                </div>
                <div class="menu">
                    <h3>Mr Shasha</h3>
                    <ul>
                        <li><a href="{{action('UsersController@getLogin')}}">Log in</a></li>
                        <li><a href="{{action('UsersController@getRegistration')}}">Sign up</a></li>
                        <li><a href="{{action('ContactController@showPage')}}">Contact</a></li>
                    </ul>
                </div><!-- /menu -->
                @endif
                    <div class="mobile-menu visible-xs">
                        <a href="#"><span class="glyphicon glyphicon-align-justify"></span></a>
                    </div>
                    @if(Auth::user() && Auth::user()->role == 'provider')
                       <div class="menu">
                        <h3>Mr Shasha</h3>
                        <ul class="list-group">
                            <li><a href="{{action('ProvidersController@getProfile')}}">My profile</a></li>
                            <li><a href="{{action('ProvidersController@getMyRequests')}}">My requests</a></li>
                        </ul>
                        <ul>
                            <li><a href="{{action('UsersController@getLogout')}}">Log out</a></li>
                            <li><a href="{{action('ContactController@showPage')}}">Contact</a></li>
                        </ul>
                        </div><!-- /menu -->
                    @elseif(Auth::user() && Auth::user()->role == 'seeker')
                        <div class="menu">
                        <h3>Mr Shasha</h3>
                        <ul class="list-group">
                            <li><a href="{{action('SeekersController@getProfile')}}">My profile</a></li>
                            <li><a href="{{action('SeekersController@getNewTask')}}">Create New Task</a></li> 
                            <li><a href="{{action('SeekersController@getMyTasks')}}">My Tasks</a></li>
                        </ul>
                        <ul>
                            <li><a href="{{action('UsersController@getLogout')}}">Log out</a></li>
                            <li><a href="{{action('ContactController@showPage')}}">Contact</a></li>
                        </ul>
                        </div><!-- /menu -->
                    @else 
                    <div class="mobile-menu visible-xs">
                        <a href="#"><span class="glyphicon glyphicon-align-justify"></span></a>
                    </div>
                    <div class="menu">
                        <h3>Mr Shasha</h3>
                        <ul>
                            <li><a href="{{action('UsersController@getLogin')}}">Log in</a></li>
                            <li><a href="{{action('UsersController@getRegistration')}}">Sign up</a></li>
                            <li><a href="{{action('ContactController@showPage')}}">Contact</a></li>
                        </ul>
                    </div><!-- /menu -->
                    @endif

            </div>
        </div><!-- /header-content -->
@yield('content')
@if(Auth::user() && Auth::user()->role == 'provider')
    @yield('content-provider')
@elseif(Auth::user() && Auth::user()->role == 'seeker')
    @yield('content-seeker')
@elseif (Auth::user() && Auth::user()->role == 'admin')
    @yield('admin-users')
@endif
    @yield('content-seeker-new-task')

@include('partial.footer')
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    {!! Html::script( asset('assets/js/jquery-2.1.4.min.js')) !!}
    {!! Html::script( asset('assets/js/bootstrap.min.js')) !!}
    @yield('scripts')
    {!! Html::script( asset('assets/js/main.js')) !!}
    <script type="text/javascript">
        $(document).ready(function(){
            $('.mobile-menu a').click(function () {
                $('body').toggleClass('menu-show');
            });
        })
    </script>
    @if(!isset($reg))
        {!! Html::script( asset('assets/js/script.js')) !!}
        {!! Html::script( asset('assets/js/Chart.js')) !!}
        {!! Html::script( asset('assets/js/Chart.Bar.js')) !!}
    @endif
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    
    
</body>
</html>