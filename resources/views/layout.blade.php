<html>
<head>
<meta charset="UTF-8">
<link href="{{asset('css/app.css')}}" rel="stylesheet">
<title>Locação de Carros</title>
<meta name="csrf-token" content="{{csrf_token()}}">


<style>
.navbar {
	margin-bottom: 20px;
}
</style>

</head>


<body>
	<div class="container">

		@component('navbar') @endcomponent

		<main role="main">@hasSection('body') @yield('body') @endif</main>
	</div>
	<script src="{{asset('js/app.js')}}" type="text/javascript"></script>

	@hasSection('javascript') @yield('javascript') @endif

</body>

</html>