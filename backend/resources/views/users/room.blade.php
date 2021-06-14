@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('user.roomUpdate') }}" method="post">
    @csrf
        <input type="hidden" name="user_send_id" value="{{ $user_send_id }}">
        <input type="hidden" name="user_Receive_id" value="{{ $user_Receive_id }}">
        <textarea name="text" id="message" cols="30" rows="10"></textarea>
        <input type="submit" value="送信">
    </form>

    @if (!empty($roomMessage))
        @foreach ($roomMessage as $message)
            {{ $message->text }} <br>
        @endforeach
    @endif
</div>
@endsection