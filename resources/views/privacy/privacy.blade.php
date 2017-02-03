<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link rel="shortcut icon" href="#" type="image/x-icon">
    <title>Mr Shasha</title>

    <!-- Bootstrap -->
    {!! Html::style( asset('assets/css/bootstrap.min.css')) !!}
    {!! Html::style( asset('assets/css/bootstrap_col_15.css')) !!}
    {!! Html::style( asset('assets/css/bootstrap_ms.css')) !!}
    {!! Html::style( asset('assets/css/landing-style.css')) !!}

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <div class="landing">

     <!--HEADER -->

        <header>
          <div class="container">
            <img src="{{ asset('assets/img/logo-small.png')}}" alt="" class="img-responsive logo hidden-xs">
            <img src="{{ asset('assets/img/logo-small.png')}}" alt="" class="img-responsive logo visible-xs">
            <a href="{{action('UsersController@getLogin')}}"><button type="button" class="red-button">Login</button></a>
            <a href="{{action('UsersController@getRegistration')}}"><button type="button" class="red-button">Sign Up</button></a>
          </div>
        </header>

<!-- CONTENT -->     
      <div class="how-to">
        <div class="container">
          <h1 class="title h1padding">Privacy Policy</h1><br>

          <p> 
              This Privacy Policy is effective as of 1 March 2016.

              Mr. ShaSha's mission is to enable people to find and hire the best service providers for their service 

              needs/ requests at the most competitive price. At the same time, we intend to become one of 

              Zimbabwe's key initiator for any time of commerce for service businesses. 

              Most importantly, we value our customers privacy. You are given the power and freedom to decide 

              what personal information you share with us. We also let you know how we may use the personal 

              information that you share with us. Defined terms used here shall bear the same meaning as defined 

              in our Terms and Conditions, unless otherwise stated.

              Mr. ShaSha is committed to comply with the Personal Data Protection Act 2010 ("PDPA") of 

              Zimbabwe. This Privacy Policy Statement sets out how Mr. ShaSha collects and uses your personal 

              data. It also sets out the measures that we put in place with regards to personal data protection.
          </p>

          <h2 class="title h1padding">Collection and Use of Personal Data</h2>

          <p>
              You can generally use and browse the Website without providing any Personal Data and may 

              remain anonymous.

              However, to gain the full benefit and optimum experience of our Website, you may elect and decide 

              to create an Account or to register your details with us, in which case you may be required to provide 

              personal information such as (but not limited to) your name, telephone number, general 

              geographical location or address, e-mail address or any other information which may identify you 

              ("Personal Data").

              Such Personal Data may be used to:

              1. Enable you to access and use the Website and Mr. ShaSha Services;

              2. send you emails, SMS or other form of communication which is related to your use of the 

              Website, such as to verify your identity, personal information, refer you to Service 

              Professionals for Services that you have requested or for other purposes related to the Mr. 

              ShaSha Service; and

              3. add you to our mailing list, to send you marketing and promotional materials which we think 

              you may be interested in from time to time. You can at any time decide to unsubscribe from 

              our mailing list and to stop receiving marketing and promotional materials via the links in 

              such communication or by emailing us at info@MrShaSha.com.
          </p>

          <h2 class="title h1padding">Other Information Collected</h2>

          <p>
              When you visit our Website, we may also automatically record information that your browser sends 

              whenever you visit a website. This data does not identify you as an individual and may include: 

              1. Your computer's IP address;

              2. Browser type;

              3. The pages you visit on our Website; and

              4. The time spent on those pages, items and information searched for on our site, access times 

              and dates, and other statistics.

              This information is collected for analysis and evaluation in order to help us improve the Website and 

              Mr. ShaSha Services. This data is collected anoymously and will not be used in association with any 

              Personal Data.

              As part of the above, we may use cookies and Google Analytics. We may also use remarketing with 

              Google Analytics to advertise online. Third-party vendors, including Google, may show our ads on 

              websites across the Internet. We and third-party vendors, including Google, use first-party cookies 

              (such as the Google Analytics cookie) and third-party cookies (such as the DoubleClick cookie) 

              together to inform, optimize, and serve ads based on visitors' past visits to our website, as well as 

              report how ad impressions, other uses of ad services, and interactions with these ad impressions 

              and ad services are related to visits to our website.

          </p>

          <h2 class="title h1padding">Links to Other Websites</h2>
              

          <p>

              We may provide links to other websites that we do not control, these include those of our Service 

              Professionals. We do not assume responsibility for the privacy practices, products, services or any 

              other content of any websites or pages that is not under our control. We do not bear any 

              responsibility for any actions or policies of third-party websites. Moreover, we disclaim all 

              responsibility for the subsequent use of an email address or any other personally identifiable 

              information you have provided to an affiliate store or any other website we might link to that is not 

              under our control. You are advised to check the privacy policies of those websites upon visiting 

              them.

          </p>
              <h2 class="title h1padding">Disclosure of information</h2>
          <p>

              We do not sell, distribute or lease Personal Data or information that you provide or which Mr. 

              ShaSha otherwise comes by to third parties unless required by law, or with your permission. We 

              may however disclose or transfer Personal Data or information for the purposes of rendering our 

              services to you and this may include disclosure to any professional, third party service providers to 

              us, who are formally engaged by us to help us make available and provide the Website and the Mr. 

              ShaSha Service.

          </p>
              <h2 class="title h1padding">Protection of information</h2>
              
          <p>

              Mr. ShaSha is committed to take all reasonable and practical steps to ensure that any personal 

              information or data that we collect or come into possession of is protected against loss, misuse, 

              abuse, modification or any unauthorized or accidental use, access, disclosure, modification, 

              alteration or destruction. We ensure that all Personal Data collected will be safely and securely 

              stored. We protect your personal information by:

              1. Restricting access to Personal Data;

              2. Maintaining and implementing measures to prevent unauthorized computer access; and

              3. Securely destroying and / or deleting your personal information when it's no longer needed.
          </p>
              <h2 class="title h1padding">Contact Information for Access, Correction, Enquiries</h2>
          <p>

              Should you wish to:

              1. access; or

              2. make any corrections to,

              the Personal Data which Mr. ShaSha has collected from you, or otherwise have any enquiries in 

              respect of your Personal Data, please feel free to contact us via e-mail at info@MrShaSha.com.

          </p>
              <h2 class="title h1padding">Changes to this Privacy Policy</h2>
          <p>

              Mr. ShaSha may revise this Privacy Policy from time to time, as it may deem necessary. You will be 

              notified of any such changes. By accessing or continuing use of our services after any changes to 

              this Privacy Policy, you agree to be bound by this Privacy Policy including any changes made to it. If 

              you have any questions regarding this Privacy Policy, you may contact us at info@Mr.ShaSha.com.
          </p>

          </div>
      </div><!-- /how-to -->
       
      
      
<!-- FOOTER -->

      @include('partial.footer')

      </div><!-- /landing-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    {!! Html::script( asset('assets/js/jquery-2.1.4.min.js')) !!}
    {!! Html::script( asset('assets/js/bootstrap.min.js')) !!}
  </body>
</html>