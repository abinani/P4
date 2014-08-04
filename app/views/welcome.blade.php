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
  <li><a href="#add_task" role="tab" data-toggle="tab">Add Task</a></li>
  <li class="active"><a href="#pending_tasks" role="tab" data-toggle="tab">Pending Tasks</a></li>
  <li><a href="#completed_tasks" role="tab" data-toggle="tab">Completed Tasks</a></li>
  <li><a href="#all_tasks" role="tab" data-toggle="tab">All Tasks</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane active" id="pending_tasks">
    
     @if ( isset($pending_tasks) && count($pending_tasks) > 0)
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Description</th>
              <th>Creation Date</th>
              <th>Due Date</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($pending_tasks as $task)
            <tr>
              <td>{{$task->description}}</td>
              <td>
                  {{$task->created_at}}
               </td>
               <td>
                <ul class="list-inline">
                    <li>
                        {{$task->due_date}}
                    </li>
                    <li>
                      <form class="form-inline" role="form" method="GET" action="edittask/{{$task->id}}">
                        <button type="submit" class="btn btn-edit">Update</button>
                      </form>
                   </li>
                   <li>  
                      <form class="form-inline" role="form" method="GET" action="deletetask/{{$task->id}}">
                        <button type="submit" class="btn btn-danger">Delete</button>
                      </form>
                  </li>
                </ul>
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
         <table class="table table-striped">
          <thead>
            <tr>
              <th>Description</th>
              <th>Creation Date</th>
              <th>Completion Date</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($completed_tasks as $task)
            <tr>
              <td>{{$task->description}}</td>
              <td>
                  {{$task->created_at}}
              </td>
              <td>
                <ul class="list-inline">
                    <li>
                   {{$task->completion_date}}
                   </li>
                    <li>
                      <form class="form-inline" role="form" method="GET" action="edittask/{{$task->id}}">
                        <button type="submit" class="btn btn-edit">Update</button>
                      </form>
                   </li>
                   <li>  
                      <form class="form-inline" role="form" method="GET" action="deletetask/{{$task->id}}">
                        <button type="submit" class="btn btn-danger">Delete</button>
                      </form>
                  </li>
                </ul>
              </td>
            </tr>
            @endforeach
          </tbody>
         </table>
     @else     
        No completed tasks
     @endif
  </div>

  <div class="tab-pane" id="all_tasks">
     <table class="table">
      <thead>
        <tr>
          <th>Description</th>
          <th>Creation Date</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
            @foreach ($completed_tasks as $task)
             <tr class="success">
              <td>{{$task->description}}</td>
              <td>
                  {{$task->created_at}}
              </td>
              <td>
                <ul class="list-inline">
                    <li>
                      Completed
                      &nbsp;&nbsp;&nbsp;&nbsp;
                   </li>
                    <li>
                      <form class="form-inline" role="form" method="GET" action="edittask/{{$task->id}}">
                        <button type="submit" class="btn btn-edit">Update</button>
                      </form>
                   </li>
                   <li>  
                      <form class="form-inline" role="form" method="GET" action="deletetask/{{$task->id}}">
                        <button type="submit" class="btn btn-danger">Delete</button>
                      </form>
                  </li>
                </ul>
             </td>
            </tr>
            @endforeach
            @foreach ($pending_tasks as $task)
             <tr class="active">
              <td>{{$task->description}}</td>
              <td>
                  {{$task->created_at}}
              </td>
              <td>
                <ul class="list-inline">
                    <li>
                      Pending&nbsp;&nbsp;&nbsp;&nbsp;
                      &nbsp;&nbsp;&nbsp;&nbsp;
                   </li>
                    <li>
                      <form class="form-inline" role="form" method="GET" action="edittask/{{$task->id}}">
                        <button type="submit" class="btn btn-edit">Update</button>
                      </form>
                   </li>
                   <li>  
                      <form class="form-inline" role="form" method="GET" action="deletetask/{{$task->id}}">
                        <button type="submit" class="btn btn-danger">Delete</button>
                      </form>
                  </li>
                </ul>
              </td>
            </tr>
            @endforeach
      </tbody>
    </table>
  </div>

  <div class="tab-pane" id="add_task">
      <br>
      <form role="form" method="POST" action="/addtask">
      {{Form::token()}}
      <div class="form-group">
        <label for="task_description">Task Description</label>
        <input type="text" class="form-control" id="task_description" name="task_desc" placeholder="Task Description">
      </div>
      <div class="form-group">
        <label for="due_date">Due Date</label>
        <input type="datetime-local" class="form-control" id="due_date" name="due_date" 
               value="{{(new DateTime('now'))->format("Y-m-d\TH:i")}}">
      </div>
       <button type="submit" class="btn btn-default">Submit</button>
      </form>
  </div>
</div>

@stop
