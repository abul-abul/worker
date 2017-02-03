@extends('app-user')

@section('css')
    {!! Html::style( asset('assets/css/main.css')) !!}
    {!! Html::style( asset('assets/css/style.css')) !!}
@stop

@section('content')

        
        <div class="new-task">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-8 col-lg-9">
                        <div class="task-posting">
                           {{--  <h4>Thank you</h4> --}}
                            <h4>What’s Next?</h4>
                            <div class="next-steps">
                                {{-- <h5>Next steps</h5>
                                <h5>Step 1</h5> --}}

                                <p>1. We have sent an email to your email address. Please check your email and confirm your account.</p>
                             {{--    <h5>Step 2</h5> --}}
                                <p>2. Once you have confirmed your account you can log in and get quotes on from service providers.</p>
                           {{--      <h5>Step 3</h5> --}}
                                <p>3. Compare their quotes, user reviews and profile..</p>

                            {{--     <h5>Step 4</h5> --}}
                                <p>4. Choose and book the right service provider for your request.</p>
                            </div><!--/next-steps-->
                        </div><!-- /task-posting -->
                                           
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
