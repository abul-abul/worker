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
    <h3 class="page-title">Metals
    </h3>
    <!-- END PAGE TITLE-->

    <div class="row-fluid">
        <div class="span12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-list"></i></div>          
                </div>
                <div class="portlet-body no-more-tables">
                    @if (count($metals) > 0)
                    <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th> #</th>
                                    <th> Name</th>
                                    <th> Edit</th>                                
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($metals as $metal)
                                    <tr>
                                        <td>{{$metal->id}}</td>                                 
                                        <td>{{$metal->name}}</td>
                                        <td>
                                            <a href="{{ action('AdminController@getEditMetal', $metal->id) }}" class="btn btn-outline btn-circle btn-sm green">
                                                <i class="fa fa-edit"></i> Edit 
                                            </a>
                                        </td>                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <h3>No Metals</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
