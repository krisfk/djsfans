@extends('app')

@section('heading-title', 'DJS FANS Points(key-input) [admin only]')

@section('text-description')
<script type="text/javascript">
    $('.back-btn-div').fadeOut(0);
</script>



@if ($error ?? '')
<div class="error-msg">{{$error}}</div>
@endif
<div class="align-center">- Admin Login -</div>

@include('scanner-form')



@endsection