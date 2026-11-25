
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Program</title>
</head>
<body>

    <h1>Edit Program</h1>

    <form action="{{ route('programs.update', $program->id) }}"
          method="POST">

        @csrf
        @method('PUT')

        <label>Nama Program</label><br>
        <input type="text"
               name="nama"
               value="{{ $program->nama }}"
               required>

        <br><br>

        <label>Deskripsi</label><br>
        <textarea name="deskripsi" required>{{ $program->deskripsi }}</textarea>

        <br><br>

        <button type="submit">Update</button>
    </form>

    <br>

    <a href="{{ route('programs.index') }}">Kembali</a>

</body>
</html>
