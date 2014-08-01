<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title',"Task manager")</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.css" rel="stylesheet">
    @yield('head')

</head>
<body role="document" style="padding-top: 20px;">


    <div class="container" role="main">
      <div class="header">
        @if(Session::get('flash_message'))
            <div class="alert alert-info">  
              <a class="close" data-dismiss="alert">x</a>  
              <strong>{{ Session::get('flash_message') }}</strong>
            </div>  
        @endif

        <nav role="navigation" class="navbar navbar-default">
            <ul class="nav navbar-nav">
              <li ><a href="/welcome">Home</a></li>
            </ul>


          @if(Auth::check())
                <form class="navbar-form navbar-right" role="form" method="GET" action="logout">
                    <button type="submit" class="btn btn-info">Log Out</button>
                </form>
                <p class="navbar-right navbar-text">Hello {{Auth::user()->firstname}} !</p>
          @else 
                <form class="navbar-form navbar-right" role="form" method="GET" action="signup">
                    <button type="submit" class="btn btn-info">Sign up</button>
                </form>
                <p class="navbar-right navbar-text">-or-</p>
                <form class="navbar-form navbar-right" role="form" method="POST" action="login">
                    {{Form::token()}}
                    <input type="text" placeholder="Email" name="email" class="form-control" >
                    <input type="password" placeholder="Password" name="password" class="form-control">
                    <button type="submit" class="btn btn-success">Sign in</button>
                </form>
          @endif
        </nav>
      </div>


        @yield('content') 
        
        @if(Auth::check())
            @yield('authorized_content') 
        @else 
             <div class="alert alert-danger">
                 <strong>Please Log in to proceed further. </strong>
             </div>
        @endif
    </div>

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
   <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

   @yield('footer') 

</body>
</html>
