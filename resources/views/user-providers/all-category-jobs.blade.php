@extends('app-user')
@section('content-provider') 
       <div class="jobs">
            <div class="container">
                <div class="row">
                    <div class="hidden-xs col-sm-4 col-lg-3">
                        <div class="sidebar-menu">
                            <div class="panel-group">
                                <div class="panel panel-default">
                                   
                                    <div id="menu" class="">
                                         <li class="list-group-item"><a href="{{action('ProvidersController@getProfile')}}" style="text-decoration: underline;">My profile</a></li>
                                            <li class="list-group-item"><a href="{{action('ProvidersController@getMyRequests')}}" style="text-decoration: underline;">My requests</a></li>
<!--                                             <li class="list-group-item"><a href="{{action('ProvidersController@getRecomendedRequests')}}" style="text-decoration: none;">Recomended requests</a></li> -->
                                          <!--   <li class="list-group-item"><a href="#" style="text-decoration: underline;">Buy value added services</a></li>
                                            <li class="list-group-item"><a href="{{action('ProvidersController@getTasks')}}" style="text-decoration: underline;">Tasks</a></li> -->
                                    </div>
                                </div>
                            </div>
                        </div> <!-- /sidebar-menu -->
                    </div>
                    <div class="col-xs-12 col-sm-8 col-lg-9">
                        <div class="row">
                            <div class="tasks">
                                
                                <div class="row">
                                @foreach($tasks as $task)
                                    <div class="col-xs-12 col-md-6">
                                        <div class="task">
                                            <h4>Task</h4>
                                            <div class="task-content">
                                                @if($task->category_img != "")
                                                <img src="{{asset('assets/picture/').'/'.$task->category_img}}" alt="">
                                                @endif
                                                <h5>Fix broken windows</h5>
                                                <p class="location">{{$task->location}}</p>
                                                <p class="time">{{$task->created_at->diffForHumans()}}</p>
                                            </div>
                                            <a href="{{action('ProvidersController@getTaskDetail', $task->id)}}">
                                                <button type="button" class="btn btn-default">VIEW</button>
                                            </a>
                                        </div><!-- /task -->
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
        