@extends('admin.dashboard')
@section('content')

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <span>Reviews</span>
            </li>
        </ul>
    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <h3 class="page-title">Reviews
    </h3>
    <!-- END PAGE TITLE-->

    <div class="row-fluid">
        <div class="span12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-list"></i></div>          
                </div>
                <div class="portlet-body no-more-tables">
                    @if (count($reviews) > 0)
                    <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th> #</th>
                                    <th> Review</th>
                                    <th> User-Email</th>
                                    <th> Status</th>                                
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reviews as $review)
                                    <tr>
                                        <td>{{$review->id}}</td>                                 
                                        <td>{{$review->review}}</td>                            
                                        <td>{{$review->user->email}}</td>   
                                        <td>
                                        @if($review->status == "approved")
                                            <a class="btn green-jungle" >
                                                <span class="fa fa-check approved" alt="{{$review->id}}"></span>
                                            </a>
                                            <a class="btn default ">
                                                <span class="glyphicon glyphicon-remove unapproved" alt="{{$review->id}}"></span>
                                            </a>
                                        @else
                                            <a class="btn default" >
                                                <span class="fa fa-check approved" alt="{{$review->id}}"></span>
                                            </a>
                                            <a class="btn red-thunderbird ">
                                                <span class="glyphicon glyphicon-remove unapproved" alt="{{$review->id}}"></span>
                                            </a>
                                        @endif

                                        
                                        </td>                                  
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <h3>No Reviews</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
