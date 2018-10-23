@extends('layouts.app')
@section('content')

<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Companies</title>

       <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/bs-3.3.5/jq-2.1.4,dt-1.10.8/datatables.min.css"/>

        <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">

    </head>

    <body>

        <div class="container" style="width:1000px;">

        
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
                        <th>Name</th>

                        <th>Created At</th>

                        <th>Updated At</th>

                    </tr>

                </thead>

            </table>
       </div>

		



        <script src="//code.jquery.com/jquery.js"></script>

        <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>

        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

        <script>

        $(function() {

            $('#companies-table').DataTable({

                processing: true,

                serverSide: true,

                ajax: '{!! route('get.data') !!}',

                columns: [
                    
                    { data: 'name', name: 'name' },

                    { data: 'created_at', name: 'created_at' },

                    { data: 'updated_at', name: 'updated_at' }

                ]

            });

        });

        </script>

        @stack('scripts')

    </body>

</html>
@endsection