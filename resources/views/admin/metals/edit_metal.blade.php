@extends('admin.dashboard')
@section('content')
	<div class="row">
	    <div class="col-md-5">
	        <div class="portlet light bordered">
	            <div class="portlet-title">
	                <div class="caption font-success">
	                    <i class="icon-plus success"></i>
	                    <span class="caption-subject bold uppercase"> Edit Metal</span>
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
	                {!! Form::model($metal, ['action' => ['AdminController@postEditMetal'], 'files' => 'true','class' => 'login-form', 'role' => 'form' ]) !!}
	                    <div class="form-body">	       
	                    		<div class="form-group">              
		                            <b><label>Name</label></b>
		                            <div class="input-group col-md-8" >
		                            {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required',  ]) !!}               
	                      		</div>
		                     			                        
		                        <input type="hidden"  name="id" value="{{$metal->id}}"></input>
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