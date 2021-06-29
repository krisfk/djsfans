@extends('app')


@section('heading-title')
重新設定 DJS FANS 密碼<br /><span class="subtitle"> - {{$member_code}} - </span>
@endsection

@section('text-description')


@isset($success)
<div class="success-msg">登入密碼修改成功，3秒後返回主頁</div>
@else

@isset($wrong_url)
<div class="error-msg">連結錯誤，3秒後返回主頁。</div>
@else
@isset($expired)
<div class="error-msg">此連結已過期，3秒後返回主頁。</div>

@else

@if ($whatsapp_number_error ?? '')
<div class="error-msg">此whatsapp號碼沒有用作登記</div>
@include('reset-pw-form')

@else

@if ($password_not_same ?? '')
<div class="error-msg">再次輸入新密碼不正確</div>
@include('reset-pw-form')

@else
@include('reset-pw-form')

@endif
@endif


@endisset

@endisset


@endisset








@isset($return)
<script type="text/javascript">
  setTimeout(function(){
      window.location = "{{asset('/')}}";
},3000);
</script>
@endisset

@endsection