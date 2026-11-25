<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah User</title>
</head>
<body>
    <h1>Tambah User</h1>

    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <label>Nama</label><br>
        <input type="text" name="name" value="{{ old('name') }}" required><br><br>

        <label>Email</label><br>
        <input type="email" name="email" value="{{ old('email') }}" required><br><br>

        <label>Password</label><br>
        <input type="password" name="password" minlength="8" required><br><br>

        <button type="submit">Simpan</button>
        <a href="{{ route('users.index') }}">Kembali</a>
    </form>
</body>
</html>
