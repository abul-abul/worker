@extends('admin.dashboard')
@section('content')
    <div class="row-fluid">
        <div class="span12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-users"></i>Users</div>          
                </div>
                <div class="portlet-body no-more-tables">
                    @if (count($users) > 0)
                    <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th><b>#</b></th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Company</th>
                                    <th>Phone</th>
                                    <th>Country</th>
                                    <th>City</th>        
                                    <th>Role</th>
                                    <th>Active</th> 
                                    <th>Rate</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td><b>{{$user->id}}</b></td>
                                        <td>{{$user->username}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->company}}</td>
                                        <td>{{$user->phone}}</td>
                                        <td>{{$user->country}}</td>
                                        <td>{{$user->city}}</td>
                                        <td>
                                            @if($user->role == 'seeker')
                                                <span class="label label-sm label-success"> Seeker </span>
                                            @else 
                                                <span class="label label-sm label-warning"> Provider </span>                                             
                                            @endif
                                        </td>
                                        <td>
                                            @if($user->active)
                                                <a class="btn green-jungle" >
                                                    <span class="fa fa-check" ></span>
                                                </a>
                                            @else
                                                <a class="btn red-flamingo ">
                                                    <span class="glyphicon glyphicon-remove"></span>
                                                </a>
                                            @endif    
                                        </td>
                                        <td>
                                            
                                            @if($user->role == 'seeker')
                                                <a class="btn red-flamingo ">
                                                    <span class="glyphicon glyphicon-remove"></span>
                                                </a>
                                            @else 
                                                @if($user->rate == null)
                                                    <span class="label label-sm label-info"><b>0</b></span>  
                                                @else
                                                    <span class="label label-sm label-info" ><b>{{$user->rate}}</b></span>  
                                                     
                                                @endif                                               
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ action('AdminController@getEditUser', $user->id) }}" class="btn btn-outline btn-circle btn-sm green">
                                                <i class="fa fa-edit"></i> Edit </a>
                                        </td>
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <h3>No Users</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bs-modal-sm" id="small" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Delete Item </h4>
                </div>
                <div class="modal-body"> Modal body goes here </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    <a href="" id="delete_user"><button type="button" class="btn red">Delete</button></a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(".show_modal" ).click(function() {
            var id = $(this).attr('alt');
            $('#delete_user').attr('href','/admin/delete-user/'+id);
        });
    </script>
@endsection