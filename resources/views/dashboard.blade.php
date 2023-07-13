@extends('Template.main')

@section('css')
    <style>
      
    </style>
@endsection

@section('content')
@if (session()->has('success'))

<script>
alert('{{ session('success') }}')
</script>

@endif

<h2 class="font-weight-bold">Welcome <span class="text-primary">{{ Auth::user()->name }}</span></h2>
<h5 class="font-weight-normal mb-0">Selamat datang di website sistem informasi kerja praktik mahasiswa <span class="text-primary">Universitas Bina Insani!</span></h5>

@endsection