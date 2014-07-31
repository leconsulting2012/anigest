	<!DOCTYPE html>
	<html>
	<head>
		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>
			@section('title')
			:: Anigest - Getionale per Antennisti
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
		
		<style>
		@section('styles')
		body {
			padding-top: 60px;
		}
		@show
		</style>
		</head>

		<body>

		<div class="bs-component">
		<div class="navbar navbar-default navbar-fixed-top">
		<div class="container">
		<div class="navbar-header">
		<a href="../" class="navbar-brand">Anigest</a>
		<button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		</button>
		</div>
		<div class="navbar-collapse collapse navbar-inverse-collapse" id="navbar-main">

		</li>
		</ul>

		<ul class="nav navbar-nav navbar-right">
		<li><a href="{{{ URL::to('user/login') }}}" target="_self">Entra</a></li>
		</ul>

		</div>
		</div>

		</div>

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
		{{ HTML::script('js/dataTables.bootstrap.js') }}
		{{ HTML::script('js/datatables.fnReloadAjax.js') }}
		{{ HTML::script('js/bootstrap.file-input.js') }}


		<script type="text/javascript">
		$(document).ready(function(){
			$('.combobox').combobox();

			});

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