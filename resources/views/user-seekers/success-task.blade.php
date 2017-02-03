@extends('app-user')

@section('scripts')
    {!! Html::script(asset('assets/cropper-master/dist/cropper.js')) !!}
@endsection

@section('css')
    {!! Html::style( asset('assets/cropper-master/dist/cropper.css')) !!}
    {!! Html::style( asset('assets/cropper-master/demo/css/main.css')) !!}
@endsection

@section('content-seeker')            
            <div class="new-task">
                <div class="container">
                    <div class="row">
                        <div class="hidden-xs col-sm-4 col-lg-3">
                            <div class="sidebar-menu">
                                <div class="panel-group">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">Menu</h4>
                                        </div>
                                        <div id="menu" class="">
                                            <ul class="list-group">
                                                <li class="list-group-item"><a href="{{action('SeekersController@getProfile')}}">My profile</a></li>
                                                <li class="list-group-item"><a href="{{action('SeekersController@getNewTask')}}">Create a new task</a></li>
                                                <li class="list-group-item"><a href="{{action('SeekersController@getMyTasks')}}">My requests</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- /sidebar-menu -->
                        </div>
                        <div class="col-xs-12 col-sm-8 col-lg-9">
                            <div class="task-posting">
                  
                               {{--  <div class="next-steps">
                                  <h5>Next steps</h5>
                                  <h5>Step 1</h5>
                                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero quo debitis accusamus reprehenderit harum explicabo illo magni. Ipsa similique quasi, accusamus autem esse consectetur facere fuga reiciendis atque, repellat accusantium eum assumenda nobis nulla odio.</p>
                                  <h5>Step 2</h5>
                                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat quasi pariatur quam voluptas maxime veniam, commodi, sed adipisci quis quos, natus error ratione quaerat quod! Velit ut, ea assumenda laboriosam facere quasi quisquam, doloremque sequi veniam aspernatur harum a numquam.</p>
                                  <h5>Step 3</h5>
                                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates amet laudantium maxime, voluptatibus! Quisquam, voluptates.</p>
                                </div> --}}
                                @if(isset($remove))
                                <div class="next-steps">
                                  <p>
                                    Your have successfully closed your service request and will stop receiving more offers.
                                  </p>
                                </div>
                                @elseif(isset($addNewTask))
                                   <div class="next-steps">                                      
                                      <p>Thank you for submitting a service request and for registering your details with</p>

                                        <p>Mr.ShaSha.</p>
                                        <p>
                                          Your request has been successfully posted. We are working hard on your service
                                        </p>
                                        <p>
                                          request to get you quotes from the best service providers.
                                        </p>
                                        <p>
                                          In the meanwhile, we request you to complete the sign up process. We have sent a
                                        </p>
                                        <p>
                                          confirmation email to the email account that you have registered with. Please click on
                                        </p>
                                        <p>
                                          the link in the email to validate your details.
                                        </p>
                                        

                                      <h5>What’s Next?</h5>
                                      <p>
                                        1.&nbsp&nbsp We will notify our service providers of your request and those who are able to do the job will respond with a quote.
                                      </p>
                                      <p>
                                        2.&nbsp&nbspYou may get up to 3 responses from different service providers. Compare their quotes, user reviews and profile.
                                      </p>
                                      <p>
                                        3.&nbsp&nbsp Choose and book the right service provider for your request
                                      </p>
                                   </div>
                                @endif
                            </div><!-- /task-posting -->
                            <div class="button-task">
                                <a  href="{{action('SeekersController@getNewTask')}}" ><button class="btn btn-success">Create another task</button></a>
                            </div>
                            <!-- <div class="popular-trends">
                              <h4>Popular trends</h4>
                              <div class="trends">
                                <div class="row">
                                  <div class="col-xs-6 col-ms-4 col-sm-4">
                                      <img src="../img/tasks/Music.png" alt="">
                                      <p>Music teacher</p>
                                  </div>
                                  <div class="col-xs-6 col-ms-4 col-sm-4">
                                      <img src="../img/tasks/Shopping.png" alt="">
                                      <p>Handy man</p>
                                  </div>
                                  <div class="col-xs-6 col-ms-4 col-sm-4">
                                      <img src="../img/tasks/Tag.png" alt="">
                                      <p>Delivery man</p>
                                  </div>
                                </div>
                              </div>
                            </div> --><!-- /popular-trends -->
                        </div>
                    </div>
                </div><!-- /container -->
            </div><!-- /new-task -->
@stop