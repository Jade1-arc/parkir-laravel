@extends('layouts.app')
@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height:70vh;">
    <div class="card p-4 shadow-lg" style="max-width:400px;width:100%;background:rgba(20,30,40,0.95);border-radius:1.2rem;">
        <h2 class="text-center mb-4" style="color:#00ffe7;letter-spacing:2px;">Login Petugas Parkir</h2>
        <form method="POST" action="{{ route('petugas.login') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required autofocus>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            @if($errors->any())
                <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif
            <button type="submit" class="btn w-100" style="background:#00ffe7;color:#222;font-weight:700;">Login Petugas</button>
        </form>
    </div>
</div>
@endsection 