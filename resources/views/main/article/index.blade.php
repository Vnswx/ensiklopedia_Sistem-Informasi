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

            <a href="{{ route('article.create') }}">+ Tambah Page</a>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Isi</th>
                        <th>Gambar</th>
                        <th>Kategori</th>
                        {{-- <th>Dibuat</th>
                        <th>Diupdate</th> --}}
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($article as $index => $a)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $a->title }}</td>

                            <td>{{ Str::limit($a->content, 50) }}</td>

                            <td>
                                @if ($a->image)
                                    <img src="{{ asset('storage/' . $a->image) }}" width="80">
                                @else
                                    -
                                @endif
                            </td>

                            <td>{{ $a->categories->title }}</td>

                            {{-- <td>
                                {{ $a->is_active ? 'Aktif' : 'Nonaktif' }}
                            </td> --}}

                            <td>
                                <!-- Edit -->
                                <a href="{{ route('article.edit', $a->id) }}">Edit</a>
        
                                <!-- Delete -->
                                {{-- <form action="{{ route('pages.delete', $page->id) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin hapus?')">Hapus</button>
                                </form> --}}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">Data kosong</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <hr>

        <form action="/logout" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    @endauth
    <hr>
</body>

</html>
