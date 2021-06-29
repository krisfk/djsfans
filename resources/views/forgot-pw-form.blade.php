{!! Form::open(['class'=>'login-form','url'=>'forgot-pw','method'=>'post']) !!}
@csrf
<input type="text" name="email" value="" placeholder="註冊電郵">
<input type="reset" name="reset" value="重填">
<input type="submit" name="submit" value="送出">
{!! Form::close() !!}