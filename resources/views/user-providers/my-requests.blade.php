@extends('app-user')
@section('css')
    {!! Html::style( asset('assets/css/main.css')) !!}
    <style type="text/css">
        .checkbox label::before {
            content: none !important;
        }
    </style>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.paging').click(function(){
                $('#page_val').val($(this).attr('data-page'));
                $('.filtr_form').submit()
            })

            $('.paging1').click(function(){
                $('#page_val1').val($(this).attr('data-page'));
                $('.filtr_form1').submit()
            })
        })
    </script>
@endsection
@if(Auth::user()->role == 'provider')
    @section('content-provider')
@elseif(Auth::user()->role == 'seeker')
    @section('content-seeker')
@endif
        <div class="my-requests">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-4 col-lg-3">
                        <div class="sidebar-menu hidden-xs">
                            <div class="panel-group">
                                <div class="panel panel-default">
                                   <!--  <div class="panel-heading">
                                        <h4 class="panel-title">Menu</h4>
                                    </div>  -->
                                    <div id="menu" class="">
                                        @if(Auth::user()->role == 'provider')
                                        <ul class="list-group">
                                            <li class="list-group-item"><a href="{{action('ProvidersController@getProfile')}}" style="text-decoration: underline;">My profile</a></li>
                                            <li class="list-group-item"><a href="{{action('ProvidersController@getMyRequests')}}" style="text-decoration: none;">My requests</a></li>
                                        <!--    <li class="list-group-item"><a href="{{action('ProvidersController@getRecomendedRequests')}}" style="text-decoration: underline;">Recomended requests</a></li>
                                            <li class="list-group-item"><a href="#" style="text-decoration: underline;">Buy value added services</a></li>
                                            <li class="list-group-item"><a href="{{action('ProvidersController@getTasks')}}" style="text-decoration: underline;">Tasks</a></li>  -->
                                        </ul>
                                        @elseif(Auth::user()->role == 'seeker')
                                        <ul class="list-group">
                                            <li class="list-group-item"><a href="{{action('SeekersController@getProfile')}}" style="text-decoration: underline;" >My profile</a></li>
                                            <li class="list-group-item"><a href="{{action('SeekersController@getNewTask')}}" style="text-decoration: underline;">Create New Task</a></li> 
                                            <li class="list-group-item"><a href="{{action('SeekersController@getMyTasks')}}" style="text-decoration:none">My Requests</a></li>
                                        </ul>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div> <!-- /sidebar-menu -->
                        
                        @if(Auth::user()->role == 'provider')
                        <div class="sidebar-filter">
                            <div class="panel-group">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">Filter</h4>
                                    </div>
                                    <div id="menu" class="">
                                    {!! Form::open(['action' => ['ProvidersController@getFilterTasks'],'method' => 'GET','files' => 'true','class' => 'form-horizontal form-submit filtr_form', 'role' => 'form']) !!}
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                           {!! Form::text('search', null, ['id' => 'form-company', 'class' => 'form-control', 'placeholder' => 'Search' ]) !!}
                                            </li>
                                            <li class="list-group-item">
                                                <select class="form-control" id="sel1" name="category">
                                                    <option value="" disabled selected >Category</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                            </li>
                                            <li class="list-group-item">
                                                <select class="form-control" id="sel1" name="city">
                                                    <option value="" disabled selected >City</option>
                                                    @foreach($cities as $city)
                                                        <option value="{{$city->city}}">{{$city->city}}</option>
                                                    @endforeach
                                                </select>
                                            </li>
                                            <li class="list-group-item">
                                                <select class="form-control" id="sel1" name="sort_by">
                                                    <option value="oldest">Sort newest to oldest</option>
                                                    <option value="newes">Sort oldest to newes</option>
                                                </select>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="button-filter">
                                                    <button type="submit" class="btn btn-success">Filter</button>
                                                </div><!-- /button-filter -->
                                            </li>
                                        </ul>
                                        {!! Form::hidden('page',1,['id' => 'page_val']) !!}
                                    {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div><!-- /sidebar-filter -->
                        <div class="sidebar-filter-mobile">
                            <div class="panel-group">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" href="#collapse-filter-menu">Filter</a>
                                        </h4>
                                    </div>
                                    <div id="collapse-filter-menu" class="panel-collapse collapse">
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <input class="form-control" id="form-company" placeholder="Search">
                                            </li>
                                            <li class="list-group-item">
                                                <select class="form-control" id="sel1">
                                                    <option value="" disabled selected>Category</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                            </li>
                                            <li class="list-group-item">
                                                <select class="form-control" id="sel1">
                                                    <option value="" disabled selected>City</option>
                                                    @foreach($cities as $city)
                                                        <option value="{{$city->city}}">{{$city->city}}</option>
                                                    @endforeach
                                                </select>
                                            </li>
                                            <li class="list-group-item">
                                                <select class="form-control" id="sel1">
                                                    <option>Sort newest to oldest</option>
                                                    <option>Sort oldest to newes</option>
                                                </select>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="button-filter">
                                                    <button type="button" class="btn btn-success">Filter</button>
                                                </div><!-- /button-filter -->
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /sidebar-filter-mobile -->
                        @endif
                    </div>
                    <div class="col-xs-12 col-sm-8 col-lg-9">
                        @if(Auth::user()->role == 'provider')
                        <div class="requests-type clearfix">
                            <div class="recommended type">
                                <a href="#">Recommended</a>
                            </div>
                            <div class="pending type">
                                <a href="{{action('ProvidersController@getPendingTask')}}">Pending</a>
                            </div>
                            <div class="completed type">
                                <a href="{{action('ProvidersController@getCompletedTask')}}">Completed</a>
                            </div>
                        </div>
                        @else
                        <div class="requests-type clearfix">
                            <div class="recommended type">
                                <a href="{{action('SeekersController@getMyTasks')}}">Recommended</a>
                            </div>
                            <div class="completed type">
                                <a href="{{action('SeekersController@getCompletedTask')}}">Completed</a>
                            </div>
                        </div>
                        @endif
                        <div class="requests-list">
                            @if(Auth::user()->role == 'provider' && empty($search))
                            <h4>Recommended requests</h4>                            
                                @foreach($tasks as $task)
                                    @foreach($task as $ta)
                                    <div class="request-line constant-client">
                                        <div class="row">
                                            <div class="col-sm-3 col-xs-12 col-ms-3">
                                                <div class="request-name">
                                                    <div class="checkbox checkbox-info">
                                                        <label for="checkbox-request-1">Request {{$ta->id}}</label>
                                                    </div>                                                   
                                                    <p>{{$categoryNames[$count]->name}}</p>
                                               </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12 col-ms-6">
                                                <div class="request-info">
                                                    <h5>
                                                        @if(isset($taskUser[$count]->first_name))
                                                            {{$taskUser[$count]->first_name}} 
                                                        @endif
                                                        @if(isset($taskUser[$count]->surname))
                                                            {{$taskUser[$count]->surname}}
                                                        @endif
                                                    </h5>
                                                    <a href="{{action('ProvidersController@getTaskDetail', $ta->id)}}">
                                                        <p>Request: {{$ta->description}}</p>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12 col-ms-3">
                                                <div class="date-location">
                                                    <h5>{{$ta->created_at->diffForHumans()}}</h5>
                                                    <p>{{$ta->location}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" value="{{$count++}}">
                                    @endforeach
                                @endforeach
                             @elseif(Auth::user()->role == 'provider')
                                <h4>Recommended requests</h4>                            
                                @foreach($tasks as $task)
                                    <div class="request-line constant-client">
                                        <div class="row">
                                            <div class="col-sm-3 col-xs-12 col-ms-3">
                                                <div class="request-name">
                                                    <div class="checkbox checkbox-info">
                                                        <input type="checkbox" id="{{'checkbox-request-'.$task->id}}">
                                                        <label for="{{'checkbox-request-'.$task->id}}">Request {{$task->id}}</label>
                                                    </div>                                                   
                                                        <p>{{$categoryNames[$count]->name}}</p>                                                  
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12 col-ms-6">
                                                <div class="request-info">
                                                    <h5>
                                                        @if(isset($taskUser[$count]->first_name))
                                                            {{$taskUser[$count]->first_name}} 
                                                        @endif
                                                        @if(isset($taskUser[$count]->surname))
                                                            {{$taskUser[$count]->surname}}
                                                        @endif
                                                    </h5>
                                                    <a href="{{action('ProvidersController@getTaskDetail', $task->id)}}">
                                                        <p>Request: {{$task->description}}</p>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12 col-ms-3">
                                                <div class="date-location">
                                                    <h5>{{$task->created_at->diffForHumans()}}</h5>
                                                    <p>{{$task->location}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" value="{{$count++}}">
                                @endforeach    
                            @elseif(Auth::user()->role == 'seeker')
                            @if($pageName == 'my-tasks')
                            <h4>My Requests</h4>
                            @else
                            <h4>My Completed</h4>
                            @endif
                                @foreach($tasks as $task)
                                   
                                        <div class="request-line constant-client">
                                            <div class="row">
                                                <div class="col-sm-3 col-xs-12 col-ms-3">
                                                    <div class="request-name">
                                                        <div class="checkbox checkbox-info">
                                                            <!-- <input type="checkbox" id="checkbox-request-1"> -->
                                                            <label for="checkbox-request-1">Request {{$task['id']}}</label>
                                                        </div>
                                                        <p>{{$task['category']['name']}}</p>
                                                    </div><!-- /request-name -->
                                                </div>
                                                <div class="col-sm-6 col-xs-12 col-ms-6">
                                                    <div class="request-info">
                                                     {{--    <h5>Auth user name </h5> --}}
                                                        @if($pageName == 'my-tasks')
                                                        <a href="{{action('SeekersController@getSeekerJob', $task['id'])}}"><p>Request: {{$task['description']}}</p></a>
                                                        @else
                                                        <a href="{{action('SeekersController@getSeekerJobCompleted', $task['id'])}}"><p>Request: {{$task['description']}}</p></a>
                                                        @endif
                                                    </div><!-- /request-info -->
                                                </div>
                                                <div class="col-sm-3 col-xs-12 col-ms-3">
                                                    <div class="date-location">
                                                        <h5>{{$task['choose_date']}}</h5>
                                                        <p>{{$task['location']}}</p>
                                                    </div><!-- date-location -->
                                                </div>
                                            </div>
                                        </div><!-- /request-line -->
                                    
                                @endforeach
                            @endif
                            
                        </div>
                        @if(Auth::user()->role == 'provider')
                            @if(!empty($search))
                                @if($pageCount > 1)
                                <div class="pagination-big clearfix">
                                    <ul>
                                        @if($prevPage != null)
                                        <li><a href="#" class="pagination-arrow paging" data-page="{{$prevPage}}"><span></span><span></span></a></li>
                                        @else
                                        <li><a href="#" class="pagination-arrow paging" data-page="{{$prevPage}}" style="pointer-events: none;cursor: default;"><span></span><span></span></a></li>
                                        @endif

                                        @if((int)($curent_page-1) !=0 && (int)($curent_page-1) > 0)
                                        <li><a href="#" class="paging" data-page="{{$curent_page-1}}">{{(int)($curent_page)-1}}</a></li>
                                        @endif

                                        @if((int)($curent_page) != (int)$pageCount)
                                        <li class="active"><a href="#" class="paging" data-page="{{$curent_page}}">{{(int)$curent_page}}</a></li>
                                        @endif

                                        @if((int)($curent_page+1) != $pageCount && (int)($curent_page+1) < (int)$pageCount)
                                        <li><a href="#" class="paging" data-page="{{$curent_page+1}}">{{(int)($curent_page)+1}}</a></li>
                                        @endif

                                        <li><a href="#" class="">...</a></li>
                                        <li><a href="#" class="paging" data-page="{{$pageCount}}">{{$pageCount}}</a></li>
                                        
                                        @if($nextPage != null)
                                        <li><a href="#" class="pagination-arrow paging" data-page="{{$nextPage}}"><span></span><span></span></a></li>
                                        @else
                                        <li><a href="#" class="pagination-arrow paging" data-page="{{$nextPage}}" style="pointer-events: none;cursor: default;"><span></span><span></span></a></li>
                                        @endif
                                    </ul>
                                </div>
                                @endif
                            @else
                                @if($pageCount > 1)
                                {!! Form::open(['action' => ['ProvidersController@getMyRequests'],'method' => 'GET','files' => 'true','class' => 'form-horizontal form-submit filtr_form1', 'role' => 'form']) !!}
                                    {!! Form::hidden('page',1,['id' => 'page_val1']) !!}
                                {!! Form::close() !!}
                                <div class="pagination-big clearfix">
                                    <ul>
                                        @if($prevPage != null)
                                        <li><a href="#" class="pagination-arrow paging1" data-page="{{$prevPage}}"><span></span><span></span></a></li>
                                        @else
                                        <li><a href="#" class="pagination-arrow paging1" data-page="{{$prevPage}}" style="pointer-events: none;cursor: default;"><span></span><span></span></a></li>
                                        @endif

                                        @if((int)($curent_page-1) !=0 && (int)($curent_page-1) > 0)
                                        <li><a href="#" class="paging1" data-page="{{$curent_page-1}}">{{(int)($curent_page)-1}}</a></li>
                                        @endif

                                        @if((int)($curent_page) != (int)$pageCount)
                                        <li class="active"><a href="#" class="paging1" data-page="{{$curent_page}}">{{(int)$curent_page}}</a></li>
                                        @endif

                                        @if((int)($curent_page+1) != $pageCount && (int)($curent_page+1) < (int)$pageCount)
                                        <li><a href="#" class="paging1" data-page="{{$curent_page+1}}">{{(int)($curent_page)+1}}</a></li>
                                        @endif

                                        <li><a href="#" class="">...</a></li>
                                        <li><a href="#" class="paging1" data-page="{{$pageCount}}">{{$pageCount}}</a></li>
                                        
                                        @if($nextPage != null)
                                        <li><a href="#" class="pagination-arrow paging1" data-page="{{$nextPage}}"><span></span><span></span></a></li>
                                        @else
                                        <li><a href="#" class="pagination-arrow paging1" data-page="{{$nextPage}}" style="pointer-events: none;cursor: default;"><span></span><span></span></a></li>
                                        @endif
                                    </ul>
                                </div>
                                @endif
                            @endif
                            
                        @else

                            @if($pageCount > 1)
                                @if($pageName == 'my-tasks')
                                {!! Form::open(['action' => ['SeekersController@getMyTasks'],'method' => 'GET','files' => 'true','class' => 'form-horizontal form-submit filtr_form1', 'role' => 'form']) !!}
                                @elseif($pageName == 'completed-tasks')
                                {!! Form::open(['action' => ['SeekersController@getCompletedTask'],'method' => 'GET','files' => 'true','class' => 'form-horizontal form-submit filtr_form1', 'role' => 'form']) !!}
                                @endif
                                    {!! Form::hidden('page',1,['id' => 'page_val1']) !!}
                                {!! Form::close() !!}
                                <div class="pagination-big clearfix">
                                    <ul>
                                        @if($prevPage != null)
                                        <li><a href="#" class="pagination-arrow paging1" data-page="{{$prevPage}}"><span></span><span></span></a></li>
                                        @else
                                        <li><a href="#" class="pagination-arrow paging1" data-page="{{$prevPage}}" style="pointer-events: none;cursor: default;"><span></span><span></span></a></li>
                                        @endif

                                        @if((int)($curent_page-1) !=0 && (int)($curent_page-1) > 0)
                                        <li><a href="#" class="paging1" data-page="{{$curent_page-1}}">{{(int)($curent_page)-1}}</a></li>
                                        @endif

                                        @if((int)($curent_page) != (int)$pageCount)
                                        <li class="active"><a href="#" class="paging1" data-page="{{$curent_page}}">{{(int)$curent_page}}</a></li>
                                        @endif

                                        @if((int)($curent_page+1) != $pageCount && (int)($curent_page+1) < (int)$pageCount)
                                        <li><a href="#" class="paging1" data-page="{{$curent_page+1}}">{{(int)($curent_page)+1}}</a></li>
                                        @endif

                                        <li><a href="#" class="">...</a></li>
                                        <li><a href="#" class="paging1" data-page="{{$pageCount}}">{{$pageCount}}</a></li>
                                        
                                        @if($nextPage != null)
                                        <li><a href="#" class="pagination-arrow paging1" data-page="{{$nextPage}}"><span></span><span></span></a></li>
                                        @else
                                        <li><a href="#" class="pagination-arrow paging1" data-page="{{$nextPage}}" style="pointer-events: none;cursor: default;"><span></span><span></span></a></li>
                                        @endif
                                    </ul>
                                </div>
                                @endif

                        @endif

                    <!-- Recomended Request By category -->
                      <!--     @if (isset($tasksCount) && isset($categories))
                            <div class="col-xs-12 col-sm-8 col-lg-9">
                                <div class="request-count">
                                    <h4>There are <mark>{{$tasksCount}}</mark> requests matching your profile</h4>
                                </div>
                                @foreach($categories as $categoryName => $tasks)
                                <div class="request-category">
                                    <p>{{$categoryName}} ({{$tasks->count()}})</p>
                                    <p><a href="{{action('ProvidersController@getJobsByCategory', $categoryName)}}">More in this category</a></p>
                                </div>
                                <div class="tasks">
                                    <div class="row">
                                        @foreach($tasks as $task)
                                        @if($count <= 1)
                                        <div class="col-xs-12 col-md-6">
                                            <div class="task">
                                                <h4>{{$task->name}}</h4>
                                                <div class="task-content"> -->
                                                   <!--   <img src="{{asset('assets/picture/').'/'.$task->category_img}}" alt="">  -->
                                                    <!-- <h5>Fix broken windows</h5>
                                                    <p class="location">{{$task->location}}</p>
                                                    <p class="time">{{$task->created_at->diffForHumans()}}</p>
                                                </div>
                                                <a href="{{action('ProvidersController@getTaskDetail', $task->id)}}"><button type="button" class="btn btn-default">VIEW</button></a>
                                                
                                            </div>
                                        </div>
                                        <input type="hidden" value="{{$count++}}">
                                        @endif
                                        @endforeach
                                        <input type="hidden" value="{{$count = 0}}">
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @else
                            <div class="col-xs-12 col-sm-8 col-lg-9">
                                <div class="request-count">
                                    <h4>There are <mark>0</mark> requests matching your profile</h4>
                                </div>
                            </div>
                            @endif -->
                            <!-- Recomended Request By category -->


                        <!-- 
                            <div class="requests-list">
                            <h4>Recommended requests</h4>
                            @if(isset($saveRequests))
                            @foreach($saveRequests as $saveRequest)
                            <div class="request-line constant-client">
                                <div class="row">
                                    <div class="col-sm-3 col-xs-12 col-ms-3">
                                        <div class="request-name">
                                            <div class="checkbox checkbox-info">
                                                <input type="checkbox" id="checkbox-request-1">
                                                <label for="checkbox-request-1">Request {{$saveRequest->id}}</label>
                                            </div>
                                            <p>{{$saveRequest->category->name}}</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12 col-ms-6">
                                        <div class="request-info">
                                            <h5>{{$saveRequest->user->first_name}} {{$saveRequest->user->surname}}</h5>
                                            <p>Request: {{$saveRequest->description}}</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-xs-12 col-ms-3">
                                        <div class="date-location">
                                            <h5>{{$saveRequest->created_at->diffForHumans()}}</h5>
                                            <p>{{$saveRequest->location}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div> 
                        -->
                    </div>
                </div>
            </div><!-- /container -->
        </div><!-- /profile -->
@stop
