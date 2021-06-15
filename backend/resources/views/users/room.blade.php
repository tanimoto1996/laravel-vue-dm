@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('user.roomUpdate') }}" method="post">
    @csrf
        <message-component :user_send_id="{{ $user_send_id }}" :user_receive_id="{{ $user_Receive_id }}"></message-component>
    </form>

    @if (!empty($roomMessage))
        @foreach ($roomMessage as $message)
            {{ $message->text }} <br>
        @endforeach
    @endif
</div>
@endsection