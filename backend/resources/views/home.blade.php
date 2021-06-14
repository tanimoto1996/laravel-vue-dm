@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach ($users as $user)
            <a href="{{ route('user.index', ['id' => $user->id]) }}">
                <div class="card">
                    <div class="card-body">
                        {{ $user->name }}
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
@endsection
