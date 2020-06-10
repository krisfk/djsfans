@php

$url = '/scanner?i='.$_REQUEST['i'];

@endphp

{!! Form::open(['class'=>'login-form','url'=>$url,'method'=>'post']) !!}
<input type="password" name="scanner_pw" value="" placeholder="登入密碼">
<input type="hidden" name="member_code" value="{{$member_code}}">
<input type="submit" name="submit" value="送出">
{!! Form::close() !!}