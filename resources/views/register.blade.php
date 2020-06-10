@extends('app')


@section('heading-title', trans('lang.register_title') )
@section('text-description')

<div class="error-msg">

  @if (($data['error'] ?? '') =='email_registered' )
  你所輸入的電郵地址已經被註冊
  @endif

</div>

@if (($data['error'] ?? '') =='no_error')
<div class="success-msg">請檢查電郵進行新會員申請驗證，3秒後返回主頁</div>
<script type="text/javascript">
  $('.back-btn-div').fadeOut(0);
  setTimeout(function(){
    window.location = "{{asset('/')}}";
  },3000);
</script>

@else
@include('register-form')
@endif

<script type="text/javascript">
  $(function() {
    
    
    submitting=false;
    
      $('.login-form').submit(function() {
    
    
    if(!submitting)
    {
    
        var error_msg = '';
        var full_name = $('.full_name').val();
        var whatapps_number = $('.whatapps_number').val();
        var email = $('.email').val();
        var password = $('.password').val();
        var password_again = $('.password_again').val();
    
        if (!full_name) {
          error_msg += '請輸入你的名字. <br/>';
        }
    
    
    
        var checkTel = /^(\d){8}$/;
        if (!checkTel.test(whatapps_number)) {
          error_msg += '電話輸入格式不正確.<br/>(8個數字,如非香港/澳門地區請個別聯絡開帳號) <br/>';
        }
    
        var checkEmail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    
        if (!checkEmail.test(email)) {
    
          error_msg += '電郵輸入格式不正確. <br/>';
    
        }
    
        if (password.length < 6) {
          error_msg += '你的登入密碼最少六個位. <br/>';
        }
    
        if (password != password_again) {
          error_msg += '重填密碼不正確<br/>';
        }
        if (error_msg) {
          $('.error-msg').html(error_msg);
          return false;
        } else {
          submitting=true;
          return true;
        }
    
      }
      else{
        alert('遞交表格中⋯請稍候⋯');
        return false;
      }
    
      });
    
    
      $('.reset').click(function(){
        $("input[type='text']").attr('value','');
      });
    
    });
    
</script>

@endsection