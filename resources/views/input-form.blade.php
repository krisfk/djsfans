{!! Form::open(['class'=>'login-form','url'=>'/input','method'=>'post']) !!}
<input type="password" name="input_pw" value="" placeholder="ADMIN 密碼">
<input type="text" name="member_code" value="" placeholder="會員號碼(e.g:DJS2018-1016)">
<input type="submit" name="submit" value="送出">
{!! Form::close() !!}