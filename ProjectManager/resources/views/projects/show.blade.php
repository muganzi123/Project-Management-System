@extends('layouts.app')

@section('content')
<div>
<div class="col-sm-9 col-md-9 col-lg-9 pull-left">
  <!-- Jumbotron -->
  <div class="well well-lg">
    <h1>{{$project->name}}</h1>
    <p class="lead">{{$project->description}}</p>
    <!--<p><a class="btn btn-lg btn-success" href="#" role="button">Get started today</a></p>-->
  </div>

  <!-- Example row of columns -->
  
  <div class="row" style="background-color: white; margin: 10px">
    
    <div class="row container-fluid" style="margin: 10px">
      <form method="post" action="{{route('comments.store')}}">
          {{ csrf_field() }}
          
          <input type="hidden" name="commentable_type" value="App\Project">
          <input type="hidden" name="commentable_id" value="{{ $project->id }}">

          <div class="form-group">
            <label for="company-content">Comment</label>
            <textarea
              placeholder="Enter comment"
              style="resize: vertical;"
              id="comment-content"
              name="body" 
              rows="3"
              cols="80"
              spellcheck="false"
              class="form-control autosize-target text-left"></textarea>
          </div>
          <div class="form-group">
            <label for="company-name">URL (evidence)<span class="required">*</span></label>
            <textarea
              placeholder="Enter URL or screenshots"
              id="comment-name"
              name="url" 
              rows="2"
              spellcheck="false" 
              class="form-control autosize-target text-left"></textarea>
          </div>    
          <div class="form-group mt-2"> 
            <input type="submit" class="btn btn-primary" value="Submit">
          </div>
      </form>
    </div>
    
  </div>
  <footer class="footer pull-left">
    <p>©MBR Innovates 2018</p>
  </footer>
  
</div>

<div class="col-sm-3 col-md.3 col-lg-3 ml-sm-auto pull-right">
  
  <div class="sidebar-module">
    <h4>Management</h4>
    <ol class="list-unstyled">
      <li><a href="/projects/{{$project->id}}/edit">Edit this project</a></li>
      <li><a href="/projects">My Projects</a></li>
      <li><a href="/projects/create">Add Project</a></li>
      <li><a href="/tasks/create/{{$project->id}}">Add Task</a></li>
      <br>
      @if($project->user_id == Auth::user()->id)
      <!--Delete Project Button-->
      <li>
        <a href="#" onclick="
          var result=confirm('Are you sure you wish to delete this task?');
          if (result) {
            event.preventDefault();
            document.getElementById('delete-form').submit();
          }">
          Delete
        </a>
        <form id="delete-form" action="{{ route('projects.destroy',[$project->id]) }}" method="POST" style="display: none;">
          <input type="hidden" name="_method" value="delete">
          {{ csrf_field() }}
        </form>
      </li>
      @endif
      <!--li><a href="#">Add new user</a></li-->
    </ol>
  </div>
  <div class="sidebar-module">
    <h4>Members</h4>
    <ol class="list-unstyled">
      <li><a href="#">October 2018</a></li>
    </ol>
  </div>
</div>
</div>
<!-- Site footer -->

@endsection