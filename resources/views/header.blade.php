<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

  <title>{{trans("lang.shop_name")}}</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

  <link href="{{asset(mix('/css/app.css'))}}" rel="stylesheet">

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <script type="text/javascript">
    $(function(){
  $('.nav-menu-btn').click(function(){
  $('.layer').fadeIn(200);
});


$('.close-btn').click(function(){
  $('.layer').fadeOut(0);
});


});
  </script>


</head>

<body>


  <div class="layer">
    <a href="#" class="close-btn">


      <img src="{{url('/images/close-btn.png')}}">


    </a>

    <img class="logo" src="{{url('/images/djs-logo.png')}}">


    <ul>
      <li><a href="/">{{trans('lang.menu_btn_home')}}</a></li>
      <li><a href="/about-djsfans">{{ trans('lang.menu_btn_about_djsfans') }}</a></li>
      <li><a href="/how">{{ trans('lang.menu_btn_how') }}</a></li>
      <li><a href="/terms">{{ trans('lang.menu_btn_terms') }}</a></li>
      <li><a href="/forgot-pw">{{ trans('lang.menu_btn_forgotpw') }}</a></li>
    </ul>
  </div>