@extends('app-user')

@section('css')
  {!! Html::style( asset('assets/css/main.css')) !!}
    <style type="text/css">
      .new-task{
        padding-bottom: 0px !important;
      }
    </style>
@endsection

@section('content-seeker-new-task')
<div class="new-task">
    <div class="container">
        <div class="row">
            <div class="col-md-2">    
            </div>
            <div class="col-md-8">
                <div class="task-posting">
                    <h4>Thank you</h4>
                    <div class="next-steps">
                      <h5>Next steps</h5>
                      <h5>Step 1</h5>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero quo debitis accusamus reprehenderit harum explicabo illo magni. Ipsa similique quasi, accusamus autem esse consectetur facere fuga reiciendis atque, repellat accusantium eum assumenda nobis nulla odio.</p>
                      <h5>Step 2</h5>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat quasi pariatur quam voluptas maxime veniam, commodi, sed adipisci quis quos, natus error ratione quaerat quod! Velit ut, ea assumenda laboriosam facere quasi quisquam, doloremque sequi veniam aspernatur harum a numquam.</p>
                      <h5>Step 3</h5>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates amet laudantium maxime, voluptatibus! Quisquam, voluptates.</p>
                    </div><!--/next-steps-->
                </div><!-- /task-posting -->
                <!-- <div class="button-task">
                    <a href="{{action('SeekersController@getNewTask')}}"><button type="button" class="btn btn-success">Create another task</button></a>
                </div> -->
                 
                 
                <div class="popular-trends">
                  <h4>Popular trends</h4>
                  <div class="trends">
                    <div class="row">
                      <div class="col-xs-6 col-ms-4 col-sm-4">
                          <img src="{{asset('assets/img/profile/Music.png')}}" alt="">
                          <p>Music teacher</p>
                      </div>
                      <div class="col-xs-6 col-ms-4 col-sm-4">
                          <img src="{{asset('assets/img/profile/Shopping.png')}}" alt="">
                          <p>Handy man</p>
                      </div>
                      <div class="col-xs-6 col-ms-4 col-sm-4">
                          <img src="{{asset('assets/img/profile/Tag.png')}}" alt="">
                          <p>Delivery man</p>
                      </div>
                    </div>
                  </div><!-- /trends -->
                </div><!-- /popular-trends -->
                  
                
            </div>
    </div><!-- /container -->
</div><!-- /profile -->
@stop