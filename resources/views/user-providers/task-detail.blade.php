@extends('app-user')

@section('scripts')
    {!! Html::script( asset('assets/js/task-validation.main.js')) !!}
    {!! Html::script( asset('assets/js/delete.main.js')) !!}
   
    {!! Html::script( asset('assets/js/choose-provider-content.main.js')) !!}


@endsection


@if(Auth::user()->role == 'provider')
    @section('content-provider')
@elseif(Auth::user()->role == 'seeker')
    @section('content-seeker')
@endif
<input type="hidden" data='{{ csrf_token() }}' id='token_task'/>
<input type="hidden" data='{{ csrf_token() }}' id='csrf'/>
<input type="hidden" data='{{ $taskData->id}}' id='task_id'>


<!-- Modal -->
@if(Auth::user()->role == 'provider')
<div class="modal fade" id="myModal" role="dialog">
@else
<div class="modal fade" id="rate-provider-modal" role="dialog">
@endif
    <div class="modal-dialog">
        <!-- Modal content-->
        @if(Auth::user()->role == 'provider')
        <div class="modal-content modal-window">
            <div class="modal-header" style="color:#9B9B9B;font-size:14px;text-align:left;border-bottom:1px solid #9B9B9B">
                <b>Apply for this task</b>
            </div>
            <div class="alert alert-danger validator" style="display:none"></div>
            <div class="modal-body" style="border:none">
                <div class="col-xs-12">
                    <div class="task-options">
                        <div class="task-questions">
                        {!! Form::open(['action' => ['ProvidersController@postAttachTask',$taskData->id],'files' => 'true','class' => 'form-horizontal task-attach', 'role' => 'form']) !!}
                            <div class="add-info">
                                <div class="row">
                                    <div class="col-xs-12" style="margin-bottom:20px">
                                        {!! Form::textarea('description', null, ['id' => 'descriptiin', 'class' => 'form-control task_validation', 'placeholder' => 'Describe why the client should choose you for this task','style' => 'resize:none']) !!}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-3" style="margin-bottom:20px">
                                        {!! Form::select('money_type', ['usd'=> 'USD Dollar','eur' => 'EUR'],null, ['id' => 'money_type', 'class' => 'form-control task_validation']) !!}
                                    </div>
                                    <div class="col-xs-7" style="margin-bottom:20px">
                                        {!! Form::text('money', null, ['id' => 'money', 'class' => 'form-control task_validation', 'placeholder' => 'Amount']) !!}
                                    </div>
                                    <div class="col-xs-2" style="margin-bottom:20px">
                                        <button type="button" class="btn btn-success save_task">Save</button>
                                    </div>
                                </div>

                            </div>
                        {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
        @elseif(Auth::user()->role == 'seeker')
        <div class="modal-content modal-window">
            <div class="modal-header">
              Please rate this provider
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" >
                {!! Form::open(['action' => ['SeekersController@postRateProvider'],'files' => 'true','class' => 'ate-provider', 'role' => 'form']) !!}
                    <p>Quality of Service</p>
                    <input type="hidden" name="task_id" value="{{ $taskData->id}}">
                    <input type="hidden" value="" name="provider_id" id="provider_id">
                    <input type="hidden" value="" name="provider_mony" id="provider_mony">
                    <select class="form-control" id="r-point-1" name="vole" required="required">
                        <option value="5">5 stars</option>
                        <option value="4">4 stars</option>
                        <option value="3">3 stars</option>
                        <option value="2">2 stars</option>
                        <option value="1">1 star</option>
                    </select>
                    <p>Value for Money</p>
                    <select class="form-control" id="r-point-1" name="vole1" required="required">
                        <option value="5">5 stars</option>
                        <option value="4">4 stars</option>
                        <option value="3">3 stars</option>
                        <option value="2">2 stars</option>
                        <option value="1">1 stars</option>
                    </select>
                    <p>Timeliness of Service</p>
                    <select class="form-control" id="r-point-1" name="vole2" required="required">
                        <option value="5">5 stars</option>
                        <option value="4">4 stars</option>
                        <option value="3">3 stars</option>
                        <option value="2">2 stars</option>
                        <option value="1">1 stars</option>
                    </select>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Rate</button>
                    </div>
                    
                  {!! Form::close() !!}
            </div>
        </div>
        @endif
    </div>
</div><!-- /modal -->


<div style="padding:0;display:none" class='col-md-12 noticication_create_provider'>
    <div style="padding:0" class="col-sm-12">
        <div class="alert alert-success">
           <span style="color:#000"> You have chosen a provider. After the task has been completed please provide a rating for your provider.</span>
        </div>
    </div>
</div>




<div class="job-view">
    <div class="container">
        <div class="row">
            @if (count($errors) > 0) 
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li><b>Ops, something went wrong.</b></li>
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="hidden-xs col-sm-4 col-lg-3">
                <div class="sidebar-menu">
                    <div class="panel-group">
                        <div class="panel panel-default">
                           
                            <div id="menu" class="">
                                @if(Auth::user()->role == 'provider')
                                <ul class="list-group">
                                    <li class="list-group-item"><a href="{{action('ProvidersController@getProfile')}}" style="text-decoration: underline;">My profile</a></li>
                          
                                    <li class="list-group-item"><a href="{{action('ProvidersController@getMyRequests')}}" style="text-decoration: underline;">My requests</a></li>

                                </ul>
                                @elseif(Auth::user()->role == 'seeker')
                                <ul class="list-group">
                                    <li class="list-group-item"><a href="{{action('SeekersController@getProfile')}} " style="text-decoration: underline;">My profile</a></li>
                                    <li class="list-group-item"><a href="{{action('SeekersController@getNewTask')}}" style="text-decoration: underline;">Create New Task</a></li> 
                                    <li class="list-group-item"><a href="{{action('SeekersController@getMyTasks')}}" style="text-decoration: none;">My Requests</a></li>
                                </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                </div> <!-- /sidebar-menu -->
            </div>
            <div class="col-xs-12 col-sm-8 col-lg-9">
                <div class="job-expanded">
                    <div class="task">
                        @if(Auth::user()->role == 'provider')
                        <h4>Viewing Service Request # {{$taskData->id}} | {{$categoryName}} </h4>
                        <div class="task-content">
                            @if($taskData->category_img != "")
                            <img src="{{asset('assets/uploads/').'/'.$taskData->category_img}}" alt="">
                            @else
                            <img src="{{asset('assets/img/defoult.jpg')}}" alt="">
                            @endif
                            <h5>
                                @if(isset($userName->first_name))
                                {{$userName->first_name}}
                                @endif
                                @if(isset($userName->surname))
                                {{$userName->surname}}
                                @endif
                            </h5>
                            <p class="location">{{$taskData->location}}</p>
                            <p class="time">Posted: {{$taskData->created_at->diffForHumans()}}</p>
                        </div>
                        <div class="task-description">
                            <h5>{{$taskData->task_name}}</h5>
                            <p>{{$taskData->description}}</p>
                        </div>
                            <!-- <h3>Question and answer</h3> -->
                        <div class="task-questions">
                            @foreach($taskData->questions as $key => $question)
                            @if($key ==0)
                                <div class="question">
                                    <p>{{$question->question}}?</p>
                                    <p>{{$question->pivot->answer}}</p>
                            @else
                                <?php $key = $key-1 ?>
                                @if($taskData->questions[$key]['id'] != $question->id)
                                </div>
                                <div class="question">
                                    <p>{{$question->question}}?</p>
                                    <p>{{$question->pivot->answer}}</p>
                                @else
                                    <p>{{$question->pivot->answer}}</p>
                                @endif
                            @endif
                            @endforeach
                            </div>
                        </div>
                        @elseif(Auth::user()->role == 'seeker')
                        <h4>Viewing Service Request #{{$taskData->id}} | {{$category->name}} </h4>
                        <input type="hidden" value="{{$taskData->id}}" id="task_id">
                        <div class="task-content">
                            @if($taskData->category_img != "")
                            <img src="{{ asset('assets/uploads/'.$taskData->category_img)}}" alt="">
                            @else
                            <img src="{{asset('assets/img/defoult.jpg')}}" alt="">
                            @endif
                            <h5>{{Auth::user()->first_name}} {{Auth::user()->surname}}</h5>
                            <p class="location">Location, {{$taskData->location}}</p>
                            <p class="time">Posted: {{$taskData->created_at->diffForHumans()}}</p>
                        </div>
                        <div class="task-description">
                            <h5>{{$taskData->task_name}}</h5>
                            <p>{{$taskData->description}}</p>
                        </div>
                        <div class="task-questions">
                            @foreach($questions as $key => $question)
                            @if($key ==0)
                                <div class="question">
                                    <p>{{$question->question}}?</p>
                                    <p>{{$question->pivot->answer}}</p>
                            @else
                                <?php $key = $key-1 ?>
                                @if($questions[$key]['id'] != $question->id)
                                </div>
                                <div class="question">
                                    <p>{{$question->question}}?</p>
                                    <p>{{$question->pivot->answer}}</p>
                                @else
                                    <p>{{$question->pivot->answer}}</p>
                                @endif
                            @endif
                            @endforeach
                                </div>
                        </div><!--/task-questions -->
                        @endif
                    </div><!-- /task -->

                    @if(Auth::user()->role == 'provider')
                        @if($pageName == 'pending')
                            <div class="button-respond">
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Respond</button>
                            </div><!-- /respond -->
                        @endif
                    @elseif(Auth::user()->role == 'seeker')

                        <div style="margin-top:20px">
                            <button type="button" class="btn btn-danger delete" data-toggle="modal" data-target="#myModalDelete" data-href="{{ action('SeekersController@getRemoveTask',  $taskData->id) }}">Delete Task</button>
                        </div>  
                    @endif
                    <!-- <div class="contact-customer">
                        <ul>
                            <li><a href="#"  data-toggle="modal" data-target="#myModal">Respond</a></li>
                            <li><a href="#" class="contact-email">Contact via email</a></li>
                            <li><a href="{{action('ProvidersController@getSaveRequest', $taskData->id)}}" class="save-request">Save Request</a></li>
                        </ul>
                    </div> -->
                    <!-- /similar-requests -->

                    @if(Auth::user()->role == 'seeker')
                        @if($pageName == 'completed')

                            <div id="choos_step1" style="display:none">
                                <div class="service-providers">
                                    <h4>Choose a Service Provider</h4>
                                    @foreach($providers as $provider)
                                    
                                    <div class="provider-details">
                                        <div class="user-info">
                                            <img class="avatar" src="{{ asset('assets/uploads/'.$provider->profile_img)}}" alt="">
                                            <button type="button" class="btn btn-success choose_btn"  alt="{{$provider->id}}">Choose provider</button>
                                            <p>{{$provider->first_name}} {{$provider->surname}}<span class="rate">
                                                <img src="{{ asset('assets/img/'.$provider->rate.'stars.png')}}" alt="" width="100px"></span>
                                            </p>
                                            <p>Phone: <span class="phone-number">{{$provider->phone}}</span></p>
                                            <p>Proposed Amount: <span class="amount">$ {{$provider->pivot->money}}</span></p>
                                        </div><!-- /userpic -->
                                        <div class="provider-message">
                                            {{$provider->pivot->description}}.
                                        </div><!-- /description -->
                                    </div>
                                    @endforeach

                                </div><!-- /service-providers -->
                            </div>
                            <div id="choos_step2">
                                <div class="service-providers">

                                    <h4>Choose a Service Provider</h4>

                                    @foreach($taskProviders as $taskProvider)
                                        <div class="provider-details">
                                            <div class="user-info">
                                                <img class="avatar" src="{{ asset('assets/uploads/'.$taskProvider->profile_img)}}" alt="">
                                                <button type="button" class="btn btn-success userpic" data-toggle="modal" data-target="#rate-provider-modal" alt="{{$taskProvider->id}}">Rate this provider</button>
                                                <p>{{$taskProvider->first_name}} {{$taskProvider->surname}}<span class="rate"><img src="{{ asset('assets/img/'.$taskProvider->rate.'stars.png')}}" alt="" width="100px"></span></p>
                                                <p>Phone: <span class="phone-number">{{$taskProvider->phone}}</span></p>
                                                <p>Proposed Amount: <span class="amount">$ {{$taskProvider->pivot->money}}</span></p>
                                            </div><!-- /userpic -->
                                            <div class="provider-message">
                                                {{$taskProvider->pivot->description}}
                                            </div><!-- /description -->
                                        </div>
                                    @endforeach
                                </div><!-- /service-providers -->

                                <div class="provider-actions">
                                    <button class="btn btn-success choose_another">Choose another provider</button>
                                </div>
                            </div>
                        @else
                            <div id="choos_step1">
                                <div class="service-providers">
                                
                                    @foreach($providers as $provider)
                                       <h4>Choose a Service Provider</h4>
                                        <div class="provider-details">
                                            <div class="user-info">
                                                <img class="avatar" src="{{ asset('assets/uploads/'.$provider->profile_img)}}" alt="">
                                                @if($taskData->active_rate == 'passive')
                                                    <button type="button" class="btn btn-success userpic" data-toggle="modal" data-target="#rate-provider-modal" data-money="{{$provider->pivot->money}}" alt="{{$provider->id}}">Rate this provider</button>
                                                @else  
                                                    <button type="button" class="btn btn-success choose_btn"  alt="{{$provider->id}}">Choose provider</button>
                                                @endif
                                                <p>{{$provider->first_name}} {{$provider->surname}}<span class="rate"><img src="{{ asset('assets/img/'.$provider->rate.'stars.png')}}" alt="" width="100px"></span></p>
                                                <p>Phone: <span class="phone-number">{{$provider->phone}}</span></p>
                                                <p>Proposed Amount: <span class="amount">$ {{$provider->pivot->money}}</span></p>
                                            </div><!-- /userpic -->
                                            <div class="provider-message">
                                                {{$provider->pivot->description}}.
                                            </div><!-- /description -->
                                        </div>
                                    @endforeach
                                </div><!-- /service-providers -->
                            </div>
                        @endif
                    @endif

                </div><!-- /job-expanded -->
            </div>
        </div>
    </div><!-- /container -->
</div><!-- /job-view -->

@if(Auth::user()->role == 'seeker')
<div class="modal fade" id='myModalDelete' tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content col-md-12" style="height: 150px">
            <h3 style="text-align: center;">
                Do you want to delete this task?
            </h3>
            <a class='delete_one' style='float:left;padding:15px 20px;' href='#'><button class="pull-right btn btn-sm btn-danger">Delete</button></a>
            <a class='' style='float:right;padding:15px 20px;' href='#'><button class="pull-right btn btn-sm btn" data-dismiss="modal" aria-label="Close">Cancel</button></a>
        </div>
    </div>
</div>

<!-- Modal -->
  <div class="modal fade" id="choose-provider-modal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content modal-window provider-details" id="provider_choose_content">
            <!-- <div class="modal-header">
              Are you sure you want to choose Bakhile?
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body user-info">
              <img src="" alt="">
              <h4 class="modal-title">Bakhile</h4>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
              <button type="button" class="btn btn-success" data-dismiss="modal">Yes</button>
            </div> -->
        </div>
    </div>
  </div><!-- /modal -->

@endif


@endsection
