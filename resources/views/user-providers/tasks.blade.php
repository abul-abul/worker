@extends('app-user')
@section('content-provider')      
        <div class="jobs">
            <div class="container">
                <div class="row">
                    <div class="hidden-xs col-sm-4 col-lg-3">
                        <div class="sidebar-menu">
                            <div class="panel-group">
                                <div class="panel panel-default">
                                    <!-- <div class="panel-heading">
                                        <h4 class="panel-title">Menu</h4>
                                    </div>  -->
                                    <div id="menu" class="">
                                        <ul class="list-group">
                                            <li class="list-group-item"><a href="{{action('ProvidersController@getProfile')}}" style="text-decoration: underline;">My profile</a></li>
                                    
                                            <li class="list-group-item"><a href="{{action('ProvidersController@getMyRequests')}}" style="text-decoration: none;">My requests</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- /sidebar-menu -->
                    </div>
                    <div class="col-xs-12 col-sm-8 col-lg-9">
                        <div class="row">
                            <div class="tasks">
                            @foreach($tasks as $task)
                                <div class="row">
                                    <div class="col-xs-12 col-md-6">
                                        <div class="task">
                                            <h4>{{$task->task_name}}</h4>
                                            <div class="task-content">
                                                <img src="../img/tasks/Tools.png" alt="">
                                                <h5>Fix broken windows</h5>
                                                <p class="location">Location, {{$task->city}}, {{$task->country}}</p>
                                                <p class="time">{{$task->created_at->diffForHumans()}}</p>
                                            </div>
                                            <a href="{{action('ProvidersController@getTaskDetail', $task->id)}}">
                                                <button type="button" class="btn btn-default">VIEW</button>
                                            </a>
                                            
                                        </div><!-- /task -->
                                    </div>
                                </div> 
                            @endforeach    
                            </div>
                            </div><!-- /tasks -->
                        </div>
                    </div>
                </div>
            </div><!-- /container -->
        </div><!-- /content -->
@stop   
        