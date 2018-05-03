<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>{if $seo_title}{$seo_title}{else}{$html_title}{/if}</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

    <meta name="description" content="{if $seo_desc}{$seo_desc}{else}{$meta_description}{/if}" />
    <meta name="keywords" content="{if $seo_keys}{$seo_keys}{else}{$meta_keywords}{/if}" />

	  <!-- 
   Chrome and Opera Icons - to add support create your icon with different resolutions. Default is 192x192
     <link rel="icon" sizes="192x192" href="{$BASE_URL}fav.png" >
    <link rel="icon" sizes="144x144" href="{$BASE_URL}fav-144.png" >
    <link rel="icon" sizes="96x96" href="{$BASE_URL}fav-96.png" >
    <link rel="icon" sizes="48x48" href="{$BASE_URL}fav-48.png" >
  -->
  <link rel="icon" href="{$BASE_URL}fav.png" >
  <!-- 
   Apple iOS icons
    <link rel="apple-touch-icon" sizes="76x76" href="touch-icon-ipad.png">
    <link rel="apple-touch-icon" sizes="120x120" href="touch-icon-iphone-retina.png">
    <link rel="apple-touch-icon" sizes="152x152" href="touch-icon-ipad-retina.png">
  -->
  <link rel="apple-touch-icon" href="{$BASE_URL}fav-ios.png">
  <!-- iOS startup image -->
  <link rel="apple-touch-startup-image"  href="{$BASE_URL}fav-startup.png">
  <!-- Apple additional meta tags -->
  <meta name="apple-mobile-web-app-title" content="{if $seo_title}{$seo_title}{else}{$html_title}{/if}">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
  <!-- Android web app capable -->
  <meta name="mobile-web-app-capable" content="yes">
  <!-- IE & Windows phone pin icons. Almost same size like ios so it is reused -->
  <meta name="msapplication-square150x150logo" content="fav-ios.png">

  <!-- facebook meta tags for sharing -->
  <meta property="og:locale" content="en_US" />
  <meta property="og:type" content="website" />
  <meta property="og:title" content="{if $seo_title}{$seo_title}{else}{$html_title}{/if}" />
  <meta property="og:description" content="{if $seo_desc}{$seo_desc}{else}{$meta_description}{/if}" />
  <meta property="og:url" content="{$MAIN_URL}" />
  <meta property="og:site_name" content="{$SITE_NAME}" />
  <meta property="og:image" content="{$MAIN_URL}share-image.png" />

  <!-- twitter metatags -->
  <meta name="twitter:card" content="summary_large_image"/>
  <meta name="twitter:description" content="{if $seo_desc}{$seo_desc}{else}{$meta_description}{/if}"/>
  <meta name="twitter:title" content="{if $seo_title}{$seo_title}{else}{$html_title}{/if}"/>
  <!-- add your twitter site 
  <meta name="twitter:site" content="@brand"/>
  --> 
  <meta name="twitter:domain" content="{$SITE_NAME}"/>
  <meta name="twitter:image" content="{$MAIN_URL}share-image.png" />
  
  <!-- RSS -->
  <link rel="alternate" type="application/rss+xml" title="{$SITE_NAME} RSS Feed" href="{$BASE_URL}rss">
 
	<link rel="canonical" href="http://{$BASE_URL}home" />

  <!-- IF ALL STYLES ARE REMOVED EXCEPT BOOTSTRAP, UNCOMMENT THIS STYLE, TO KEEP THE BASIC, WORKING WEB. READY TO BE CUSTOMIZED 
  <link rel="stylesheet" href="{$BASE_URL}_tpl/{$THEME}/css/saveStructure.css" type="text/css" /> -->
  <!-- ######################################################################################################################## -->
	
  <link rel="stylesheet" href="{$BASE_URL}_tpl/{$THEME}/1.5/css/bootstrap.min.css">
  <link rel="stylesheet" href="{$BASE_URL}_tpl/{$THEME}/1.5/css/style.css">
  <link rel="stylesheet" href="{$BASE_URL}_tpl/{$THEME}/1.5/css/reset.css">
  <link rel="stylesheet" href="{$BASE_URL}_tpl/{$THEME}/1.5/css/font-awesome.min.css">

  <link href="{$BASE_URL}_tpl/{$THEME}/1.5/css/dev.css" rel="stylesheet">

	<noscript>{$translations.website_general.noscript_msg}</noscript>

<style type="text/css">
{$custom_css}
</style>

{literal}
<script type="text/javascript">
    window.cookieconsent_options = {"message":"{/literal}{$translations.cookie.message}{literal}","dismiss":"{/literal}{$translations.cookie.accept_message}{literal}","learnMore":"{/literal}{$translations.cookie.more_info}{literal}","link":"/privacy-policy","theme":"light-bottom"};
</script>
{/literal}
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/1.0.9/cookieconsent.min.js"></script>

</head>

<body>


<div id="wrapper">

<!-- //////////////// NAVBAR-UR ///////////// -->

<header role="banner" class="navbar navbar-fixed-top navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button data-toggle="collapse-side" data-target=".side-collapse" data-target-2=".side-collapse-container" type="button" class="navbar-toggle pull-left"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
        </div>
        <div class="side-collapse in">
          <nav role="navigation" class="navbar-collapse">
            <ul class="nav navbar-nav">
              <li><a href="{$BASE_URL}{$URL_JOBS}" target="_blank">Jobs</a></li>
              <li><a href="{$BASE_URL}about" target="_blank">About</a></li>
              <li><a href="{$BASE_URL}{$URL_SIGN_UP}" target="_blank">Signup</a></li>
            </ul>
          </nav>
        </div>
      </div>
</header> <!-- main-menu-->

<div class="header">
  <div class="navbar-ur-lp">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6 col-xs-12 c-header-left">
          <a href="{$BASE_URL}"><img class="site-logo" src="{$BASE_URL}{$SITE_LOGO_PATH}" alt="Website's Logo"></a>
        </div>
        <div class="col-md-6 col-xs-12 c-header-right">
          <ul>
            <li><a href="{$BASE_URL}{$URL_JOBS}" target="_blank">Jobs</a></li>
            <li><a href="{$BASE_URL}about" target="_blank">About</a></li>
            <li><a href="{$BASE_URL}{$URL_SIGN_UP}" target="_blank" class="sign-up-btn">Sign Up</a></li>                
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="header-content">
    <div class="container">
      <div class="row">
        <h1>All <span><u>jobs</u></span> in one place</h1>
        <h2>Finding your new job just got easier</h2>
        <div class="row header-filter">
          <div class="col-md-12 col-xs-12">

            <form method="post" action="{$BASE_URL}{$URL_LANDING_SEARCHED}" role="form">

              <div class="hf">
                <div class="form-group position">
                  <label>Position</label>
                  <input placeholder="e.g. Salesman" id="landing_title" name="landing_title" type="text" class="form-control">
                </div>

                {if $REMOTE_PORTAL == 'deactivated'}
                <div class="form-group location">
                  <label>Location</label>
                   <form>
                     <select id="landing_location" name="landing_location">
                        {foreach from=$cities key=id item=value}
                        <option value="{$id}">{$value}</option>
                        {/foreach}
                     </select>   
                   </form>

                </div>
                {/if}

                <button type="submit" class="btn btn-subc ">Search</button>

              </div>

            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</div> <!-- header-->

<!-- ///////////// MAIN-CONTENT ///////////// -->

<div id="candidates">
  <div class="container">
    <div class="row">
      <h2>Candidates</h2>
      <p>Looking for a change? You are one click away from reaching the best global startup companies
      </p>
      
      <div class="col-md-4 col-xs-12 c-box">
        <img src="{$BASE_URL}_tpl/default/1.5/images/emp-cand01.png">
        <h3>Browse<br>roles</h3>
        <h4>Or sign up for job alert and receive latest jobs straight to your email</h4>
      </div>

      <div class="col-md-4 col-xs-12 c-box">
        <img src="{$BASE_URL}_tpl/default/1.5/images/emp-cand02.png">
        <h3>Apply and<br> get an interview</h3>
        <h4>Get connected with awesome startups</h4>
      </div>

      <div class="col-md-4 col-xs-12 c-box">
        <img src="{$BASE_URL}_tpl/default/1.5/images/emp-cand05.png">
        <h3>Start<br>a career</h3>
        <h4>We find for you new opportunities everyday</h4>
      </div>
    </div>
  </div>
</div>

<div id="future">
  <div class="container">
    <div class="row">   
      <div class="col-md-12 col-xs-12 c-box">
        <h1>Browse <span><u>jobs</u></span> and land a career of your dreams</h1>
        <h2>We connect the best talent with the most renowned startup companies worldwide.</h2>
        <a href="{$BASE_URL}{$URL_JOBS}" target="_blank"><button type="button" class="btn btn-subc">View jobs</button></a>
      </div>
    </div>
  </div>
</div>

<div id="employers">
  <div class="container">
    <div class="row">
      <h2>Employers</h2>
      <p>Hiring? Advertise with us. We connect companies with talented individuals globally
      </p>
      
      <div class="col-md-4 col-xs-12 c-box">
        <img src="{$BASE_URL}_tpl/default/1.5/images/emp-cand04.png">
        <h3>Advertise</h3>
        <h4>Post jobs & track the performance</h4>
      </div>

      <div class="col-md-4 col-xs-12 c-box">
        <img src="{$BASE_URL}_tpl/default/1.5/images/emp-cand06.png">
        <h3>Interview & shortlist</h3>
        <h4>Candidates of your preference</h4>
      </div>

      <div class="col-md-4 col-xs-12 c-box">
        <img src="{$BASE_URL}_tpl/default/1.5/images/emp-cand03.png">
        <h3>Resume database</h3>
        <h4>Browse & hire from our talent pool</h4>
      </div>
    </div>
  </div>
</div>

<div id="opportunity">
  <div class="container">
    <div class="row">   
      <div class="col-md-12 col-xs-12 c-box">
        <h1>Hire the best<span> <u>talent</u></span> today</h1>
        <h2>Select one of our packages and reach our database of candidates instantly.</h2>
        <a href="{$BASE_URL}{$URL_REGISTER_RECRUITERS}" target="_blank"><button type="button" class="btn btn-subc">Post a job</button></a>
      </div>
    </div>
  </div>
</div>

<div id="about">
  <div class="container">
    <div class="row">
      <h2>About</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nunc risus, faucibus ut ultricies ut, aliquam vitae est.
      </p>
      
      <div class="col-md-5 col-xs-12 c-box">
        <h4>Etiam consectetur sapien, a commodo dui placerat in. Quisque sapien leo, posuere non, pellentesque vitae ante. Nunc a hendrerit purus, a aliquet justo.</h4>
      </div>

      <div class="col-md-2 col-xs-12 c-box">
        <img src="{$BASE_URL}{$SITE_LOGO_PATH}">
      </div>

      <div class="col-md-5 col-xs-12 c-box">
        <h4>Donec ut placerat lorem. Nulla facilisi. Ut orci arcu, porttitor a posuere quis, convallis laoreet lacus. Donec sodales ante sed elit posuere condimentum.</h4>
      </div>
      <a href="{$BASE_URL}about" target="_blank"><button type="button" class="btn btn-subc">Read more</button></a>
    </div>
  </div>
</div>

<div class="testimonial">
  <div class="container">
  <h2>What people say</h2>

<!-- Carousel
  ================================================== -->
    <div id="testimonial-carousel" class="carousel slide">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#testimonial-carousel" data-slide-to="0" class="active"></li>
        <li data-target="#testimonial-carousel" data-slide-to="1"></li>
      </ol>
      <div class="carousel-inner">
        <div class="item active">
          <div class="container">
            <div class="carousel-caption">
              <img src="{$BASE_URL}_tpl/default/1.5/images/tst-m.png">
              <br>
              <p>Maecenas lorem ligula, placerat et risus condimentum, porta porttitor eros.</p>
              <h3>Thomas Smith</h3>
            </div>
          </div>
        </div>
        <div class="item">
          <div class="container">
            <div class="carousel-caption">
              <img src="{$BASE_URL}_tpl/default/1.5/images/tst-w.png">
              <br>
              <p>Nunc imperdiet massa vel quam molestie, eu sagittis felis lobortis. Curabitur auctor tellus facilisis.</p>
              <h3>Zoe Allen</h3>
            </div>
          </div>
        </div>
      </div>
      <!-- Controls -->
      <a class="left carousel-control" href="#testimonial-carousel" data-slide="prev">
        <span class="icon-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></span>
      </a>
      <a class="right carousel-control" href="#testimonial-carousel" data-slide="next">
        <span class="icon-next"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
      </a>  
    </div>
    <!-- /.carousel -->

  </div>
</div>

<div id="partner">
  <div class="container">
  <h2>Our trusted partners</h2>
  <img src="{$BASE_URL}_tpl/default/1.5/images/logo_set.png">
  </div>
</div>

<div class="sign-up-section">
  <div class="container">
    <div class="row">

      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div id="employers-signup">
          <div class="row">   
            <div class="col-lg-12  col-md-12 col-sm-12 col-xs-12 c-box">
              <h1>Sign up Employers</h1>
              <h2>Post your jobs and start hiring</h2>
              <a href="{$BASE_URL}{$URL_REGISTER_RECRUITERS}" target="_blank"><button type="button" class="btn btn-subc">REGISTER</button></a>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div id="candidates-signup">
          <div class="row">   
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 c-box">

               {if $PROFILES_PLUGIN == 'true'}
                      <h1>Sign up Candidates</h1>
                      <h2>Find a career of your dreams</h2>
                      <a href="{$BASE_URL}{$URL_REGISTER_APPLICANTS}" target="_blank"><button type="button" class="btn btn-subc">REGISTER</button></a>
               {else}
                      <h1>Candidates</h1>
                      <h2>Find a career of your dreams</h2>
                       <a href="{$BASE_URL}{$URL_JOBS}" target="_blank"><button type="button" class="btn btn-subc">View jobs</button></a>
               {/if}

            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<div id="stats">
  <div class="container">
  <h2>Our stats</h2>

    <div class="row">
      <div class="col-md-3 col-xs-6 c-box">
        <h5><i class="fa fa-check-circle-o" aria-hidden="true"></i></h5>
        <h3><div class="counter" data-count="750">0</div></h3>
        <h4>JOB<br>OFFERS</h4>
      </div>

      <div class="col-md-3 col-xs-6 c-box">
        <h5><i class="fa fa-check-circle-o" aria-hidden="true"></i></h5>
        <h3><div class="counter" data-count="110">0</div></h3>
        <h4>REGISTERED<br>COMPANIES</h4>
      </div>

      <div class="col-md-3 col-xs-6 c-box">
        <h5><i class="fa fa-check-circle-o" aria-hidden="true"></i></h5>
        <h3><div class="counter" data-count="1500">0</div></h3>
        <h4>NEW<br>RESUMES</h4>
      </div>

      <div class="col-md-3 col-xs-6 c-box">
        <h5><i class="fa fa-check-circle-o" aria-hidden="true"></i></h5>
        <h3><div class="counter" data-count="1000">0</div></h3>
        <h4>DAILY<br>USERS</h4>
      </div>

    </div>
  </div>
</div>

{include file="snippets/listing-sitemap.tpl"}

<script src="{$BASE_URL}_tpl/{$THEME}/1.5/js/jquery.min.js"></script>
<script src="{$BASE_URL}_tpl/{$THEME}/1.5/js/bootstrap.min.js"></script>


<script src="{$BASE_URL}js/landing/landing.js"></script>

{literal}
<script type="text/javascript">
	$('.counter').each(function() {
  var $this = $(this),
      countTo = $this.attr('data-count');
  
  $({ countNum: $this.text()}).animate({
    countNum: countTo
  },

  {
    duration: 10000,
    easing:'linear',
    step: function() {
      $this.text(Math.floor(this.countNum));
    },
    complete: function() {
      $this.text(this.countNum);
    }

  });  
});
</script>
{/literal}

{include file="1.5/layout/sjs-footer.tpl"}
</body>
</html>