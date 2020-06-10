@extends('app')


@section('heading-title', trans('lang.forgot_pw') )

@section('text-description')

@isset($member)

@if ($member=='not_exist')
<div class="error-msg">此電郵沒有註冊記錄。</div>
@include('forgot-pw-form')

@else
<div class="success-msg">請檢查你的註冊電郵，再重新設定新密碼。<br />3秒後返回主頁。</div>
<script type="text/javascript">
  $('.back-btn').fadeOut(0);
        setTimeout(function(){
          window.location = "{{asset('/')}}";
        },3000);
</script>


@endif


@else

@include('forgot-pw-form')

@endisset

@endsection