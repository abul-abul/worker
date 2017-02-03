@extends('app-user')
@section('content-provider')
       <div class="recomended-requests">
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
                                            <li class="list-group-item"><a href="{{action('ProvidersController@getMyRequests')}}" style="text-decoration: underline;">My requests</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- /sidebar-menu -->
                    </div>
                    @if (isset($tasksCount) && isset($categories))
                    <div class="col-xs-12 col-sm-8 col-lg-9">
                        <div class="request-count">
                            <h4>There are <mark>{{$tasksCount}}</mark> requests matching your profile</h4>
                        </div><!--/request-count -->
                        @foreach($categories as $categoryName => $tasks)
                        <div class="request-category">
                            <p>{{$categoryName}} ({{$tasks->count()}})</p>
                            <p><a href="{{action('ProvidersController@getJobsByCategory', $categoryName)}}">More in this category</a></p>
                        </div><!-- /request-category -->
                        <div class="tasks">
                            <div class="row">
                                @foreach($tasks as $task)
                                @if($count <= 1)
                                <div class="col-xs-12 col-md-6">
                                    <div class="task">
                                        <h4>{{$task->name}}</h4>
                                        <div class="task-content">
                                            <img src="{{asset('assets/picture/').'/'.$task->category_img}}" alt="">
                                            <h5>Fix broken windows</h5>
                                            <p class="location">{{$task->location}}</p>
                                            <p class="time">{{$task->created_at->diffForHumans()}}</p>
                                        </div>
                                        <a href="{{action('ProvidersController@getTaskDetail', $task->id)}}"><button type="button" class="btn btn-default">VIEW</button></a>
                                        
                                    </div><!-- /task -->
                                </div>
                                <input type="hidden" value="{{$count++}}">
                                @endif
                                @endforeach
                                <input type="hidden" value="{{$count = 0}}s">
                            </div>
                        </div><!-- /tasks -->
                        @endforeach
                    </div>
                    @else
                    <div class="col-xs-12 col-sm-8 col-lg-9">
                        <div class="request-count">
                            <h4>There are <mark>0</mark> requests matching your profile</h4>
                        </div>
                    </div>
                    @endif
                </div>
            </div><!-- /container -->
        </div><!-- /profile -->
@stop        