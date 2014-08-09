<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>
            @section('title')
            Anigest - Modale
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

    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-xs-12">
                <!-- Notifications -->
                @include('notifications')
                <!-- ./ notifications -->
                @yield('content')
            </div>
        </div>
    </section>
    <!-- /.content -->    

    <!-- jQuery 2.0.2 -->
    {{ HTML::script('js/moment.min.js') }}
    {{ HTML::script('js/jquery.min.js') }} 
    <!-- Bootstrap -->
    {{ HTML::script('js/bootstrap.min.js') }}        
    <!-- Colorbox -->
    {{ HTML::script('js/jquery.colorbox-min.js') }}

    <!-- Js esterni -->
    @yield('jsEsterni')

    <!-- AdminLTE App -->
    {{ HTML::script('js/plugins/AdminLTE/app.js') }}

    <script type="text/javascript">
    $(document).ready(function(){
        $('.close_popup').click(function(){
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

    @yield('scripts')

    </body>
</html>    