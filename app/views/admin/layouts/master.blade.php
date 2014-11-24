<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> {{ option('site_title') }}后台管理 </title>

	{{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('css/ripples.min.css') }}
	{{--{{ HTML::style('css/material.min.css') }}--}}
	{{ HTML::style('css/material-wfont.min.css') }}
	{{ HTML::style('css/style.css') }}
	@yield('style')
</head>
<body>
	@include('admin::partials.flashes')
	
	@if(Auth::check() && Auth::user()->is('admin'))
		@include('admin::partials.header')
	@endif

	<div class="container main-content">
		@yield('content')
	</div>

	<footer class="container">
	<hr/>
		Copyright &COPY; 翼工坊 {{ date('Y') }}
	</footer>
	@if(App::isLocal())
	    {{ var_dump(DB::getQueryLog()) }}
    @endif
    {{ HTML::script('js/jquery.min.js') }}
    {{ HTML::script('js/bootstrap.min.js') }}
    {{ HTML::script('js/ripples.min.js') }}
    {{ HTML::script('js/material.min.js') }}
    {{ HTML::script('js/main.js') }}
    <script type="application/javascript">
    $(function() {
        $.material.init();
    });
    </script>
	@yield('script')
</body>
</html>