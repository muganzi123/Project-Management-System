@extends('layouts.app')

@section('content')
<div class="col-sm-9 col-md-9 col-lg-9 pull-left" style="background: white;">
  <h1>Create Company</h1>
  <!-- Example row of columns -->
  
  <div class="row" style="background-color: white; margin: 10px">
    <form method="post" action="{{route('companies.store')}}">
    	{{ csrf_field() }}
    	
    	<div class="form-group">
    		<label for="company-name">Name<span class="required">*</span></label>
    		<input 
    			placeholder="Enter name"
    			id="company-name" 
    			required
    			name="name" 
    			spellcheck="false" 
    			class="form-control" 
    		/>
    	</div>
    	<div class="form-group">
    		<label for="company-content">Description</label>
    		<textarea
    			placeholder="Enter description"
    			id="company-content"
    			name="description" 
          rows="5"
          cols="80"
    			spellcheck="false"
    			class="form-control autosize-target text-left"></textarea>
          <br/>	
    		<div class="form-group mt-2"> 
				<input type="submit" class="btn btn-primary" value="Submit">
    		</div>

    	</div>
    </form>
  </div>
  <footer class="footer pull-left">
    <p>© Company 2018</p>
  </footer>
</div>

<aside class="col-sm-3 col-md.3 col-lg-3 ml-sm-auto pull-right">
          <!--div class="sidebar-module sidebar-module-inset">
            <h4>About</h4>
            <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
          </div-->
          <div class="sidebar-module">
            <h4>Management</h4>
            <ol class="list-unstyled">
              <li><a href="/companies/">View my Companies</a></li>
            </ol>
          </div>
          <div class="sidebar-module">
            <h4>Members</h4>
            <ol class="list-unstyled">
              <li><a href="#">March 2018</a></li>
            </ol>
          </div>
        </aside>

<!-- Site footer -->

@endsection