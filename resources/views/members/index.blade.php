<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Member</title>
    <style>
        body { font-family: sans-serif; margin: 40px; }
        table { border-collapse: collapse; width: 100%; margin-top: 16px; }
        th, td { border: 1px solid #ccc; padding: 8px 12px; text-align: left; }
        .success { background: #d1fae5; color: #065f46; padding: 10px 14px; border-radius: 4px; margin-top: 16px; }
        .btn { display: inline-block; padding: 6px 14px; background: #2563eb; color: #fff; text-decoration: none; border-radius: 4px; }
    </style>
</head>
<body>
    <h1>Daftar Member</h1>

    @if (session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    <p><a href="{{ route('members.create') }}" class="btn">+ Tambah Member</a></p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama </th>
                <th>Nim</th>
                <th>email</th>
                <th>alamat</th>
                <th>No Telepon</th>
                <th>status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($members as $member)
                <tr>
                    <td>{{ $member['id'] }}</td>
                    <td>{{ $member['nama'] }}</td>
                    <td>{{ $member['nim']}}</td>
                    <td>{{ $member['email']}}</td>
                    <td>{{ $member['alamat']}}</td>
                    <td>{{ $member['nomor_telepon']}}</td>
                    <td>{{ $member['status']}}</td>
                    <td>
                        <a href="{{ route('members.edit', $member['id']) }}">Edit</a>
                        |
                        <form style="display:inline" action="{{ route('members.destroy', $member['id']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Belum ada data Member.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <p><em>Catatan: data di atas masih data dummy (array statis di Controller), belum dari database. Migration &amp; Model Eloquent baru dibuat di Pertemuan 5.</em></p>
</body>
</html>