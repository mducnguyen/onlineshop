<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PCShop</title>

	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/general.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/homepage.css') }}" rel="stylesheet">

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>

  <div id="PageWrapper">
    
  <nav class="navbar navbar-default" id="TopBar">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle Navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/">PCshop</a>
      </div>

      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li><a href="{{ url('/') }}">Product</a></li>
            <li><a href="{{ action('AdvertisementController@index') }}">HOT SALE!!!</a></li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
          @if (Auth::guest())
            <li><a href="{{ url('/auth/login') }}">Login</a></li>
            <li><a href="{{ url('/auth/register') }}">Register</a></li>
          @else
            <li>
                <a href="{{ action('CartController@index') }}">
                    {{ array_reduce(Auth::user()->basketItems->toArray(), function($total, $i){ return $total+$i['units'];}, 0)  }} items in Shopping Cart

                </a>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
              </ul>
            </li>
          @endif
        </ul>
      </div>
    </div>
  </nav>

  @yield('search')
  
  @yield('categoriesNav')

  {{-- @include('product._search') --}}

  {{-- @include('product._categoriesNav') --}}

	@yield('content')
  </div>

	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

  <!-- Google Analytics -->
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-64451436-1', 'auto');
        ga('send', 'pageview');

    </script>

  <!-- Piwik -->
  <script type="text/javascript">
      var _paq = _paq || [];
      _paq.push(['trackPageView']);
      _paq.push(['enableLinkTracking']);
      (function() {
          var u="//minhduc.piwikpro.com/";
          _paq.push(['setTrackerUrl', u+'piwik.php']);
          _paq.push(['setSiteId', 3]);
          var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
          g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
      })();
  </script>
  <noscript><p><img src="//minhduc.piwikpro.com/piwik.php?idsite=3" style="border:0;" alt="" /></p></noscript>
  <!-- End Piwik Code -->
</body>
</html>
