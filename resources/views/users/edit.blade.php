@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-5">Edit User</h2>
    <form action="{{ route('users.update', $user) }}" method="POST">
        @csrf @method('PUT')
        <input type="text" name="name" value="{{ $user->name }}" class="w-full p-2 border rounded mb-2">
        <input type="email" name="email" value="{{ $user->email }}" class="w-full p-2 border rounded mb-2">
        <select name="role" class="w-full p-2 border rounded mb-2">
            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
        </select>
        <button type="submit" class="bg-rault-500 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>
@endsection
