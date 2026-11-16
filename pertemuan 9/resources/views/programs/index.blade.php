
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Program</title>
</head>
<body>

    <h1>Daftar Program</h1>

    <a href="{{ route('programs.create') }}">
        Tambah Program
    </a>

    <br><br>

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Program</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($programs as $program)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $program->nama }}</td>
                    <td>{{ $program->deskripsi }}</td>
                    <td>
                        <a href="{{ route('programs.edit', $program->id) }}">
                            Edit
                        </a>

                        <form action="{{ route('programs.destroy', $program->id) }}"
                              method="POST"
                              style="display:inline;">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                onclick="return confirm('Yakin ingin menghapus program ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Belum ada data program.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>
