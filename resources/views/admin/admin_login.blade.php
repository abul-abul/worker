<!DOCTYPE html>
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        {!! Html::style( asset('assets/metronic/assets/global/plugins/font-awesome/css/font-awesome.min.css')) !!}
        {!! Html::style( asset('assets/metronic/assets/global/plugins/simple-line-icons/simple-line-icons.min.css')) !!}
        {!! Html::style( asset('assets/metronic/assets/global/plugins/bootstrap/css/bootstrap.min.css')) !!}
        {!! Html::style( asset('assets/metronic/assets/global/plugins/uniform/css/uniform.default.css')) !!}
        {!! Html::style( asset('assets/metronic/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')) !!}
        {!! Html::style( asset('assets/metronic/assets/global/plugins/select2/css/select2.min.css')) !!}
        {!! Html::style( asset('assets/metronic/assets/global/css/components.min.css')) !!}
        {!! Html::style( asset('assets/metronic/assets/global/css/plugins.min.css')) !!}

        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        {!! Html::style( asset('assets/metronic/assets/pages/css/login.min.css')) !!}
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->

    <body class=" login">
        <div class="menu-toggler sidebar-toggler"></div>
        <!-- END SIDEBAR TOGGLER BUTTON -->
        <!-- BEGIN LOGO -->
        <div class="logo">
            <img src="{{ asset('assets/img/logo.png')}}" alt="" />
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content">
            <!-- BEGIN LOGIN FORM -->
            {!! Form::open(['action' => ['AdminController@postLogin'],'files' => 'true','class' => 'login-form', 'role' => 'form' ]) !!}
                <h3 class="form-title font-green" style="color: #157BBE!important;">Sign In</h3>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    <span> Enter any username and password. </span>
                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">E-mail</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="email" autocomplete="off" placeholder="E-mail" name="email" /> </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Password</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" /> </div>
                <div class="form-actions">
                    <button type="submit" class="btn green uppercase" style="background-color: #BC9E68;border-color: #B19669;">Login</button>
                </div>
            {!!Form::close()!!}
            <!-- END LOGIN FORM -->
            
        </div>
        <div class="copyright"> Admin Dashboard.</div>
        <!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        {!! Html::script( asset('assets/metronic/assets/global/plugins/jquery.min.js')) !!}
        {!! Html::script( asset('assets/metronic/assets/global/plugins/bootstrap/js/bootstrap.min.js')) !!}
        {!! Html::script( asset('assets/metronic/assets/global/plugins/js.cookie.min.js')) !!}
        {!! Html::script( asset('assets/metronic/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js')) !!}
        {!! Html::script( asset('assets/metronic/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')) !!}
        {!! Html::script( asset('assets/metronic/assets/global/plugins/jquery.blockui.min.js')) !!}
        {!! Html::script( asset('assets/metronic/assets/global/plugins/uniform/jquery.uniform.min.js')) !!}
        {!! Html::script( asset('assets/metronic/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')) !!}
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        {!! Html::script( asset('assets/metronic/assets/global/plugins/jquery-validation/js/jquery.validate.min.js')) !!}
        {!! Html::script( asset('assets/metronic/assets/global/plugins/jquery-validation/js/additional-methods.min.js')) !!}
        {!! Html::script( asset('assets/metronic/assets/global/plugins/select2/js/select2.full.min.js')) !!}

        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        {!! Html::script( asset('assets/metronic/assets/global/scripts/app.min.js')) !!}
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        {!! Html::script( asset('assets/metronic/assets/pages/scripts/login.min.js')) !!}
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
    </body>

</html>