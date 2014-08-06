<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>AdminLTE | Log in</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        {{ HTML::style('css/bootstrap.min.css') }}
        <!-- font Awesome -->
        {{ HTML::style('css/font-awesome.min.css') }}
        <!-- Theme style -->
        {{ HTML::style('css/AdminLTE.css') }}
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-black">
                        <!-- Notifications -->
                    @include('notifications')
                    <!-- ./ notifications -->
        <div class="form-box" id="login-box">

            <div class="header">AniGEST - Login</div>
            <form action="{{ URL::to('user/login') }}" method="post" accept-charset="UTF-8">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="body bg-gray">
                    <div class="form-group">
                        <input type="text" name="email" class="form-control" placeholder="Username o Email"/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password"/>
                    </div>          
                    <div class="form-group">
                        <input type="hidden" name="remember" value="0">
                        <input type="checkbox" name="remember" id="remember"> Ricordami su questo computer
                    </div>
                </div>
                <div class="footer">                                                               
                    <button type="submit" class="btn bg-olive btn-block">Entra</button>  
                    
                    <p><a href="forgot">Password Dimenticata?</a></p>

                </div>
            </form>

        </div>


        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        {{ HTML::script('js/bootstrap.min.js') }}        

    </body>
</html>
