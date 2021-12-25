@extends('template.template')
@section('title') @parent - Profile @endsection

@section('content')
    <div class="container">
        <h1>Profile</h1>
        @if (!empty($messages))
            <div class="messages mt-5">
                @foreach($messages as $message)
                    <div class="message">
{{--                        <h4>From: {{ App\Models\User::find($message->by_user)->name }}</h4>--}}
{{--                        <p>Text: {{ $message->message }}</p>--}}
{{--                        <p>{{ $message->created_at }}</p>--}}
{{--                        <br>--}}
                        <div class="card">
                            <h5 class="card-header">From: {{ $message->author_name }}</h5>
                            <div class="card-body">
                                <p class="card-text">{{ $message->message }}</p>
                                <p class="card-text date mt-2">{{ \Carbon\Carbon::parse($message->created_at)->diffForHumans(\Carbon\Carbon::now()) }}</p>
                            </div>
                        </div>
                        <br>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
