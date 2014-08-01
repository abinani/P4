<!-- /app/views/edittask.blade.php -->
@extends('_master')

@section('head')
    <title>@yield('title',"Task manager")</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.css" rel="stylesheet">
    @yield('head')

    <style>

     body {
      padding-top: 40px;
      padding-bottom: 40px;
    }

    .form-update {
      max-width: 730px;
      padding: 15px;
      margin: 0 auto;
    }
    </style>
@stop

@section('authorized_content')
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Update Task</h3>
  </div>
  <div class="panel-body">
    <div class="container form-update">
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
       <button type="submit" class="btn btn-default">Update</button>
      </form>
    </div>
  </div>
</div>    
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
   <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
@stop
 
@section('non_authorized_content')
 <div class="alert alert-danger">
     <strong>Please Log in to proceed further. </strong>
 </div>

@stop
 
