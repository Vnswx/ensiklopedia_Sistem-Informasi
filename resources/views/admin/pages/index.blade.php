<!DOCTYPE html>
<html>
<head>
    <title>Data Pages</title>
</head>
<body>

    <h2>Data Pages</h2>

    @if(session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif
    <a href="{{ route('admin.panel') }}">Kembali ke admin panel</a> <br>

    <a href="{{ route('pages.create') }}">+ Tambah Page</a>

    <br><br>

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Title</th>
                <th>Slug</th>
                <th>Isi</th>
                <th>Gambar</th>
                <th>Kategori</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pages as $index => $p)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $p->title }}</td>
                    <td>{{ $p->slug }}</td>
                    
                    <!-- Biar content ga kepanjangan -->
                    <td>{{ Str::limit($p->content, 50) }}</td>
                    
                    <td>
                        @if($p->image)
                        <img src="{{ asset('storage/'.$p->image) }}" width="80">
                        @else
                        -
                        @endif
                    </td>
                    
                    <td>{{ $p->categories->title }}</td>
                    
                    <td>
                        {{ $p->is_active ? 'Aktif' : 'Nonaktif' }}
                    </td>

                    <td>
                        <!-- Edit -->
                        <a href="{{ route('pages.edit', $p->id) }}">Edit</a>

                        <!-- Delete -->
                        <form action="{{ route('pages.delete', $p->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Data kosong</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>