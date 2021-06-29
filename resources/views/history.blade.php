@extends('app')


@section('heading-title', '使用紀錄' )

@section('text-description')
{{-- test --}}
{{-- {!! trans('lang.how_content') !!}    --}}

<table class="history-table">
    <thead>

        <tr>
            <th>日期</th>
            <th>由</th>
            <th>更新為</th>
            <th>Remarks</th>
        </tr>
    </thead>

    <tbody>

        @for ($i = 0; $i < count($member_records); $i++) <tr>
            <td>{{ $member_records[$i]['created_at'] }}</td>
            <td>


                {{$i ==count($member_records)-1 ? 0 :$member_records[$i+1]['points']}}

                pts
            </td>
            <td>
                {{$i ==count($member_records)-1 ? 5 :$member_records[$i]['points']}}
                pts

            </td>
            <td>{{$member_records[$i]['remark'] }}</td>
            </tr>
            @endfor

    </tbody>
</table>

@endsection