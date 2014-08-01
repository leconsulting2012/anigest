    <!DOCTYPE html>
    <html>
    <head>

    	<meta charset="UTF-8">

    	<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
    	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    	<title>
    		@section('title')
    		{{{ $title }}} :: Gestionale Fatturazione
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

    	{{ HTML::style('css/jquery.dataTables.css') }}
        {{ HTML::style('css/bootstrap-datetimepicker.min.css') }}        

    	<style>
    	@section('styles')
    	body {
    		padding-top: 60px;
    	}
    	@show
    	</style>

    	</head>

    	<body>
	<!-- Container -->
	<div class="container">

		<!-- Notifications -->
		@include('notifications')
		<!-- ./ notifications -->

		<div class="page-header">
			<h3>
				{{ $title }}
				<div class="pull-right">
					<button class="btn btn-default btn-small btn-inverse close_popup"><span class="glyphicon glyphicon-circle-arrow-left"></span> Torna</button>
				</div>
			</h3>
		</div>

    	<!-- Content -->
    	@yield('content')



        <!-- Footer -->
        <footer class="clearfix">
        @yield('footer')
        </footer>
        <!-- ./ Footer -->

        </div>
        <!-- ./ container -->




        <!-- Scripts are placed here -->
        {{ HTML::script('js/jquery-1.11.1.min.js') }}
        {{ HTML::script('bootstrap/js/bootstrap.min.js') }}
        {{ HTML::script('js/bootstrap-combobox.js') }}
        {{ HTML::script('js/jquery.colorbox-min.js') }}
        {{ HTML::script('js/jquery.dataTables.js') }}
        {{ HTML::script('js/moment.js') }}
        {{ HTML::script('js/bootstrap-datetimepicker.min.js') }}
        {{ HTML::script('js/bootstrap-datetimepicker.pt-IT.js') }}        


        <script type="text/javascript">
        $(document).ready(function(){
          $('.combobox').combobox();

          });

        $('#tooltip').tooltip('show')


        $(document).ready(function(){
          $('.close_popup').click(function(){
           parent.oTable.fnReloadAjax();
           parent.jQuery.fn.colorbox.close();
           return false;
           });
          $('cboxClose').click(function(){
           parent.oTable.fnReloadAjax();
           parent.jQuery.fn.colorbox.close();
           return false;
           });
          $('#deleteForm').submit(function(event) {
           var form = $(this);
           $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            data: form.serialize()
            }).done(function() {
             parent.jQuery.colorbox.close();
             parent.oTable.fnReloadAjax();
             }).fail(function() {
              });
             event.preventDefault();
             });
          });

        </script>

         <!-- Scripts specifici -->
        @yield('scripts')

        </body>
        </html>