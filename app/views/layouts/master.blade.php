<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>
            @section('title')
            Anigest
            @show
        </title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        {{ HTML::style('css/bootstrap.min.css') }}
        <!-- font Awesome -->
        {{ HTML::style('css/font-awesome.min.css') }}
        <!-- Ionicons -->
        {{ HTML::style('css/ionicons.min.css') }}
        <!-- Theme style -->
        {{ HTML::style('css/AdminLTE.css') }}

        {{ HTML::style('css/colorbox.css') }}

        @section('cssEsterni')
        @show

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        @section('jsEsterniBefore')
        @show
    </head>
    @section('bodyOnLoad')
    @show

        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="/" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                AniGEST
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top navbar" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope"></i>
                            </a>
                        </li>
                        <!-- Notifications: style can be found in dropdown.less -->
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-warning"></i>
                            </a>

                        </li>
                        <!-- Tasks: style can be found in dropdown.less -->
                        <li class="dropdown tasks-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-tasks"></i>
                            </a>

                        </li>
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>{{{ Auth::user()->username }}} <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="{{{ URL::to('img') }}}/avatar5.png" class="img-circle" alt="User Image" />
                                    <p>
                                        {{{ Auth::user()->username }}} - {{{ Auth::user()->profile }}}
                                        <small>Membro da {{{ Auth::user()->created_at }}}</small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="{{{ URL::to('user/settings') }}}" class="btn btn-default btn-flat">Profilo</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="{{{ URL::to('user/logout') }}}" class="btn btn-default btn-flat">Esci</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">                
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="{{{ URL::to('img') }}}/avatar5.png" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Ciao, {{{ Auth::user()->username }}}</p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form -->
                    <!--<form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form> -->
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="{{{ URL::to('/') }}}">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        @if (Auth::user()->hasRole('admin'))
                        <li{{ (Request::is('admin/blogs*') ? ' class="active"' : '') }}><a href="{{{ URL::to('admin/blogs') }}}"><span class="glyphicon glyphicon-list-alt"></span> Notizie</a></li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-folder"></i> <span>Utenti</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li{{ (Request::is('admin/users*') ? ' class="active"' : '') }}><a href="{{{ URL::to('admin/users') }}}"><span class="glyphicon glyphicon-user"></span> Utenti</a></li>
                                <li{{ (Request::is('admin/roles*') ? ' class="active"' : '') }}><a href="{{{ URL::to('admin/roles') }}}"><span class="glyphicon glyphicon-user"></span> Ruoli</a></li>
                            </ul>
                        </li>
                        @endif

                        <li{{ (Request::is('anagrafiche*') ? ' class="active"' : '') }}><a href="{{{ URL::to('anagrafiche') }}}"><span class="glyphicon glyphicon-user"></span> Anagrafiche</a></li>
                        <li{{ (Request::is('antenne*') ? ' class="active"' : '') }}><a href="{{{ URL::to('antenne') }}}"><span class="glyphicon glyphicon-signal"></span> Antenne</a></li>
                        <li{{ (Request::is('routers*') ? ' class="active"' : '') }}><a href="{{{ URL::to('routers') }}}"><span class="glyphicon glyphicon-hdd"></span> Routers</a></li>
                        <li{{ (Request::is('interventi*') ? ' class="active"' : '') }}><a href="{{{ URL::to('interventi') }}}"><span class="glyphicon glyphicon-wrench"></span> Interventi</a></li>
                        @if (!Auth::user()->hasRole('installatore'))
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-folder"></i> <span>Wizards</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li{{ (Request::is('wizardAria') ? ' class="active"' : '') }}><a href="{{{ URL::to('wizardAria') }}}"><span class="glyphicon glyphicon-star"></span> Aria Terna Servizi</a></li>
                             </ul>
                        </li>                       
                        @endif
                        <li{{ (Request::is('calendario') ? ' class="active"' : '') }}><a href="{{{ URL::to('calendario') }}}"><span class="glyphicon glyphicon-calendar"></span> Calendario</a></li>
                        <li{{ (Request::is('mappa') ? ' class="active"' : '') }}><a href="{{{ URL::to('mappa') }}}"><span class="glyphicon glyphicon-globe"></span> Mappa</a></li>

                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1> 
                        @section('title')
						@show
                        <small>Pannello di Controllo</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">{{{ $title }}}</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- Notifications -->
                        @include('notifications')
                        <!-- ./ notifications -->

                        @yield('content')
                    </div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


        <!-- jQuery 2.0.2 -->
        {{ HTML::script('js/moment.min.js') }}        
        {{ HTML::script('js/jquery.min.js') }} 
        {{ HTML::script('js/jquery-ui.custom.min.js') }}
        <!-- Bootstrap -->
        {{ HTML::script('js/bootstrap.min.js') }}        
        <!-- Colorbox -->
        {{ HTML::script('js/jquery.colorbox-min.js') }}
        {{ HTML::script('js/jquery.colorbox-it.js') }}
        <!-- Js esterni -->
        @yield('jsEsterni')

        <!-- AdminLTE App -->
        {{ HTML::script('js/plugins/AdminLTE/app.js') }}

        @yield('scripts')

    </body>
</html>