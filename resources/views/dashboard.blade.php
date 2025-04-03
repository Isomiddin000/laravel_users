@extends('layouts.app')
@section('content')
@section('title','Dashboard')
@section('style')
<style>
    body {
      background-color: #b138c6;
    }
  </style>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection
@section('dashboard')
    <a class="nav-link" href="{{ route('logout') }}">Logout</a>
@endsection

<div class="container mt-5">
    <h2 class="text-center">Welcome to Your Dashboard</h2>
    <div class="row justify-content-center mt-4">
        <div class="col-md-4 profile-card">
            <h4 class="text-center">Your Profile</h4>
            @if (Auth::check())
                @php
                    $user = Auth::user();
                @endphp
                <p>{{ $user->name }}</p>
                <p>{{ $user->email }}</p>
                <div class="text-center">
                    @if ($user->image)
                        <img src="{{ asset('storage/' . $user->image) }}" alt="User Image"
                            style="width:60px; height:auto;">
                    @endif
                    <p>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-secondary">Edit Profile</a>
                    </p>
                </div>
            @else
                <p>Foydalanuvchi tizimga kirmagan.</p>
            @endif
        @endsection