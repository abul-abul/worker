@extends('app-user')
@section('content')
      <!-- CONTENT -->
        <div class="log-in">
            @if (!$errors->isEmpty())            
            <div class="alert alert-danger">
              <ul>
                <li>{{ $errors->first() }}</li>
              </ul>
            </div>
            @endif
            @if (Session::has('message'))
              <div class="alert alert-success">
                <ul>
                  <li>{{ Session::get('message') }}</li>
                </ul>
              </div>
            @endif
            @if (Session::has('message_err'))
              <div class="alert alert-danger">
                <ul>
                  <li>{{ Session::get('message_err') }}</li>
                </ul>
              </div>
            @endif
            <div class="container">
                  <div class=" col-md-4 col-xs-12 col-sm-6 col-ms-8 col-md-offset-4 col-sm-offset-3 col-ms-offset-2">
                    <div class="log-in-popup">
                      <a href="{{action('UsersController@getDashboard')}}"><img src="{{asset('assets/img/Close20Button.png')}}" ></a>
                      <h4>Forgot Password ?</h4>
                      {!! Form::open(['action' => ['UsersController@postForgotPassword'],'files' => 'true','class' => 'form-horizontal', 'role' => 'form' ]) !!}
                       {!! Form::email('email', null, ['class' => 'form-control' , 'id' => 'form-username', 'placeholder' => 'E-mail', 'required' => 'required']) !!}
                       
                          <div class="button-login">
                                <button type="submit" class="btn btn-success">Send</button>
                          </div>
                        {!! Form::close() !!} 
                    </div>
                  </div>
            </div><!-- /container -->
        </div><!-- /log-in -->
@stop   