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

@section('authorized_content')
    <div class="container">
      <form role="form" method="POST" action="/edittask/{{$task->id}}">
      {{Form::token()}}
      <div class="form-group">
        <label for="task_description">Task Description</label>
        <input type="text" class="form-control" id="task_description" name="task_desc" value="{{$task->description}}"> 
      </div>
      <div class="form-group">
        <label for="due_date">Due Date</label>
        <input type="datetime-local" class="form-control" id="due_date" name="due_date" 
          value="{{ (new DateTime($task->due_date))->format("Y-m-d\TH:i")}}">
      </div>

      <div class="form-group">
       <label for="status">Status</label>
       <select class="form-control" name="status" id="status">
          @if($task->status == 'COMPLETED')
             <option>COMPLETED</option>
             <option>PENDING</option>
          @else
             <option>PENDING</option>
             <option>COMPLETED</option>
          @endif
       </select>
      </div>
       <button type="submit" class="btn btn-default">Edit</button>
      </form>
    </div>

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
   <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
@stop
 
@section('non_authorized_content')
 <div class="alert alert-danger">
     <strong>Please Log in to proceed further. </strong>
 </div>

@stop
 
@include("_authenticate")
</body>
</html>

