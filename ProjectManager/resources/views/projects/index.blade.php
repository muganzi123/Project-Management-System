@extends('layouts.app')
@section('content')

<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Companies</title>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet"
         href="{{asset('js/datatables.min.css')}}">

    </head>

    <body>

        <div class="container" style="width:1000px;">
        @include('flash::message')
        
          <h1 class="text-center">REGISTERED PROJECTS</h1>

         <a  class="pull-right btn btn-secondary" href="#">
        <i class="fa fa-plus-square" aria-hidden="true"></i>  Create new</a> 
         <div class="panel panel-secondary ">
         <div class="list-group-item list-group-item-action active">Projects <a  class="pull-right btn btn-primary btn-sm" href="/projects/create">
         <i class="fa fa-plus-circle" aria-hidden="true"></i>  Create Project</a> </div>
          <br /> 
			<table class="table table-bordered" id="companies-table">
				<thead>
					<tr>
                    <th class="text-center">Project Name</th>
                    <th class="text-center">Created At</th>
                    <th class="text-center">Updated</th>
                     <th class="text-center">Actions</th>
					</tr>
				</thead>
				@foreach($projects as $project)
     <tr class="project{{$project->id}}">
    <td>{{$project->name}}</td>
    <td>{{$project->created_at}}</td>
    <td>{{$project->updated_at}}</td>
    <td><a href="{{url('/projects/'.$project->id.'/edit')}}" class="edit-modal btn btn-info"
>
            <span class="glyphicon glyphicon-edit"></span> Edit
        </a>
        <button class="delete-modal btn btn-danger"
            data-info="{{$project->name}},{{$project->created_at}},{{$project->updated_at}}">
            <span class="glyphicon glyphicon-trash"></span> Delete
        </button></td>
     </tr>
    @endforeach
			</table>
		</div>
	</div>
	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"></h4>

				</div>
				<div class="modal-body">
					<form class="form-horizontal" role="form">
						<div class="form-group">
							<label class="control-label col-sm-2" for="fname">Name</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="fname" disabled>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2" for="createdat">Created At:</label>
							<div class="col-sm-10">
								<input type="name" class="form-control" id="createdat">
							</div>
						</div>
						<p class="fname_error error text-center alert alert-danger hidden"></p>
						<div class="form-group">
							<label class="control-label col-sm-2" for="updatedat">Updated At:</label>
							<div class="col-sm-10">
								<input type="name" class="form-control" id="updatedat">
							</div>
						</div>
						<p class="lname_error error text-center alert alert-danger hidden"></p>
						
						
					</form>
					<div class="deleteContent">
						Are you Sure you want to delete <span class="dname"></span> ? <span
							class="hidden did"></span>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn actionBtn" data-dismiss="modal">
							<span id="footer_action_button" class='glyphicon'> </span>
						</button>
						<button type="button" class="btn btn-warning" data-dismiss="modal">
							<span class='glyphicon glyphicon-remove'></span> Close
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
    @stop   

@section('js')
 @parent
	<script>
  $(document).ready(function() {
    $('#companies-table').DataTable();
} );
  </script>

	<script>
	
    $(document).on('click', '.edit-modal', function() {
        $('#footer_action_button').text(" Update");
        $('#footer_action_button').addClass('glyphicon-check');
        $('#footer_action_button').removeClass('glyphicon-trash');
        $('.actionBtn').addClass('btn-success');
        $('.actionBtn').removeClass('btn-danger');
        $('.actionBtn').removeClass('delete');
        $('.actionBtn').addClass('edit');
        $('.modal-title').text('Edit');
        $('.deleteContent').hide();
        $('.form-horizontal').show();
        var stuff = $(this).data('info').split(',');
        fillmodalData(stuff)
        $('#myModal').modal('show');
    });
    $(document).on('click', '.delete-modal', function() {
        $('#footer_action_button').text(" Delete");
        $('#footer_action_button').removeClass('glyphicon-check');
        $('#footer_action_button').addClass('glyphicon-trash');
        $('.actionBtn').removeClass('btn-success');
        $('.actionBtn').addClass('btn-danger');
        $('.actionBtn').removeClass('edit');
        $('.actionBtn').addClass('delete');
        $('.modal-title').text('Delete');
        $('.deleteContent').show();
        $('.form-horizontal').hide();
        var stuff = $(this).data('info').split(',');
        $('.did').text(stuff[0]);
        $('.dname').html(stuff[1] +" "+stuff[2]);
        $('#myModal').modal('show');
    });
function fillmodalData(details){
    $('#fname').val(details[0]);
    $('#createdat').val(details[1]);
    $('#updated').val(details[2]);
    
}
    $('.modal-footer').on('click', '.edit', function() {
        $.ajax({
            type: 'post',
            url: '/editItem',
            data: {
                '_token': $('input[name=_token]').val(),
                'fname': $('#fname').val(),
                'createdat': $('#createdat').val(),
                'updatedat': $('#updatedat').val()
            },
            success: function(data) {
            	if (project.errors){
                	$('#myModal').modal('show');
                    if(project.errors.fname) {
                    	$('.fname_error').removeClass('hidden');
                        $('.fname_error').text("Name can't be empty !");
                    }
                    if(project.errors.createdat) {
                    	$('.createdat_error').removeClass('hidden');
                        $('.createdat_error').text("Created at can't be empty !");
                    }
                    if(project.errors.updatedat) {
                    	$('.updatedat_error').removeClass('hidden');
                        $('.updatedat_error').text("Updated at can't be empty !");
                    }
                    
                }
            	 else {
            		 
                     $('.error').addClass('hidden');
                $('.project' + project.id).replaceWith("<tr class='project" + project.id + "'><td>" +
                        project.name + "</td><td>" + project.created_at +
                        "</td><td>" + project.updated_at + "</td><td><button class='edit-modal btn btn-info' data-info='" + project.name+","+project.created_at+","+project.updated_at+"'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-info='" + project.name+","+project.created_at+"' ><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
            	 }}
        });
    });
    $('.modal-footer').on('click', '.delete', function() {
        $.ajax({
            type: 'post',
            url: '/deleteProject',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $('.did').text()
            },
            success: function(data) {
                $('.project' + $('.did').text()).remove();
            }
        });
    });
</script>
<script>
$('div.alert').not('.alert-important').delay(100).fadeOut(50);
</script>

</body>

</html>
@endsection