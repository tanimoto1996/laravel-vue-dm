@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('user.room') }}" method="post">
            @csrf
                <input type="hidden" name="user_send_id" value="{{ $user->id }}">
                <input type="hidden" name="user_Receive_id" value="{{ $page }}">
                <input type="submit" class="btn btn-primary">DMを送る</input>
            </form>
        </div>
    </div>
</div>
@endsection
