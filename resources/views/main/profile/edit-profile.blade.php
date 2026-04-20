<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit profil</title>
</head>

<body>
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h2>Edit Profil</h2>

        @if (session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif

        <div>
            <label>Foto Saat Ini:</label><br>
            <img src="{{ asset('storage/' . $user->image) }}" width="100"><br>
            <input type="file" name="image">
        </div>

        <div>
            <label>Nama:</label>
            <input type="text" name="name" value="{{ $user->name }}" required>
        </div>

        <div>
            <label>Email:</label>
            <input type="email" name="email" value="{{ $user->email }}" required>
        </div>

        <hr>
        <p><small>Kosongkan password jika tidak ingin menggantinya</small></p>
        <div>
            <label>Password Baru:</label>
            <input type="password" name="password">
        </div>

        <div>
            <label>Konfirmasi Password:</label>
            <input type="password" name="password_confirmation">
        </div>

        <button type="submit">Simpan Perubahan</button>
    </form>
</body>

</html>
