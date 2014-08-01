@extends('_master')

@section('content')
<div class="jumbotron">
    <h2><strong>Welcome to Task Manager </strong></h2>
    <p> The website provides a simple Task manager to manage your day-to-day activities.
    </p>
</div>
@stop

@section('authorized_content')
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
   <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
  <li><a class="btn btn-default" href="addtask" role="button" >Add Task</a></li>
  <li class="active"><a href="#pending_tasks" role="tab" data-toggle="tab">Pending Tasks</a></li>
  <li><a href="#completed_tasks" role="tab" data-toggle="tab">Completed Tasks</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane active" id="pending_tasks">
    
     @if ( isset($pending_tasks) && count($pending_tasks) > 0)
        <table class="table">
          <thead>
            <tr>
              <th>Description</th>
              <th>DueDate</th>
              <th>Update</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($pending_tasks as $task)
            <tr>
              <td>{{$task->description}}</td>
              <td>{{$task->due_date}}</td>
              <td>
                  <form class="form-inline" role="form" method="GET" action="edittask/{{$task->id}}">
                    <button type="submit" class="btn btn-edit">Edit</button>
                  </form>
              </td>
            </tr>
            @endforeach
          </tbody>
         </table>
     @else
        No pending tasks
     @endif

  </div>
  <div class="tab-pane" id="completed_tasks">
     @if ( isset($completed_tasks) && count($completed_tasks) > 0)
         <table class="table">
          <thead>
            <tr>
              <th>Description</th>
              <th>CompletionDate</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($completed_tasks as $task)
            <tr>
              <td>{{$task->description}}</td>
              <td>{{$task->updated_at}}</td>
            </tr>
            @endforeach
          </tbody>
         </table>
     @else     
        No completed tasks
     @endif
  </div>
</div>
@stop
