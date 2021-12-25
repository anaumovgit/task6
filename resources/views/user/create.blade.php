@extends('template.template')
@section('title') @parent - Register @endsection

@section('content')
    <div class="container">
        <h1>Register</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif
        <form method="post" action="{{ route('register.store') }}">
            @csrf
            <div class="form-group mt-5">
                <label for="name">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                       value="{{ old('name') }}">
            </div>
            <div class="form-group mt-5">
                <label for="email">Email address</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror"
                       id="email" name="email" value="{{ old('email') }}">
            </div>
            <div class="form-group mt-5">
                <label for="password">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror"
                       id="password" name="password">
            </div>
            <div class="form-group mt-5">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror"
                       id="password_confirmation" name="password_confirmation">
            </div>
            <div class="d-grid gap-2 col-2">
                <button type="submit" class="btn btn-primary btn-lg mt-5">Register</button>
            </div>

        </form>
    </div>
@endsection
