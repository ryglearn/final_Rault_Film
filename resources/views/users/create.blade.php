@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-5">Tambah User</h2>
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Nama" class="w-full p-2 border rounded mb-2">
        <input type="email" name="email" placeholder="Email" class="w-full p-2 border rounded mb-2">
        <input type="password" name="password" placeholder="Password" class="w-full p-2 border rounded mb-2">
        <select name="role" class="w-full p-2 border rounded mb-2">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>
        <button type="submit" class="bg-rault-500 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>
@endsection
