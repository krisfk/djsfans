@include('header')
@include('nav')


<div class="back-btn-div">
  <a href="/" class="back-btn">

    <img src="{{url('/images/back-btn.png')}}">



  </a>

</div>
<h1 class="pink heading-title"> @yield('heading-title') </h1>

<div class="text-description">

  @yield('text-description')

  <br><br>

</div>


</body>

</html>