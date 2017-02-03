<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img src="{{ asset('assets/img/logo.png')}}" alt="" class="img-responsive">
                <div class="social">
                    <a href="https://www.facebook.com/profile.php?id=100012246728786&ref=bookmarks" target="_blank"><img  src="{{ asset('assets/img/facebook.png')}}"  alt=""></a>
                    <a href="https://twitter.com/MrSha_Sha" target="_blank"><img src="{{ asset('assets/img/twitter.png')}}"  alt=""></a>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-xs-4 col-sm-4">
                        <h4>COMPANY</h4>
                        <ul>
                            <li><a href="{{action('UsersController@getAboutUs')}}">About Us</a></li>
                        </ul>
                    </div>
                    <div class="col-xs-4 col-sm-4">
                        <h4>Customers</h4>
                        <ul>
                            @if(isset($howTo))
                            <li><a href="#" id="how_it_works">How it works</a></li>
                            @else
                            <li><a href="{{action('UsersController@getHowRedirect')}}">How it works</a></li>
                            @endif
                            <li><a href="{{action('ContactController@showPage')}}">Contact Us</a></li>
                        </ul>
                    </div>
                    <div class="col-xs-4 col-sm-4">
                        <h4>Legal</h4>
                        <ul>
                            <li><a href="{{action('PrivacyController@showPage')}}">Privacy Policy</a></li>
                            <li><a href="{{action('TermsController@showPage')}}">Terms of Use</a></li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</footer>