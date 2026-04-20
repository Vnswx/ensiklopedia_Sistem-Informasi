<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin test</title>
</head>
<body>
    halo, aku admin <br>
    <a href="{{ route('homepage') }}" style="color: red;">Balik ke homepage</a> <br>
    <a href="{{ route('pages.index') }}" style="color: red;">Ke index pages</a>

    <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID User</th>
                        <th>Nama User</th>
                        <th>Title</th>
                        <th>Isi</th>
                        <th>Gambar</th>
                        <th>Status</th>
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
                            <td>{{ $a->user_id }}</td>
                            <td>{{ $a->user->name }}</td>
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
                            <td>{{ $a->status }}</td>

                            {{-- <td>
                                {{ $a->is_active ? 'Aktif' : 'Nonaktif' }}
                            </td> --}}

                            <td>
                                <!-- Edit -->
                                <a href="{{ route('admin.approve', $a->id) }}">Approve</a>
                                <a href="{{ route('admin.reject', $a->id) }}">Reject</a>
        
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
</body>
</html>