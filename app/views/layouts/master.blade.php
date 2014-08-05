	<!DOCTYPE html>
	<html>
	<head>
		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>
			@section('title')
			:: Gestionale Fatturazione
			@show
		</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!--  Mobile Viewport Fix -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">        
		<meta name="keywords" content="@yield('keywords')" />
		<meta name="author" content="@yield('author')" />
		<!-- Google will often use this as its description of your page/site. Make it good. -->
		<meta name="description" content="@yield('description')" />

		<!-- Speaking of Google, don't forget to set your site up: http://google.com/webmasters -->
		<meta name="google-site-verification" content="">

		<!-- Dublin Core Metadata : http://dublincore.org/ -->
		<meta name="DC.title" content="Project Name">
		<meta name="DC.subject" content="@yield('description')">
		<meta name="DC.creator" content="@yield('author')">

		<!-- CSS are placed here -->
		{{ HTML::style('bootstrap/css/bootstrap.min.css') }}
		{{ HTML::style('css/bootstrap-combobox.css') }}
		{{ HTML::style('css/colorbox.css') }}
		{{ HTML::style('css/datepicker3.css') }}
		{{ HTML::style('css/jquery.dataTables.css') }}
		{{ HTML::style('css/dataTables.bootstrap.css') }}
		{{ HTML::style('css/bootstrap-datetimepicker.min.css') }}
		{{ HTML::style('css/fullcalendar.css') }}
		@section('cssEsterni')
		@show

		@section('jsEsterniBefore')
		@show
		
		<style>
		@section('styles')
		body {
			padding-top: 60px;
		}
		@show
		</style>
		</head>

	@section('bodyOnLoad')
	:: <body>
	@show

		<div class="bs-component">
		<!-- Navbar -->
		<div class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
    			<div class="collapse navbar-collapse navbar-ex1-collapse">
    				<ul class="nav navbar-nav">
    					<li{{ (Request::is('admin') ? ' class="active"' : '') }}><a href="{{{ URL::to('admin') }}}"><span class="glyphicon glyphicon-home"></span> Home</a></li>
    					@if (Auth::user()->hasRole('admin'))
    					<li{{ (Request::is('admin/blogs*') ? ' class="active"' : '') }}><a href="{{{ URL::to('admin/blogs') }}}"><span class="glyphicon glyphicon-list-alt"></span> Notizie</a></li>
    					<li class="dropdown{{ (Request::is('admin/users*|admin/roles*') ? ' active' : '') }}">
    						<a class="dropdown-toggle" data-toggle="dropdown" href="{{{ URL::to('admin/users') }}}">
    							<span class="glyphicon glyphicon-user"></span> Utenti <span class="caret"></span>
    						</a>
    						<ul class="dropdown-menu">
    							<li{{ (Request::is('admin/users*') ? ' class="active"' : '') }}><a href="{{{ URL::to('admin/users') }}}"><span class="glyphicon glyphicon-user"></span> Utenti</a></li>
    							<li{{ (Request::is('admin/roles*') ? ' class="active"' : '') }}><a href="{{{ URL::to('admin/roles') }}}"><span class="glyphicon glyphicon-user"></span> Ruoli</a></li>
    						</ul>
    					</li>
    					@endif
    					<li class="dropdown{{ (Request::is('antenne*|router*') ? ' active' : '') }}">
    						<a class="dropdown-toggle" data-toggle="dropdown" href="{{{ URL::to('antenne') }}}">
    							<span class="glyphicon glyphicon-signal"></span> Gestione <span class="caret"></span>
    						</a>
    						<ul class="dropdown-menu">
    							<li{{ (Request::is('anagrafiche*') ? ' class="active"' : '') }}><a href="{{{ URL::to('anagrafiche') }}}"><span class="glyphicon glyphicon-user"></span> Anagrafiche</a></li>
    							<li{{ (Request::is('antenne*') ? ' class="active"' : '') }}><a href="{{{ URL::to('antenne') }}}"><span class="glyphicon glyphicon-signal"></span> Antenne</a></li>
    							<li{{ (Request::is('routers*') ? ' class="active"' : '') }}><a href="{{{ URL::to('routers') }}}"><span class="glyphicon glyphicon-hdd"></span> Routers</a></li>
    							<li{{ (Request::is('interventi*') ? ' class="active"' : '') }}><a href="{{{ URL::to('interventi') }}}"><span class="glyphicon glyphicon-wrench"></span> Interventi</a></li>
    							@if (!Auth::user()->hasRole('installatore'))
    							<li{{ (Request::is('wizardAria') ? ' class="active"' : '') }}><a href="{{{ URL::to('wizardAria') }}}"><span class="glyphicon glyphicon-star"></span> Wizard Aria</a></li>
    							@endif
    						</ul>
    					</li>
    			<!--		<li class="dropdown{{ (Request::is('magazzino/*') ? ' active' : '') }}">
    						<a class="dropdown-toggle" data-toggle="dropdown" href="{{{ URL::to('antenne') }}}">
    							<span class="glyphicon glyphicon-tags"></span> Magazzino <span class="caret"></span>
    						</a>
    						<ul class="dropdown-menu">
    						    <li{{ (Request::is('magazzino/antenne') ? ' class="active"' : '') }}><a href="{{{ URL::to('magazzino/antenne') }}}"><span class="glyphicon glyphicon-signal"></span> Antenne</a></li>
    						    <li{{ (Request::is('magazzino/routers') ? ' class="active"' : '') }}><a href="{{{ URL::to('magazzino/routers') }}}"><span class="glyphicon glyphicon-hdd"></span> Routers</a></li>
    						</ul>
    					</li>     -->					
    					<li{{ (Request::is('calendario') ? ' class="active"' : '') }}><a href="{{{ URL::to('calendario') }}}"><span class="glyphicon glyphicon-calendar"></span> Calendario</a></li>
    				<!--	<li{{ (Request::is('mappa') ? ' class="active"' : '') }}><a href="{{{ URL::to('mappa') }}}"><span class="glyphicon glyphicon-globe"></span> Mappa</a></li> -->
    				</ul>
    				<ul class="nav navbar-nav pull-right">
    					<li class="divider-vertical"></li>
    					<li class="dropdown">
    							<a class="dropdown-toggle" data-toggle="dropdown" href="#">
    								<span class="glyphicon glyphicon-user"></span> {{{ Auth::user()->username }}}	<span class="caret"></span>
    							</a>
    							<ul class="dropdown-menu">
    								<li><a href="{{{ URL::to('user/settings') }}}"><span class="glyphicon glyphicon-wrench"></span> Impostazioni</a></li>
    								<li class="divider"></li>
    								<li><a href="{{{ URL::to('user/logout') }}}"><span class="glyphicon glyphicon-share"></span> Esci</a></li>
    							</ul>
    					</li>
    				</ul>
    			</div>
            </div>
		</div>
		<!-- ./ navbar -->
		
		<!-- Notifications -->
		@include('notifications')
		<!-- ./ notifications -->

		<!-- Container -->
		<div class="container">

		<!-- Content -->
		@yield('content')










		</div>


		<!-- Footer -->
		<footer class="clearfix">
		@yield('footer')
		</footer>
		<!-- ./ Footer -->

		<!-- Scripts are placed here -->
		{{ HTML::script('js/jquery-1.11.1.min.js') }}
		{{ HTML::script('bootstrap/js/bootstrap.min.js') }}
		{{ HTML::script('js/bootstrap-combobox.js') }}
		{{ HTML::script('js/bootstrap-datepicker.js') }}
		{{ HTML::script('js/locales/bootstrap-datepicker.it.js') }}
		{{ HTML::script('js/jquery.colorbox-min.js') }}
		{{ HTML::script('js/jquery.dataTables.js') }}
		{{ HTML::script('js/dataTables.bootstrap.js') }}
		{{ HTML::script('js/datatables.fnReloadAjax.js') }}
		{{ HTML::script('js/bootstrap.file-input.js') }}
		{{ HTML::script('js/DT_bootstrap.js') }}
		{{ HTML::script('js/jquery-DT-pagination.js') }}
		{{ HTML::script('js/moment.js') }}
		{{ HTML::script('js/fullcalendar.min.js') }}
		{{ HTML::script('js/locales/fullcalendar_it.js') }}
		@section('jsEsterni')
		@show


		<script type="text/javascript">

		$('#data').datepicker({
			format: "dd/mm/yyyy",
			language: "it",
			autoclose: true,
			todayHighlight: true
			});

		$('#tooltip').tooltip('show')

		</script>

		@yield('scripts')

		</body>
		</html>