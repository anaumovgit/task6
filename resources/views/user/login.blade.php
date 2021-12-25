@extends('template.template')
@section('title') @parent - Login @endsection

@section('content')
    <div class="container">
        <h1>Login</h1>
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form method="post" action="{{ route('login') }}">
            @csrf
            <div class="form-group mt-5">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
            </div>
            <div class="form-group mt-5">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="d-grid gap-2 col-2">
                <button type="submit" class="btn btn-primary btn-lg mt-5">Login</button>
            </div>

        </form>
    </div>
@endsection
