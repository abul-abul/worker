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
                                    <ul class="list-group">
                                        <li class="list-group-item"><a href="{{action('ProvidersController@getProfile')}}" style="text-decoration: underline;">My profile</a></li>
                
                                        <li class="list-group-item"><a href="{{action('ProvidersController@getMyRequests')}}" style="text-decoration: none;">My requests</a></li>
                                    <!--    <li class="list-group-item"><a href="{{action('ProvidersController@getRecomendedRequests')}}" style="text-decoration: underline;">Recomended requests</a></li>
                                        <li class="list-group-item"><a href="#" style="text-decoration: underline;">Buy value added services</a></li>
                                        <li class="list-group-item"><a href="{{action('ProvidersController@getTasks')}}" style="text-decoration: underline;">Tasks</a></li>  -->
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div> <!-- /sidebar-menu -->
                </div>
                <div class="col-xs-12 col-sm-8 col-lg-9">
                    <div class="requests-type clearfix">
                        <div class="recommended type">
                            <a href="{{action('ProvidersController@getMyRequests')}}">Recommended</a>
                        </div>
                        <div class="pending type">
                            <a href="{{action('ProvidersController@getPendingTask')}}">Pending</a>
                        </div>
                        <div class="completed type">
                            <a href="{{action('ProvidersController@getCompletedTask')}}">Completed</a>
                        </div>
                    </div>

                    <div class="requests-list">
                        <h4>Completed requests</h4>
                            @foreach($tasks as $task)
                              
                                <div class="request-line">
                                    <div class="row">
                                        <div class="col-sm-3 col-xs-12 col-ms-3">
                                            <div class="request-name">
                                                <div class="checkbox checkbox-info">
                                                    <label for="checkbox-request-1">Request {{$task->id}}</label>
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
                                                <a href="{{action('ProvidersController@getTaskDetailCompleted', $task->id)}}">
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
                    </div>
                    @if($pageCount > 1)
                    {!! Form::open(['action' => ['ProvidersController@getCompletedTask'],'method' => 'GET','files' => 'true','class' => 'form-horizontal form-submit filtr_form1', 'role' => 'form']) !!}
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
                </div>
            </div>
        </div>
    </div>
@stop
