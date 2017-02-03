@extends('admin.dashboard')
@section('content')
	<div class="row">
	    <div class="col-md-5">
	        <div class="portlet light bordered">
	            <div class="portlet-title">
	                <div class="caption font-success">
	                    <i class="icon-plus success"></i>
	                    <span class="caption-subject bold uppercase"> Edit User</span>
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
                	</div>
				@endif
	            <div class="portlet-body form">
	                {!! Form::model($user, ['action' => ['AdminController@postEditUser'], 'files' => 'true','class' => 'login-form', 'role' => 'form' ]) !!}
	                    <div class="form-body">	 

	                    		<div class="form-group">              
		                            <label>Role</label>
		                            <div class="input-group col-md-8" >
		                            	@if($user->role == 'seeker')
		                            		<span class="label label-sm label-success"> Seeker </span>
		                            	@else
		                            		<span class="label label-sm label-warning"> Provider </span> 
		                            	@endif  
		                            </div>            
	                      		</div>
	                      		@if($user->role == 'provider')
		                            <div class="form-group">              
			                            <label>Rating</label>
			                            <div class="input-group col-md-8" >
			                            	@if($user->rate == null)
                                                    <span class="label label-sm label-info"><b>0</b></span>  
                                                @else
                                                    <span class="label label-sm label-info" ><b>{{$user->rate}}</b></span>  
                                                     
                                                @endif                             
		                           		 </div>            
	                      			</div>	
                            	@endif 

	                      		<div class="form-group">              
		                            <label>Username</label>
		                            <div class="input-group col-md-8" >
		                           		{!! Form::text('username', null, ['class' => 'form-control', 'required' => 'required',  ]) !!}  
		                            </div>             
	                      		</div>

	                      		<div class="form-group">              
		                            <label>E-mail</label>
		                            <div class="input-group col-md-8" >
		                            	{!! Form::email('email', null, ['class' => 'form-control', 'required' => 'required', 'disabled' ]) !!}    
		                            </div>           
	                      		</div>

	                      		<div class="form-group">              
		                            <label>Company</label>
		                            <div class="input-group col-md-8" >
		                            	{!! Form::text('company', null, ['class' => 'form-control', ]) !!}    
		                            </div>           
	                      		</div>

	                      		<div class="form-group">              
		                            <label>Country</label>
		                            <div class="input-group col-md-8" >
		                            {!! Form::text('country', null, ['class' => 'form-control' ]) !!}               
	                      		</div>

	                      		<div class="form-group">              
		                            <label>City</label>
		                            <div class="input-group col-md-8" >
		                            {!! Form::text('city', null, ['class' => 'form-control' ]) !!}               
	                      		</div>

	                      		<div class="form-group">              
		                            <label>Phone</label>
		                            <div class="input-group col-md-8" >
		                            {!! Form::text('phone', null, ['class' => 'form-control', 'required' => 'required' ]) !!}               
	                      		</div>
		                        <input type="hidden"  name="id" value="{{$user->id}}"></input>
		                 	<div class="form-actions right">
	                            <button type="submit" class="btn green-jungle">Edit</button>
	                        </div>
	                 	</div>                	
	                {!!Form::close()!!}       
	            </div>
	        </div>
	    </div>
	</div>
@endsection
@section('script')
@stop