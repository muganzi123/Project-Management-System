{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')
   
@section('title', 'ProjectManager')

@section('content_header')

  
@stop

@section('content')
    <!-- <p>Welcome to this beautiful admin panel.</p> -->
    

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script src="{{asset('js/datatables.min.js')}}"> </script>
    <script> console.log('Hi!'); </script>
@stop
 <div class="container" >

        @include('flash::message')
        
         </div>