@extends('template.template')
@section('title') @parent - Send Message @endsection

@section('content')
    <div class="container">
        <h1>Send Message</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif
        <form action="{{ route('message') }}" method="post" name="send_message">
            @csrf
            <div class="form-floating">
                <textarea name="message" type="message" class="form-control @error('message') is-invalid @enderror" placeholder="Leave a comment here" id="message" style="height: 300px"></textarea>
                <label for="message">Comments</label>
                <input type="hidden" name="id" value="{{ $id }}">
            </div>
            <div class="d-grid gap-2 mt-3">
                <button class="btn btn-primary" type="submit">Send</button>
            </div>
        </form>
    </div>
@endsection
