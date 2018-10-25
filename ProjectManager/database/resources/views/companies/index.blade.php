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
          <h1 class="text-center">REGISTERED COMPANIES</h1>

         <a  class="pull-right btn btn-secondary" href="#">
        <i class="fa fa-plus-square" aria-hidden="true"></i>  Create new</a> 
         <div class="panel panel-secondary ">
         <div class="list-group-item list-group-item-action active">Companies <a  class="pull-right btn btn-primary btn-sm" href="/companies/create">
         <i class="fa fa-plus-circle" aria-hidden="true"></i>  Create Company</a> </div>
          <br /> 
			<table class="table table-bordered" id="companies-table">
				<thead>
					<tr>
                    <th class="text-center">Company Name</th>
                    <th class="text-center">Created At</th>
                    <th class="text-center">Updated</th>
                     <th class="text-center">Actions</th>
					</tr>
				</thead>
				@foreach($companies as $company)
                <tr class="company{{$company->id}}">
                <td>{{$company->name}}</td>
               <td>{{$company->created_at}}</td>
               <td>{{$company->updated_at}}</td>
               <td><a href="{{url('/companies/'.$company->id.'/edit')}}" class="edit-modal btn btn-info">
                <span class="glyphicon glyphicon-edit"></span> Edit
              </a>
               <button class="delete-modal btn btn-danger"
               data-info="{{$company->name}},{{$company->created_at}},{{$company->updated_at}}">
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
								<input type="text" class="form-control" id="name" disabled>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2" for="createdat">Created At:</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="created_at">
							</div>
						</div>
						<p class="fname_error error text-center alert alert-danger hidden"></p>
						<div class="form-group">
							<label class="control-label col-sm-2" for="updated_at">Updated At:</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="updated_at">
							</div>
						</div>
						<p class="updated_at_error error text-center alert alert-danger hidden"></p>
						
						
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
    $('#name').val(details[0]);
    $('#created_at').val(details[1]);
    $('#updated_at').val(details[2]);
    
}
    $('.modal-footer').on('click', '.edit', function() {
        $.ajax({
            type: 'post',
            url: '/editItem',
            data: {
                '_token': $('input[name=_token]').val(),
                'name': $('#fname').val(),
                'created_at': $('#created_at').val(),
                'updated_at': $('#updated_at').val()
            },
            success: function(data) {
            	if (company.errors){
                	$('#myModal').modal('show');
                    if(company.errors.fname) {
                    	$('.name_error').removeClass('hidden');
                        $('.name_error').text("Name can't be empty !");
                    }
                    if(company.errors.createdat) {
                    	$('.created_at_error').removeClass('hidden');
                        $('.created_at_error').text("Created at can't be empty !");
                    }
                    if(company.errors.updatedat) {
                    	$('.updated_at_error').removeClass('hidden');
                        $('.updated-at_error').text("Updated at can't be empty !");
                    }
                    
                }
            	 else {
            		 
                     $('.error').addClass('hidden');
                $('.company' + company.id).replaceWith("<tr class='company" + company.id + "'><td>" +
                        company.name + "</td><td>" + company.created_at +
                        "</td><td>" + company.updated_at + "</td><td><button class='edit-modal btn btn-info' data-info='" + company.name+","+company.created_at+","+company.updated_at+"'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-info='" + company.name+","+company.created_at+"' ><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
            	 }}
        });
    });
    $('.modal-footer').on('click', '.delete', function() {
        $.ajax({
            type: 'post',
            url: '/deleteCompany',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $('.did').text()
            },
            success: function(data) {
                $('.company' + $('.did').text()).remove();
            }
        });
    });
</script>
<script>
$('div.alert').not('.alert-important').delay(3000).fadeOut(350);
</script>
</body>

</html>
@endsection