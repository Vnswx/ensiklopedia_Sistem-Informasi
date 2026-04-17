<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pages Create</title>
</head>
<body>
    <form action="{{ route('pages.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
    
        <input type="text" name="title" placeholder="Judul">
        @error('title') <small>{{ $message }}</small> @enderror
    
        <textarea name="content"></textarea>
        @error('content') <small>{{ $message }}</small> @enderror
    
        <input type="file" name="image">
    
        <select name="is_active">
            <option value="1">Aktif</option>
            <option value="0">Nonaktif</option>
        </select>
    
        <button type="submit">Simpan</button>
    </form>
</body>
</html>