@extends('app-user')
@section('content-provider')
<div class="my-account">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-4 col-lg-3">
                        <div class="sidebar-menu hidden-xs">
                            <div class="panel-group">
                                <div class="panel panel-default">
                                    
                                    <div id="menu" class="">
                                        <ul class="list-group">
                                            <li class="list-group-item"><a href="{{action('ProvidersController@getProfile')}}" style="text-decoration: underline;">My profile</a></li>
                                       
                                            <li class="list-group-item"><a href="{{action('ProvidersController@getMyRequests')}}" style="text-decoration: underline;">My requests</a></li>
                                
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- /sidebar-menu -->
                    </div>
                    
                    <div class="col-xs-12 col-sm-8 col-lg-9">
                        <div class="account-responds">
                            <p>You can respond to 5 leads</p>
                            <a href="">Buy More</a>
                        </div><!-- account-responds -->
                        
                        <div class="account-histograms">
                          <h4>My account</h4>
                          <div class="histogram">
                            <canvas id="canvas" height="150"></canvas>
                          </div>
                        </div>
                        
                        <div class="account-rating">
                          <p>Requests used this month:</p>
                          <p>Requests used this year:</p>
                          <p>My average rating:        <img src="{{asset('assets/img/3%20stars.png')}}" alt=""></p>
                        </div>
                        <div class="account-reviews">
                            <h4>My reviews</h4>
                            
                            <div class="request-line">
                                <div class="row">
                                    <div class="col-sm-3 col-xs-12 col-ms-3">
                                        <div class="request-name">
                                            <h5>Request 2116</h5>
                                            <p>Pest Control</p>
                                        </div><!-- /request-name -->
                                    </div>
                                    <div class="col-sm-6 col-xs-12 col-ms-6">
                                        <div class="request-info">
                                            <h5>Peter Smit</h5>
                                            <p>Deal with isects in my kitchen</p>
                                        </div><!-- /request-info -->
                                    </div>
                                    <div class="col-sm-3 col-xs-12 col-ms-3">
                                        <div class="date-location">
                                            <img src="{{asset('assets/img/3%20stars.png')}}" alt="">
                                            <p>Zimbabwe, Harare</p>
                                        </div><!-- date-location -->
                                    </div>
                                </div>
                            </div><!-- /request-line -->
                            
                            <div class="request-line">
                                <div class="row">
                                    <div class="col-sm-3 col-xs-12 col-ms-3">
                                        <div class="request-name">
                                            <h5>Request 2116</h5>
                                            <p>Pest Control</p>
                                        </div><!-- /request-name -->
                                    </div>
                                    <div class="col-sm-6 col-xs-12 col-ms-6">
                                        <div class="request-info">
                                            <h5>Peter Smit</h5>
                                            <p>Deal with isects in my kitchen</p>
                                        </div><!-- /request-info -->
                                    </div>
                                    <div class="col-sm-3 col-xs-12 col-ms-3">
                                        <div class="date-location">
                                            <img src="{{asset('assets/img/4%20stars.png')}}" alt="">
                                            <p>Zimbabwe, Harare</p>
                                        </div><!-- date-location -->
                                    </div>
                                </div>
                            </div><!-- /request-line -->
                            
                            <div class="request-line">
                                <div class="row">
                                    <div class="col-sm-3 col-xs-12 col-ms-3">
                                        <div class="request-name">
                                            <h5>Request 2116</h5>
                                            <p>Pest Control</p>
                                        </div><!-- /request-name -->
                                    </div>
                                    <div class="col-sm-6 col-xs-12 col-ms-6">
                                        <div class="request-info">
                                            <h5>Peter Smit</h5>
                                            <p>Deal with isects in my kitchen</p>
                                        </div><!-- /request-info -->
                                    </div>
                                    <div class="col-sm-3 col-xs-12 col-ms-3">
                                        <div class="date-location">
                                            <img src="{{asset('assets/img/3%20stars.png')}}" alt="">
                                            <p>Zimbabwe, Harare</p>
                                        </div><!-- date-location -->
                                    </div>
                                </div>
                            </div><!-- /request-line -->
                        </div><!-- /account-reviews -->
                    </div>
                </div>
            </div><!-- /container -->
        </div><!-- /my-account -->
@stop        