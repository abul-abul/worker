@extends('admin.dashboard')
@section('content')
	<!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <span>Metals</span>
            </li>
        </ul>
    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <h3 class="page-title">Add Metal
    </h3>
    <!-- END PAGE TITLE-->
	<div class="row">
	    <div class="col-md-5">
	        <div class="portlet light bordered">	            
	            @if (isset($errors) && count($errors) > 0)
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        <strong>Error!</strong>
                        @foreach ($errors->all() as $error)
                            {{ $error }}<BR>       
                        @endforeach
                	</div>
                @endif
	            <div class="portlet-body form">
	                {!! Form::open(['action' => ['AdminController@postAddMetal'], 'files' => 'true','class' => 'login-form', 'role' => 'form' ]) !!}
	                    <div class="form-body">	       
	                    		<div class="form-group">              
		                            <label>Name</label>
		                            <div class="input-group col-md-8" >
		                            <input type="text" class="form-control " placeholder="Metal Name" name="name" required="required" /> </div>                   
	                      		</div>
		                 	<div class="form-actions right">
	                            <button type="submit" class="btn green-jungle">Create</button>
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