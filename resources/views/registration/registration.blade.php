@extends('app-user')

@section('css')
    {!! Html::style( asset('assets/css/sign-up.css')) !!}
    {!! Html::style( asset('assets/css/main.css')) !!}
@stop

@section('scripts')
    {!! Html::script( asset('assets/js/registr_validation.main.js')) !!}
@endsection

@section('content')
@if (count($errors) > 0)
<div class="alert alert-danger" >
    <ul> 
    <li><b>Oops, something went wrong.</b></li>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="alert alert-danger validator_seeker" style="display:none;margin-bottom: 0px;"></div>
<div class="alert alert-danger validator_provider" style="display:none;margin-bottom: 0px;"></div>
<!-- CONTENT -->
        <div class="sign-up">
            <div class="container">
                  <div class=" col-md-6 col-xs-12 col-sm-6 col-ms-8 col15-lg-7 col15-lg-offset-4 col-md-offset-3 col-sm-offset-3 col-ms-offset-2">
                    <div class="sign-up-popup">
                      <a href="{{action('UsersController@getDashboard')}}"><img src="{{asset('assets/img/CloseButton.png')}}" alt=""></a>
                      <h4>Sign Up</h4>
                      @if($tab)
                        @include('registration.registration_provider') 
                      @else
                        @include('forms.registration-forms') 
                      @endif
                      
                    </div>
                  </div>
            </div><!-- /container -->
        </div><!-- /sign-up -->
@stop  
