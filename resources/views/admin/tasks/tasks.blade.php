@extends('admin.dashboard')
@section('content')
<!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <span>Tasks</span>
            </li>
        </ul>
    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <h3 class="page-title">Tasks List
    </h3>
    <!-- END PAGE TITLE-->

    <div class="row-fluid">
        <div class="span12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-list"></i>Tasks</div>          
                </div>
                <div class="portlet-body no-more-tables">
                    @if (count($tasks) > 0)
                    <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th> <b>#</b></th>
                                    <th> Location</th>
                                    <th> Username</th>
                                    <th> E-mail</th>
                                    <th> Category</th>   
                                    <th> Choose Date</th>    
                                    <th> Task Details</th>                     
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)
                                    <tr>
                                        <td><b>{{$task->id}}</b></td>
                                        <td>{{$task->location}}</td>                                        
                                        <td>{{$task->user->username}}</td>
                                        <td>{{$task->user->email}}</td>
                                        <td>{{$task->category->name}}</td>
                                        <td>{{$task->choose_date}}</td>                                
                                        <td>
                                            <a href="{{ action('AdminController@getTaskDetail', $task->id) }}" class="btn dark btn-sm btn-outline sbold uppercase">
                                                <i class="fa fa-share"></i> View
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <h3>No Tasks</h3>
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
                    <a href="" id="delete_item"><button type="button" class="btn red">Delete</button></a>
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
            $('#delete_item').attr('href','/admin/delete-item/'+id);
        });
    </script>
@endsection