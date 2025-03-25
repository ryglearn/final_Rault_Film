@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-5">Manajemen User</h2>
    <a href="{{ route('users.create') }}" class="bg-rault-500 text-white px-4 py-2 rounded">Tambah User</a>

    <table class="w-full mt-5 border">
        <tr class="bg-gray-200">
            <th class="p-2 border">Nama</th>
            <th class="p-2 border">Email</th>
            <th class="p-2 border">Role</th>
            <th class="p-2 border">Aksi</th>
        </tr>
        @foreach ($users as $user)
        <tr class="border">
            <td class="p-2 border">{{ $user->name }}</td>
            <td class="p-2 border">{{ $user->email }}</td>
            <td class="p-2 border">{{ $user->role }}</td>
            <td class="p-2 border">
                <a href="{{ route('users.edit', $user) }}" class="text-blue-500">Edit</a>
                <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-red-500 ml-2">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
