@extends('layouts.app')

@section('title', 'Daftar Anggota')

@section('content')
    <h1>Daftar Anggota</h1>

    <p><a href="{{ route('members.create') }}" class="btn">+ Tambah Kategori</a></p>

    <form action="{{ url('/members') }}" method="GET" class="mb-3">
    <input
        type="text"
        name="search"
        value="{{ request('search') }}"
        placeholder="Cari nama anggota..."
        class="form-control"
    >
</form>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>NIM</th>
                <th>Email</th>
                <th>No. Telepon</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($members as $member)
                <tr>
                    <td>{{ $member['id'] }}</td>
                    <td>{{ $member['nama'] }}</td>
                    <td>{{ $member['nim'] }}</td>
                    <td>{{ $member['email'] }}</td>
                    <td>{{ $member['nomor_telepon'] }}</td>
                    <td>{{ ucfirst($member['status']) }}</td>
                    <td>
                        <a href="{{ route('members.edit', $member['id']) }}">Edit</a>
                        |
                        <form class="inline" action="{{ route('members.destroy', $member['id']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Belum ada data anggota.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $members->appends(request()->query())->links() }}

    <p><em>Catatan: data di atas masih data dummy (array statis di Controller). Form tambah/edit anggota dan CRUD lengkap anggota baru dibuat mulai Pertemuan 5.</em></p>
@endsection