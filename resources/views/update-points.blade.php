@extends('app')

@section('heading-title', 'DJS FANS Points(key-input) [admin only]' )

@section('text-description')

<script type="text/javascript">
  $('.back-btn-div').fadeOut(0);
</script>

@if ($error ?? '')
<div class="error-msg">{{$error}}</div>

@include('input-form')
@else

@if ($update_msg ??'')
<div class="success-msg">{{$update_msg}}</div>

@endif


@if ($pass ?? '')
@include('input-form2')

@else
@include('input-form')

@endif


@endif


@endsection