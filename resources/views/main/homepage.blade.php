<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
</head>

<body>
    @auth

        <h1>Selamat Datang, {{ Auth::user()->name }}!</h1>
        @if (Auth::user()->hasRole('admin'))
            <a href="{{ route('admin.panel') }}" style="color: red;">Masuk ke Panel Admin</a>
        @endif

        <div style="margin-top: 20px;">
            <h3>Foto Profil:</h3>
            <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="Foto {{ Auth::user()->name }}"
                style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover;">

            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>

            <p><strong>Role km:</strong>
                @foreach (Auth::user()->roles as $role)
                    <span>{{ $role->name }}{{ !$loop->last ? ',' : '' }}</span>
                @endforeach
                <br>
                <a href="{{ route('profile.edit') }}">Edit Profil</a>
            </p>
        </div>

        <hr>

        <form action="/logout" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    @endauth
    @guest
        <div style="background: #f4f4f4; padding: 15px;">
            <p>Login dlu pls.</p>
            <a href="/login"><button>Login Sekarang</button></a>
            <a href="/register">Daftar Akun</a>
        </div>
    @endguest
    <hr>
    <p>Terbuka untuk umum</p>
</body>

</html>
