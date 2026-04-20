<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pages Edit</title>
</head>

<body>
    <form action="{{ route('article.update', $article->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="text" name="title" placeholder="Judul" value="{{ $article->title }}">
        @error('title')
            <small>{{ $message }}</small>
        @enderror

        <textarea name="content">{{ $article->content }}</textarea>
        @error('content')
            <small>{{ $message }}</small>
        @enderror

        <input type="file" name="image">

        <div class="form-group">
            <label for="category">Kategori Halaman</label>
            <select name="categories_id" id="category" class="form-controll">
                <option value="{{ $article->categories->id }}">{{ $article->categories->title }}</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <select name="is_active">
            <option value="1">Aktif</option>
            <option value="0">Nonaktif</option>
        </select>

        <button type="submit">Simpan</button>
    </form>
    </form>
</body>

</html>
