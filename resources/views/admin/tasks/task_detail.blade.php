@extends('admin.dashboard')
@section('content')
	<div class="row">
			    <div class="col-md-5">
			        <div class="portlet light bordered">
			            <div class="portlet-title">
			                <div class="caption font-success">
			                    <i class="icon-plus success"></i>
			                    <span class="caption-subject bold uppercase">User Details</span>
			                </div>
			            </div>
			            @if (isset($errors) && count($errors) > 0)
		                    <div class="alert alert-danger alert-dismissable">
		                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
		                        <strong>Error!</strong>
		                        @foreach ($errors->all() as $error)
		                            {{ $error }}<BR>       
		                        @endforeach
		                	</div>
		                @endif
		                @if(Session::has('success'))
						    <div class="alert alert-success alert-dismissable">
		                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
		                        <strong>Success!</strong>
		                        {{ Session::get('success') }}
		                	</div><td></td>
                                        
						@endif		
	            <div class="portlet-body form">

	                    <div class="form-body">	       
                    		

                      		<div class="form-group">              
	                            <label>Username</label>
	                            <div class="input-group col-md-8" >
	                            {!! Form::text('username', $task->user->username, ['class' => 'form-control', 'required' => 'required', 'disabled' ]) !!}               
                      			</div>
                      		</div>
                      		<div class="form-group">              
	                            <label>E-mail</label>
	                            <div class="input-group col-md-8" >
	                            {!! Form::text('phone', $task->user->email, ['class' => 'form-control', 'required' => 'required', 'disabled' ]) !!}               
                      			</div>
                      		</div>
                      		<div class="form-group">              
	                            <label>User Phone</label>
	                            <div class="input-group col-md-8" >
	                            {!! Form::text('username', $task->user->phone, ['class' => 'form-control', 'required' => 'required', 'disabled' ]) !!}               
                      			</div>
                      		</div>
                      		<div class="form-group">              
	                            <label>User City</label>
	                            <div class="input-group col-md-8" >
	                            {!! Form::text('city', $task->user->city, ['class' => 'form-control', 'required' => 'required', 'disabled' ]) !!}               
                      			</div>
                      		</div>
		                </div>	            	
 
	   			</div>
	   		</div>	
		</div>


		<div class="col-md-5">
	        <div class="portlet light bordered">
	            <div class="portlet-title">
	                <div class="caption font-success">
	                    <span class="caption-subject bold uppercase">Viewing Service Request #{{$task->id}} | {{$category->name}} </span>
	                </div>
	            </div>	
	            <div class="portlet-body form">
                        <input type="hidden" value="{{$task->id}}" id="task_id">
                        <div class="task-content">
                            @if($task->category_img != "")
                            	<img src="{{ asset('assets/uploads/'.$task->category_img)}}" alt="" style="width: 60%;height: 212px;">
                            @else
                            	<img src="{{asset('assets/img/defoult.jpg')}}" alt="" style="width: 60%;height: 212px;">
                            @endif
                        </div>
                       <div class="form-body">	       
                    		

	                 		<div class="form-group">              
	                            <label>Task Location</label>
	                            <div class="input-group col-md-8" >
	                            {!! Form::text('location', $task->location, ['class' => 'form-control', 'required' => 'required', 'disabled' ]) !!}               
                      			</div>
                      		</div>
	                        <div class="form-group">
	                            <label>Task Description</label>
	                            <div class="input-group col-md-8">
	                            <textarea class="form-control" rows="3" name="description" placeholder="Other information" required="required" disabled="disabled" >{{$task->description}}</textarea>
	                            </div>
	                        </div>
	                        <div class="form-group">              
	                            <label>Task Choose Date</label>
	                            <div class="input-group col-md-8" >
	                            {!! Form::text('choose_date', $task->choose_date, ['class' => 'form-control', 'required' => 'required', 'disabled' ]) !!}               
                      			</div>
                      		</div>
                      		<div class="form-group">              
	                            <label>Task Posted</label>
	                            <div class="input-group col-md-8" >
	                            {!! Form::text('posted', $task->created_at->diffForHumans(), ['class' => 'form-control', 'required' => 'required', 'disabled' ]) !!}               
                      			</div>
                      		</div>


		                </div>
                        <div class="task-questions">
                            @foreach($questions as $key => $question)
	                            @if($key ==0)
	                                <div class="question">
	                                    <p><b>{{$question->question}}</b></p>
	                                    <p><i>{{$question->pivot->answer}}</i></p>
	                            @else
	                                <?php $key = $key-1 ?>
	                                @if($questions[$key]['id'] != $question->id)
	                                </div>
	                                <div class="question">
	                                    <p><b>{{$question->question}}</b></p>
	                                    <p><i>{{$question->pivot->answer}}</i></p>
	                                @else
	                                    <p><i>{{$question->pivot->answer}}</i></p>
	                                @endif
                            @endif
                            @endforeach
                                </div>
                        </div><!--/task-questions --> 
	   			</div>
			</div>	
		</div>
	</div>

@endsection
@section('script')
@stop