<div class="row">
    <div class="row container-fluid" style="margin: 10px">
    <!-- Fluid width widget -->        
    <div class="panel panel-default">
          <div class="panel-heading">
              <h3 class="panel-title">
                  <span class="glyphicon glyphicon-comment"></span> 
                  Recent Comments
              </h3>
          </div>
          <div class="panel-body">
              <ul class="media-list">
                  @foreach($comments as $comment)
                  <li>
                    <div class="row">
                      <div class="col-sm-1">
                        <div class="media-left">
                          <img style="width:60px; height: 60px;" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="img-circle">
                        </div>
                      </div><!-- /col-sm-1 -->

                      <div class="col-md-8 col-sm-5 container-fluid">
                        <div class="panel panel-default">
                          <div class="panel-heading">
                            <strong>
                              <a href="users/{{ $comment->user->id }}">{{ $comment->user->name }}</a>
                            </strong> <span class="text-muted">{{$comment->created_at}}</span>
                          </div>
                          <div class="panel-body">
                            {{ $comment->body }}
                          </div><!-- /panel-body -->
                        </div><!-- /panel panel-default -->
                      </div><!-- /col-sm-5 -->
                      <a class="btn btn-primary" href="{{ $comment->url }}" role="button">Evidence</a>
                    </div>
                  </li>
                  @endforeach
              </ul>
              <a href="#" class="btn btn-default btn-block">Go up</a>
          </div>
      </div>
      <!-- End fluid width widget --> 
  </div>
</div>