@extends('admin.dashboard')
@section('content')
<div class="row">
    <div class="col-md-5">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-success">
                    <i class="icon-plus success"></i>
                    <span class="caption-subject bold uppercase">Item #{{$item->id}}</span>
                </div>
            </div>
            <div class="portlet-body form">       
	                <p><b>Title: </b>   <span><i>{{$item->title}}</i></span></p>
	                <p><b>Price: </b>   <span><i>{{$item->price}}$</i></span></p>
	                <p><b>Description: </b><br>
	                	<textarea disabled rows="8" cols="55" style="resize:none">
						{{$item->description}}
						</textarea>	
	                </p>
	                <p><b>Status: </b>   <span><i>{{$item->status}}</i></span></p>
	                <p><b>Discount: </b>   <span><i>{{$item->discount}}</i></span></p>
	                <p><b>Quantity: </b>   <span><i>{{$item->quantity}}%</i></span></p>
	                <p><b>Collection: </b>   <span><i>{{$item->collection->name}}</i></span></p>
            </div>
        </div>
    </div>


    <div class="col-md-5">
	    <div class="portlet light bordered col-md-12">
	    	<div class="portlet-title">
                <div class="caption font-success">
                    <i class="icon-plus success"></i>
                    <span class="caption-subject bold uppercase">Gallery</span>
                </div>
            </div>
			    @if(Session::has('warning'))
				    <div class="alert alert-danger alert-dismissable">
	                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
	                    <strong>Warning!</strong>
	                    {{ Session::get('warning') }}
	            	</div>
				@endif
            <div class="form-actions">		            
		        {!! Form::open(['action' => 'AdminController@postEditItem']) !!}
					<div class="col-md-12">
					@foreach($item->images as $image)
						<div class="col-md-6">
							<div class="col-md-12" style="margin:10px 0px 10px 0px">
								<img src="{{URL::asset('/uploads/'.$image->name)}}" class="img-rounded show-image" alt="Cinque Terre" width="204" height="136">	<br />
							</div>
							<div class="col-md-1">
								<a href="{{ action('AdminController@getDeleteItemImage', [$image->id,$image->name]) }}" class="red"><i class="glyphicon glyphicon-trash red"></i></a>
					        </div>
					        <div class="col-md-1">
					        	<label class="radio-inline">
           							<input type="radio" name="main_image_id" value="{{$image->id}}"  style="cursor:pointer">
        						</label>
							</div>
						</div>					   
				    @endforeach
				    	<div class="col-md-12"  style="margin-top:10px">
				    		<div class="col-md-12">
						        <input type="hidden" name="id" value="{{$item->id}}"/>
						        <div class="form-actions right ">
					       			{!!Form::submit('Main Image', array('class' => 'btn green-jungle'))!!}
								</div>
							</div>
						</div>
					</div>
				{!!Form::close()!!} 
			</div>
			<div class="form-actions ">
                {!! Form::open(['action' => ['AdminController@postUploadItemImage'], 'files' => 'true','class' => 'login-form', 'role' => 'form' ]) !!}
                	<div class="col-md-12">
                		<div class="col-md-12">
					        <input type="hidden" value="{{$item->id}}" name="item_id" />
					        <div class="col-md-12" style="margin-top:10px">
					        	<input id="input-24" name="image" type="file" multiple class="file-loading ">
					        </div>
					    </div>
				        <div class="col-md-12"  style="margin-top:10px">
				        	<div class="col-md-12">
						        <div class="form-actions right">
						            <button type="submit" class="btn green-jungle">Upload</button>
						        </div>
						    </div>
					    </div>
				    </div>
			    {!!Form::close()!!} 
            </div>
	    </div>
	    <div class="portlet light bordered col-md-12">
	    	<div class="portlet-title">
                <div class="caption font-success">
                    <i class="icon-plus success"></i>
                    <span class="caption-subject bold uppercase">Video</span>
                </div>
            </div>
            	@if(Session::has('error'))
				    <div class="alert alert-danger alert-dismissable">
	                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
	                    <strong>Warning!</strong>
	                    {{ Session::get('error') }}
	            	</div>
				@endif
            <div class="form-actions">	
            	<div class="col-md-12">
					{!! Form::open( ['action' => ['AdminController@postAddVideo'], 'files' => 'true','class' => 'login-form', 'role' => 'form' ]) !!}
						<div class="portlet light bordered">
							<div class="portlet-title">
				            </div>
					        <div class="form-group">              
					            <label>Video Link</label>
					            <div class="input-group col-md-8" >
					            	<input type="text" class="form-control " placeholder="Link" name="name" required="required" />
					            </div>                   
					  		</div>
						        <input type="hidden" name="item_id" value="{{$item->id}}"/>
					  			<div class="form-actions right">
						            <button type="submit" class="btn green-jungle">Upload</button>
						        </div>
					  	</div>	
				  	{!!Form::close()!!} 
				</div>
			</div>
			<div class="form-actions">
				<div class="col-md-12">
					<iframe width="420" height="315" src='https://www.youtube.com/embed/{{$video}}'></iframe>
				</div>
			</div>
		</div>
	</div>
	
</div>   

	    
@endsection
@section('script')
@stop