<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>{{ $title }} | Perpus SMKN 7 Samarinda</title>
	<link rel="icon" type="image/x-icon" href="{{ asset('/front-assets/img/title.ico') }}">
	<link rel="stylesheet" href="{{ asset('/front-assets/css/bulma.css') }}">
	<link rel="stylesheet" href="{{ asset('/front-assets/css/design.css') }}">
	<link rel="stylesheet" href="{{ asset('/front-assets/css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('/front-assets/css/resp.css') }}">
	<link rel="stylesheet" href="{{ asset('/front-assets/js/slick/slick-theme.css') }}">
	<link rel="stylesheet" href="{{ asset('/front-assets/js/slick/slick.css') }}">
	<link rel="stylesheet" href="{{ asset('/front-assets/font-awesome/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('/front-assets/aos/aos.css') }}">
	<style type="text/css">
		.fail-input {
			border-bottom:1px dotted #ff3860!important;
		}
	</style>
</head>
<body>
<div class="overlay"></div>
<div id="container">
