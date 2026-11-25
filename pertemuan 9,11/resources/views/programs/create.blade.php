
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Program</title>
</head>
<body>

    <h1>Tambah Program</h1>

    <form action="{{ route('programs.store') }}" method="POST">
        @csrf

        <label>Nama Program</label><br>
        <input type="text" name="nama" required>

        <br><br>

        <label>Deskripsi</label><br>
        <textarea name="deskripsi" required></textarea>

        <br><br>

        <button type="submit">Simpan</button>
    </form>

    <br>

    <a href="{{ route('programs.index') }}">Kembali</a>

</body>
</html>
