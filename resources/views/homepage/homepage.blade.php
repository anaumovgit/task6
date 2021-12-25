@extends('template.template')
@section('title') @parent @endsection

@section('content')
    <div class="container">
        <h1>Home page</h1>
        @if (!empty($users))
        <div class="btn-group mt-5" role="group" aria-label="Basic checkbox toggle button group">
            @if (\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->role == 'admin')
                <button class="btn btn-outline-primary" form="form" formaction="{{route('block')}}" type="submit">Block</button>
                <button class="btn btn-outline-primary" form="form" formaction="{{route('unblock')}}" type="submit">Unblock</button>
                <button class="btn btn-outline-primary" form="form" formaction="{{route('delete')}}" type="submit">Delete</button>
            @else
                <button class="btn btn-outline-primary" disabled>Block</button>
                <button class="btn btn-outline-primary" disabled>Unblock</button>
                <button class="btn btn-outline-primary" disabled>Delete</button>
            @endif

        </div>

        <table class="table mt-5">
            <thead>
            <tr>
                <th scope="col">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                </th>
                <th scope="col">#</th>
                <th scope="col">name</th>
                <th scope="col">email</th>
                <th scope="col">password</th>
                <th scope="col">registered at</th>
                <th scope="col">last auth at</th>
                <th scope="col">status</th>
                <th scope="col">role</th>
                <th scope="col">send message</th>
            </tr>
            </thead>

            <tbody>


                    <form action="" id="form" method="post">
                        @csrf
                        @php
                            $i = 1;
                            $user_id = \Illuminate\Support\Facades\Auth::user()->id;
                        @endphp

                        @foreach($users as $user)
                            <tr class="align-middle">
                                <td><input name="ids[]" value="{{ $user->id }}" class="form-check-input"
                                           type="checkbox" id="{{ $user->id }}"></td>
                                <th scope="row">{{ $i++ }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->password_show }}</td>
                                <td>{{ $user->registered_at }}</td>
                                <td>{{ $user->auth_at }}</td>
                                <td>{{ $user->status }}</td>
                                <td>{{ $user->role }}</td>
                                @if ($user_id != $user->id)
                                    <td><a href="{{ route('message') }}?id={{ $user->id }}" class="btn btn-primary btn-sm">Message</a></td>
                                @else
                                    <td></td>
                                @endif
                            </tr>
                        @endforeach
                    </form>

            </tbody>
        </table>
        @endif
    </div>
    <script src="js/checkbox.js"></script>
@endsection
