<!DOCTYPE html>
<html>
<head>
    <title>Data Pages</title>
</head>
<body>

    <h2>Data Pages</h2>

    <!-- Notifikasi -->
    @if(session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif

    <!-- Tombol tambah -->
    <a href="{{ route('pages.create') }}">+ Tambah Page</a>

    <br><br>

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Title</th>
                <th>Slug</th>
                <th>Content</th>
                <th>Image</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pages as $index => $page)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $page->title }}</td>
                    <td>{{ $page->slug }}</td>
                    
                    <!-- Biar content ga kepanjangan -->
                    <td>{{ Str::limit($page->content, 50) }}</td>

                    <td>
                        @if($page->image)
                            <img src="{{ asset('storage/'.$page->image) }}" width="80">
                        @else
                            -
                        @endif
                    </td>

                    <td>
                        {{ $page->is_active ? 'Aktif' : 'Nonaktif' }}
                    </td>

                    <td>
                        <!-- Edit -->
                        <a href="{{ route('pages.edit', $page->id) }}">Edit</a>

                        <!-- Delete -->
                        <form action="{{ route('pages.delete', $page->id) }}" method="POST" style="display:inline">
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