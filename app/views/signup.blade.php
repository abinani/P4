<!-- /app/views/signup.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title',"Task manager")</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.css" rel="stylesheet">
    @yield('head')

    <style>

     body {
      padding-top: 40px;
      padding-bottom: 40px;
      background-color: #eee;
    }

    .form-signin {
      max-width: 330px;
      padding: 15px;
      margin: 0 auto;
    }
    </style>

</head>
<body role="document" style="padding-top: 20px;">

    <div class="container">
      <form class="form-signin" role="form" method="POST" action="signup">
        {{Form::token()}}
        <h2 class="form-signin-heading">Please Sign Up</h2>
        <input type="text" class="form-control" placeholder="First Name" name="first_name" required autofocus>
        <input type="text" class="form-control" placeholder="Last Name" name="last_name" required autofocus>
        <input type="email" class="form-control" placeholder="Email address" name="email" required autofocus>
        <input type="password" class="form-control" placeholder="Password" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign Up</button>
      </form>
    </div>

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
   <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

</body>
</html>


