@extends('Template.main')

@section('css')
    <style>
        /* CSS khusus untuk halaman ini */
    </style>
@endsection

@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

    <form method="POST" action="{{ route('update-password') }}">
        @csrf

        <div class="form-group">
            <label for="current_password">Password Sekarang</label>
            <input id="current_password" type="password" name="current_password" required autofocus>
            @error('current_password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="new_password">Password Baru</label>
            <input id="new_password" type="password" name="new_password" required>
            @error('new_password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="new_password_confirmation">Konfirmasi Password Baru</label>
            <input id="new_password_confirmation" type="password" name="new_password_confirmation" required>
        </div>

        <button type="submit" class="btn btn-primary">Ubah Password</button>
    </form>
@endsection
