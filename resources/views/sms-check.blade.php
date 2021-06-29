@extends('app')


@section('heading-title', trans('lang.sms_check_title') )

@section('text-description')



@isset($activated)
<div class="success-msg">已帳號已被驗證，3秒後返回主頁</div>
<script type="text/javascript">
    $('.back-btn-div').fadeOut(0);
    setTimeout(function(){window.location="{{asset('/')}}"},3000);
</script>
@else

@isset($submitted_status)

@if ($submitted_status=='correct')
<div class="success-msg">驗證成功，3秒後返回主頁</div>
<script type="text/javascript">
    $('.back-btn-div').fadeOut(0);
    setTimeout(function(){window.location="{{asset('/')}}"},3000);
</script>
@endif

@if ($submitted_status=='incorrect')
<div class="error-msg">驗証碼不正確，請重新輸入。</div>
@include('sms-form')
@endif
@endisset

@isset($email_activation_code)

<div class="sub-msg">sms驗証碼已發出，請查看手機。</div>
@include('sms-form')

<script type="text/javascript">

</script>

@else

@empty($submitted_status)
<div class="sub-msg">驗証連結錯誤，3秒後返回主頁</div>

<script type="text/javascript">
    $('.back-btn-div').fadeOut(0);
    // setTimeout(function(){window.location="{{asset('/')}}"},3000);
</script>

@endempty


@endisset

@endisset






@endsection