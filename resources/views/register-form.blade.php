{!! Form::open(['url'=>'member/create','class' => 'login-form','method'=>'post' ]) !!}
@csrf


<input type="text" class="full_name" name="full_name" value="{{($data['full_name'] ?? '') ? $data['full_name']:''}}"
    placeholder="你的名字">
<table class="whatapps_number_div">
    <tbody>
        <tr>
            <td class="left">
                <select name="region" class="region-select">

                    @if (($data['region'] ?? '') )
                    <option value="852" {{$data['region']=='852' ? 'selected' :''}}>香港 852</option>
                    <option value="853" {{$data['region']=='853' ? 'selected' :''}}>澳門 853</option>
                    @else
                    <option value="852">香港 852</option>
                    <option value="853">澳門 853</option>
                    @endif

                </select>
            </td>
            <td class="right"> <input type="text" class="whatapps_number" name="whatsapp_number"
                    value="{{($data['whatsapp_number'] ?? '') ? $data['whatsapp_number']:''}}" placeholder="Whatsapp號碼">
            </td>
        </tr>
    </tbody>
</table>


<input type="text" class="email" name="email" value="{{($data['email'] ?? '') ? $data['email']:''}}" placeholder="登入電郵">
<input type="password" class="password" name="password" value="" placeholder="登入密碼(最少六個位)">
<input type="password" class="password_again" name="password_again" value="" placeholder="重填登入密碼">
<input type="reset" class="reset" name="reset" value="重填">
<input type="submit" name="submit" value="送出">
{!! Form::close() !!}