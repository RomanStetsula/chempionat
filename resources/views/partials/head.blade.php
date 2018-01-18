<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="Keywords" content="фк, футбол, дрогобич, дрогобиччина, дрогобича, футбол дрогобиччини">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Favicon -->
<link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">

{{--App name--}}
<title>{{ env('APP_NAME') }}</title>

{{--Main styles--}}
<link href={{mix("/css/app.css")}} rel="stylesheet">

<!-- Additional styles -->
@stack('styles')
