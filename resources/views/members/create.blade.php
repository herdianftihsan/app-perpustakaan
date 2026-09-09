<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Member</title>
    <style>
        body { font-family: sans-serif; margin: 40px; max-width: 500px; }
        label { display: block; margin-top: 12px; font-weight: bold; }
        input, textarea { width: 100%; padding: 6px; margin-top: 4px; box-sizing: border-box; }
        .error { color: #b91c1c; font-size: 14px; margin-top: 4px; }
        .btn { margin-top: 20px; padding: 8px 16px; background: #2563eb; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
    </style>
</head>
<body>
    <h1>Tambah Member</h1>
    <p><a href="{{ route('members.index') }}">&larr; Kembali ke daftar Member</a></p>

    <form action="{{ route('members.store') }}" method="POST">
        @csrf

        <label for="nama">Nama </label>
        <input type="text" name="nama" id="nama" value="{{ old('nama') }}">
        @error('nama')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="nim">NIM</label>
        <input type="number" name="nim" id="nim" value="{{ old('nim') }}">
        @error('nim')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}">
        @error('email')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="alamat">Alamat</label>
        <input type="text" name="alamat" id="alamat" value="{{ old('alamat') }}">
        @error('alamat')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="nomor_telepon">No telepon</label>
        <input type="text" name="nomor_telepon" id="nomor_telepon" value="{{ old('nomor_telepon') }}">
        @error('nomor_telepon')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="status">status</label>
        <input type="text" name="status" id="status" value="{{ old('status') }}">
        @error('status')
            <div class="error">{{ $message }}</div>
        @enderror
        <button type="submit" class="btn">Simpan</button>
    </form>
</body>
</html>