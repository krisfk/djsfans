{!! Form::open(['url'=>'login','class' => 'login-form','method'=>'post' ]) !!}
@csrf
<input type="text" name="email" value="" placeholder="登入電郵">
<input type="password" name="password" value="" placeholder="登入密碼">
<input type="reset" name="reset" value="重填">
<input type="submit" name="submit" value="送出">
{!! Form::close() !!}