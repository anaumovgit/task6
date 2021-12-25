<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Site @yield('title')</title>
    <link rel="stylesheet" href="css/app.css">
{{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">--}}
</head>
<body>
    <div class="container">

        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
            <a class="navbar-brand text-uppercase" href="{{ route('homepage') }}">Site</a>
            <div class="col-md-3 text-end">
                @if (auth()->check())
                    <a class="btn btn-outline-primary me-2" href="{{ route('profile') }}" role="button">{{ auth()->user()->name }}</a>
                    <a class="btn btn-primary" href="{{ route('logout') }}" role="button">Logout</a>
                @else
                    <a class="btn btn-outline-primary me-2" href="{{ route('login.create') }}" role="button">Login</a>
                    <a class="btn btn-primary" href="{{ route('register.create') }}" role="button">Sign-Up</a>
                @endif


            </div>
        </header>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>
    @yield('content')
</body>
</html>
