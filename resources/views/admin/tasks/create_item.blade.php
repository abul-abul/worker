@extends('admin.dashboard')
@section('content')
	<!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <span>Items</span>
            </li>
        </ul>
    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <h3 class="page-title">Create Item
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
	                {!! Form::open(['action' => ['AdminController@postCreateItem'], 'files' => 'true','class' => 'login-form', 'role' => 'form' ]) !!}
	                    <div class="form-body">	       
	                    		<div class="form-group">              
		                            <label>Title</label>
		                            <div class="input-group col-md-8" >
		                            <input type="text" class="form-control " placeholder="Title" name="title" required="required" /> </div>                   
	                      		</div>
	                 
		                        <div class="form-group">
		                            <label>Price</label>
		                            <div class="input-group col-md-8">
		                      			<span class="input-group-addon">
                                        	<i class="fa fa-dollar font-green"></i>
                                   		</span>
		                            	<input type="number" min="0" class="form-control" placeholder="Price" name="price" required="required" />
		                            	<input type="hidden" name="new_price" value="" /> 		                            	 
		                            </div>
		                        </div>		                 	
		                 				
		                        <div class="form-group">
		                            <label>Discount</label>
		                            <div class="input-group col-md-8">
		                            	<input type="number" min="0" max="99" class="form-control" placeholder="%" name="discount" />
		                            </div>
		                        </div>
		                 
		                 	
		                        <div class="form-group">
		                            <label>Quantity</label>
		                            <div class="input-group col-md-8">
		                            	<input type="number" class="form-control" min="1" placeholder="Quantity" name="quantity" required="required" />
		                            </div>
		                        </div>
		              
			                 	<div class="form-group">
	                                <label>Status</label>
	                                <div class="input-group col-md-8">
		                                <select class="form-control " name="status">
		                                    <option value="Available">Available</option>
		                                    <option value="Coming Soon">Coming Soon</option>
		                                    <option value="Out of the store">Out of the store</option>
		                                </select>
	                                </div>
	                            </div>

	                            <div class="form-group">
	                                <label>Category</label>
	                                <div class="input-group col-md-8">
		                                <select class="form-control " name="category_id">
		                                	@if(count($categories) > 0)
			                                	@foreach($categories as $category)
				                                    <option value="{{$category->id}}">{{$category->category}}</option>
				                                @endforeach    
				                            @else   
				                            	<option value="0" default>None</option>
				                            @endif  
		                                </select>
	                                </div>
	                            </div>

	                            <div class="form-group">
	                                <label>Collections</label>
	                                <div class="input-group col-md-8">
		                                <select class="form-control " name="collection_id">
		                                	@if(count($collections) > 0)
			                                	@foreach($collections as $collection)
				                                    <option value="{{$collection->id}}">{{$collection->name}}</option>
				                                @endforeach   
				                            @else
				                            	<option value="0" default>None</option>
				                            @endif     
		                                </select>
	                                </div>
	                            </div>

	                            <div class="form-group">
	                                <label>Metal</label>
	                                <div class="input-group col-md-8">
		                                <select class="form-control " name="metal_id">
		                                	@if(count($metals) > 0)
			                                	@foreach($metals as $metal)
				                                    <option value="{{$metal->id}}">{{$metal->name}}</option>
				                                @endforeach   
				                            @else
				                            	<option value="0" default>None</option>
				                            @endif     
		                                </select>
	                                </div>
	                            </div>

	                            <div class="form-group">
	                                <label>Gemstones</label>
	                                <div class="input-group col-md-8">
		                                		<input type="hidden" name="gemstone_check" id="gemstone_check" value="unchecked">
		                                	@if(count($gemstones) > 0)
			                                	@foreach($gemstones as $gemstone)
			                                	<div class="checkbox">
				                                  	<label><input id="gemstone_checkbox" type="checkbox" name="gemstone_checkbox[]" value="{{$gemstone->id}}">{{$gemstone->name}}</label>
				                                </div>
				                                @endforeach   
				                            @else
				                            	<input value="0" name = "gemstone_checkbox[]" type="hidden">
				                            	<option value="0" default>None</option>
				                            @endif     
		                                
	                                </div>
	                            </div>
		                 		
		                        <div class="form-group">
		                            <label>Description</label>
		                            <div class="input-group col-md-8">
		                            <textarea class="form-control" rows="3" name="description" placeholder="Other information" required="required"></textarea>
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
@section('scripts')
<script type="text/javascript">
	$('#gemstone_checkbox').click(function() {
		$('#gemstone_check').val('checked');
	})
</script>
@endsection