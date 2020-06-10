@extends('app')


@section('heading-title', trans('lang.djsfans_login') )

@section('text-description')

@isset($login_status)

@if ($login_status=='success')
<div class="success-msg">登入成功，3秒後返回主頁。</div>
<script type="text/javascript">
    $('.back-btn-div').fadeOut(0);

    setTimeout(function(){
          window.location = "{{asset('/')}}";
},3000);
</script>
@endif

@if ($login_status=='fail')
<div class="error-msg">登入錯誤，請重新登入</div>
@include('login-form')
@endif


@else

@include('login-form')


@endisset





@endsection