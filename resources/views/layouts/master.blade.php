<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<meta content="{{ csrf_token() }}" name="csrf-token">
	<link href="{{ asset('images/favicon.png') }}" rel="icon" type="image/x-icon">

	<title>{{ config('app.name', 'Laravel') }}</title>
	{{-- AJAX cdn --}}
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

	<!-- Tailwindcss -->
	@vite('resources/css/app.css')

	{{-- Scripts --}}
	@vite(['resources/css/app.css', 'resources/js/app.js'])

	<!-- Font Awsome -->
	<script src="https://kit.fontawesome.com/ee634a1922.js" crossorigin="anonymous"></script>

	<!-- Fonts -->
	<link href="https://fonts.bunny.net" rel="preconnect">
	<link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
	{{-- @notifyCss --}}
</head>

<body class="font-sans antialiased" class=" text-dark" x-data="{ isAsideOpen: false }">
	<div>
		{{ $slot }}
	</div>
	<x-notify::notify"/>
	@notifyJs
</body>

</html>
