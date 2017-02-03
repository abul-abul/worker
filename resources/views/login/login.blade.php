@extends('app-user')
@section('content')
      <!-- CONTENT -->
        <div class="log-in">
            <div class="container">
                  <div class=" col-md-4 col-xs-12 col-sm-6 col-ms-8 col-md-offset-4 col-sm-offset-3 col-ms-offset-2">
                    <div class="log-in-popup">
                      <a href="{{action('UsersController@getDashboard')}}"><img src="{{asset('assets/img/CloseButton.png')}}" ></a>
                      <h4>Log In</h4>
                      @if(session('error'))
                      <div class="alert alert-danger">
                        {{ session('error') }}
                      </div>
                      @endif
                      @include('forms.login-forms')
                    </div>
                  </div>
            </div><!-- /container -->
        </div><!-- /log-in -->
@stop        