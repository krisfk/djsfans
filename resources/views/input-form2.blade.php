{{-- <form class="admin-form" action="http://www.djsfans.com/input" method="post"> --}}
{!! Form::open(['class'=>'admin-form','url'=>'/input','method'=>'post']) !!}
<table class="scanner-table">
    <tbody>
        <tr>
            <td>Member ID:</td>
            <td>
                {{$member['member_code']}}<input type="hidden" name="member_code" value="{{$member['member_code']}}">
            </td>
        </tr>
        <tr>
            <td>Full Name:</td>
            <td>
                {{$member['full_name']}} </td>
        </tr>
        <tr>
            <td>Whatapps Number:</td>
            <td>
                {{$member['whatsapp_number']}} </td>
        </tr>
        <tr>
            <td>Current Points:</td>
            <td>
                {{$member['points']}}<input type="hidden" class="from_point" name="from_point"
                    value="{{$member['points']}}">

            </td>
        </tr>
        <tr>
            <td>Change To Points:</td>
            <td><input type="tel" class="to_point" name="to_point" value="{{$member['points']}}"></td>
        </tr>

        <tr>
            <td>Remark:</td>
            <td><input name="remark" type="text"></td>
        </tr>

    </tbody>
</table>

<div class="admin-submit-logout-div">
    <input class="return-btn" type="button" name="logout" value="返回">

    <input type="submit" name="submit" value="送出">
</div>

{!! Form::close() !!}

<script type="text/javascript">
    $(function(){

    $('.return-btn').click(function(){
        window.location='./input';
    })
})
</script>
{{-- </form> --}}