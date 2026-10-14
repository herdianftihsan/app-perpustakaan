@extends('layouts.app')

@section('title', 'Profil')

@section('content')
    <h1>Profil Petugas</h1>

    <table class="info profile-info">
        <tr>
            <th>Nama</th>
            <td>{{ $user->name }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <th>Role</th>
            <td>{{ ucfirst($user->role) }}</td>
        </tr>
    </table>

    <h2 class="profile-heading">Ganti Password</h2>

    <form action="{{ route('profile.password.update') }}" method="POST" class="profile-form">
        @csrf
        @method('PUT')

        <label for="current_password">Password lama</label>
        <input type="password" name="current_password" id="current_password">
        @error('current_password')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="password">Password baru</label>
        <input type="password" name="password" id="password">
        @error('password')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="password_confirmation">Konfirmasi password baru</label>
        <input type="password" name="password_confirmation" id="password_confirmation">

        <button type="submit" class="btn profile-submit">Simpan Password</button>
    </form>
@endsection
