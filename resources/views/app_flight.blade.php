<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel</title>

	<!--Import Google Icon Font-->
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!--Import materialize.css-->
	<link type="text/css" rel="stylesheet" href="{{url('css/materialize.min.css')}}"  media="screen,projection"/>

	<link rel="stylesheet" 
		href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	
<nav class="">
	<div class="nav-wrapper">
	  <a href="#" class="brand-logo">Logo</a>
	  <ul id="nav-mobile" class="right hide-on-med-and-down">
	    <li>
		  <a class='dropdown-button' href='#' data-activates='dropdown1'>Master</a>
		  <ul id='dropdown1' class='dropdown-content'>
		    <li><a href="{{url('master/currency')}}">Currency</a></li>
		    <li><a href="{{url('master/country')}}">Country</a></li>
		    <li><a href="{{url('master/language')}}">Language</a></li>
		    <li><a href="{{url('master/airport')}}">Airport</a></li>
		  </ul>
	    </li>
	    <li>
		  <a class='dropdown-button' href='#' data-activates='dropdown2'>Cron Module</a>
		  <ul id='dropdown2' class='dropdown-content'>
		    <li><a href="{{url('cronGetCurrency')}}">Currency</a></li>
		    <li><a href="{{url('cronGetCountry')}}">Country</a></li>
		    <li><a href="{{url('cronGetLanguage')}}">Language</a></li>
		    <li><a href="{{url('cronGetAirport')}}">Airport</a></li>
		  </ul>
	    </li>
	  </ul>
	</div>
		</div>
	</nav>

	<div class="container">
	@yield('content')
	</div>

	<script type="text/javascript" src="{{url('js/jquery.min.js')}}"></script>

	<!-- include jquery ui -->
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<!-- Scripts -->
    <script type="text/javascript" src="{{url('js/materialize.min.js')}}"></script>
    
	<!-- yield untuk footer, setelah jquery -->
    @yield('footer')

    </body>
</html>
