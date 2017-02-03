<ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
    <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
    <li class="sidebar-toggler-wrapper hide">
        <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
        <div class="sidebar-toggler"> </div>
        <!-- END SIDEBAR TOGGLER BUTTON -->
    </li>
    <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
    <li class="sidebar-search-wrapper">
        <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->

        <!-- END RESPONSIVE QUICK SEARCH FORM -->
    </li>
    <li class="nav-item start active open">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="icon-home"></i>
            <span class="title">Dashboard</span>
            <span class="selected"></span>
            <span class="arrow open"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item start active open">
                <a href="{{ action('AdminController@getDashboard') }}" class="nav-link ">
                    <i class="icon-home"></i>
                    <span class="title">Home</span>
                    <span class="selected"></span>
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-item  ">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="icon-users"></i>
            <span class="title">Users</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
           <li class="nav-item start">
                <a href="{{ action('AdminController@getUsers') }}" class="nav-link ">
                    <i class="glyphicon glyphicon-user"></i>
                    <span class="title">User's list</span>
                    <span class="selected"></span>
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-item  ">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="icon-list"></i>
            <span class="title">Tasks</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
           <li class="nav-item start">
                <a href="{{ action('AdminController@getTasks') }}" class="nav-link ">
                    <i class="glyphicon glyphicon-list-alt"></i>
                    <span class="title">Tasks list</span>
                    <span class="selected"></span>
                </a>
            </li>
        </ul>
    </li>
                 
</ul>

