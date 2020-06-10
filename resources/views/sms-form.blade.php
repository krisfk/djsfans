{!! Form::open(['url'=>'sms-check?ec='.$_GET['ec'],'class' => 'login-form','method'=>'post' ]) !!}
@csrf
<input type="text" maxlength="6" class="sms_code" name="sms_code" value="" placeholder="請輸入六位驗證碼">
<input type="reset" class="reset" name="reset" value="重填">
<input type="submit" name="submit" value="送出">
{!! Form::close() !!}