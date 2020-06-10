<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>

  <script type="text/javascript">
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');


        $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': CSRF_TOKEN
      }
  });

 $.ajax({
    type: "GET",
    url:"http://s.accessyou-api.com/sms/sendsms-utf8.php?accountno=11033444&pwd=39582987&phone=85251936670&msg=djsfans驗證碼碼碼%0Dddd",
    // dataType:'JSON',
    // data: { 
    // '_token': CSRF_TOKEN
    // },
    success: function(data) {
      alert(data);
        //  console.log(dat);
    }
  });




  // http://s.accessyou-api.com/sms/sendsms-utf8.php?accountno=11033444&pwd=39582987&phone=85251936670&msg=djsfans驗證碼碼碼%0Dccc

//  $.ajax({
//     type: "POST",
//     url:"test2",
//     dataType:'JSON',
//     data: { 
//     '_token': CSRF_TOKEN
//     },
//     success: function(data) {
//       alert(data);
//         //  console.log(dat);
//     }
//   });



  </script>
  {{-- {{asset('/')}} --}}

  @php


  echo url('/');;

  // $m = new Mailer;
  // Mailer::test();
  @endphp

</body>

</html>