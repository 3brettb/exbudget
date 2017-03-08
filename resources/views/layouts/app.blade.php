<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | ExBudget</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{url('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" type="text/css" href="{{url('vendor/font-awesome/css/font-awesome.css')}}">

    <!-- Laravel Style -->
    <!--<link href="{{url('css/app.css')}}" rel="stylesheet">-->

    <!-- Page CSS -->
    <link href="{{url('css/site.css')}}" rel="stylesheet" type="text/css" >

    <!-- Dynamically Included CSS -->
    @yield('css')
    
    <!-- Scripts -->
    <script>window.Laravel = {"csrfToken":"{{csrf_token()}}"};</script>
	<script src="{{url('js/jquery.min.js')}}"></script>
    <script src="{{url('/js/site.js')}}"></script>

    <!-- Dynamically Included Scripts -->
    @yield('script-top')

    
    <!-- Google Visualization -->
    @yield('google-visualization')

    <!-- Page style -->
    <style type="text/css">
        @yield('style')
	</style>
</head>
<body>
    <div id="app">
        @include('layouts.navbar')

        <div id="header">
		    <div id="logo"></div>
	    </div>

        @yield('content')

        <div class="footer-spacing"></div>
        <footer class="footer">
            <div class="footer-content">
                <p>
                    © 2017 blackfiddle.net | ExBudget | Brett Brist
                </p> 
            </div>
        </footer>
        
        @yield('modal')

    </div>

    <!-- Laravel Script -->
    <!--<script src="{{url('js/app.js')}}"></script>-->

    <!-- jQuery -->
    <!--<script src="{{url('vendor/jquery/jquery.min.js')}}"></script>-->

    <!-- Bootstrap Core JavaScript -->
    <script src="{{url('vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    
    <!-- Dynamically Added Scripts -->
    @yield('script-bottom')
    
</body>
</html>
