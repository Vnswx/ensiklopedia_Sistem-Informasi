<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pages Create</title>
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
    <form action="{{ route('article.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="text" name="title" placeholder="Judul">
        @error('title')
            <small>{{ $message }}</small>
        @enderror

        <textarea name="content"></textarea>
        @error('content')
            <small>{{ $message }}</small>
        @enderror

        <input type="file" name="image">

        <div class="form-group">
            <label for="category">Kategori Halaman</label>
            <select name="categories_id" id="categories_id" class="form-controll" required>
                <option value="">---- Pilih Kategori ---</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}">
                    {{ $category->title }}
                </option>
            @endforeach
            </select>
        </div>

        <button type="submit">Simpan</button>
    </form>
</body>

</html>
