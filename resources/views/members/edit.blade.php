<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Buku</title>
    <style>
        body { font-family: sans-serif; margin: 40px; max-width: 500px; }
        label { display: block; margin-top: 12px; font-weight: bold; }
        input, select { width: 100%; padding: 6px; margin-top: 4px; box-sizing: border-box; }
        .error { color: #b91c1c; font-size: 14px; margin-top: 4px; }
        .btn { margin-top: 20px; padding: 8px 16px; background: #2563eb; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
    </style>
</head>
<body>
    <h1>Edit Member</h1>
    <p><a href="{{ route('members.index') }}">&larr; Kembali ke daftar member</a></p>

    <form action="{{ route('members.update', $members['id']) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="nama">nama</label>
        <input type="text" name="nama" id="nama" value="{{ old('nama', $members['nama']) }}">
        @error('nama')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="nim">nim</label>
        <input type="number" name="nim" id="nim" value="{{ old('nim', $members['nim']) }}">
        @error('nim')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="email">email</label>
        <input type="email" name="email" id="email" value="{{ old('email', $members['email']) }}">
        @error('email')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="nomor_telepon">Nomor Telepon</label>
        <input type="number" name="nomor_telepon" id="nomor_telepon" value="{{ old('nomor_telepon', $members['nomor_telepon']) }}">
        @error('nomor_telepon')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="alamat">alamat</label>
        <input type="text" name="alamat" id="alamat" value="{{ old('alamat', $members['alamat']) }}">
        @error('alamat')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="status">status</label>
        <input type="text" name="status" id="status" value="{{ old('status', $members['status']) }}">
        @error('stok')
            <div class="error">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn">Perbarui</button>
    </form>
</body>
</html>