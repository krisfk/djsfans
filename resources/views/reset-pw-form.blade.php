{{-- reset-pw?mid=DJS2020-1014&pw-rc=UZb4Agjy --}}


@php

$url = 'reset-pw?mid='.$_REQUEST["mid"].'&pw-rc='.$_REQUEST["pw-rc"];

@endphp


{{-- {!! Form::open(['url'=>$url,'class' =>
'login-form','method'=>'post' ]) !!} --}}
<form method="POST" action="{{$url}}" class="login-form">


    @csrf
    <input type="text" name="whatsapp_number" value="" placeholder="你的whatsapp號碼">
    <input type="password" name="password" value="" placeholder="新登入密碼">
    <input type="password" name="password_again" value="" placeholder="再輸入新登入密碼">
    <input type="hidden" name="member_code" value="{{$_REQUEST['mid'] ?? $_REQUEST['member_code'] }}">
    <input type="hidden" name="password_reset_code" value="{{$_REQUEST['pw-rc'] ?? ''}}">
    <input type="reset" name="reset" value="重填">
    <input type="submit" name="submit" value="送出">
</form>