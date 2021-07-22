@include('header')
@include('nav')

<img class="djsfans-banner" src="{{url('/images/djsfans-banner.jpg')}}">
<img class="djsfans-banner-mobile" src="{{url('images/djsfans-banner.jpg')}}" alt="">


@isset($member)

<div class="loginned-blk">
    <div class="greeting-div">hello ~~ {{$member['full_name']}} {{$member['member_code']}} <a href="{{url('/logout')}}"
            class="logout-btn">登出</a>
    </div>

    <div class="bottom-blk">

        <div class="bottom-blk-1">

            <span class="title-1">- 有效DJS分 -
            </span>
            <span class="title-2 pink">(購物後48小時內更新)</span>

            <div class="pts-div pink">
                <span class="num">{{$member['points']}}</span><span class="pts">Pts</span>
            </div>


            <ul class="pts-ul">
                <li><a href="{{url('/')}}" class="button">更新</a></li>
                <li><a href="{{url('/history')}}" class="button">使用紀錄</a></li>
            </ul>
        </div>


        <div class="bottom-blk-2">
            <table>
                <tbody>
                    <tr>
                        <td>

                            {{-- <img src="http://www.djsfans.com/wp-content/uploads/68159f1d4415771e032387ca36db9e4a585f6cae.png" --}}
                            {{-- height="100" width="100" alt="http://www.djsfans.com/scanner?i=A12345678"> --}}

                            @php
                            $qrcode_str = url('/').'/scanner?i='.$member['member_code'];
                            @endphp
                            <span class="qr-code-wrapper">
                                {!! QrCode::size(100)->generate($qrcode_str); !!}
                            </span>


                            <!-- <img class="qrcode" class="logo" src="http://www.djsfans.com/wp-content/themes/twentynineteen/img/qrcode.png"> -->

                        </td>
                        <td><span class="member-title">會員號碼:</span> <br>
                            <span class="member-id">{{$member['member_code']}}</span>

                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="remark">

                <div class="remark-1">

                    <span class="pink">店面購物時使用：</span><br>
                    請於結帳時向店員出示QRcode
                </div>


                <div class="remark-2">

                    <span span="" class="pink">Whatapps下單時使用：</span><br>
                    傳入數紙訊息並附上會員號碼
                </div>


            </div>
        </div>

    </div>

</div>

@else


<div class="before-login-div">

    <span class="script pink">{!! trans("lang.intro_txt") !!}</span>

    <ul>
        <li><a href="/login" class="">{{trans("lang.login_txt")}}</a></li>
        <li><a href="/register" class="">{{trans("lang.join_txt")}}</a></li>
    </ul>

    <a class="forgotpw-btn" href="./forgot-pw">{{trans('lang.forgot_pw_txt')}}</a>
</div>

@endisset




</body>

</html>