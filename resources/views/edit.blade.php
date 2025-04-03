@extends('layouts.app')
@section('content')
@section('title', 'Update')
@section('style')
<style>
    body {
      background-color: #b138c6; 
    }
  </style>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection
@section('edit')
    <a class="nav-link" href="{{ route('users.index') }}">Back to Dashboard</a>
@endsection
<div class="container mt-5">
    <h2 class="text-center">Edit Your Profile</h2>
    <div class="row justify-content-center mt-4">
        <div class="col-md-6 profile-card">
            <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="editName">Name</label>
                    <input type="text" class="form-control" id="editName" name="name">
                </div>
                <div class="form-group">
                    <label for="editEmail">Email address</label>
                    <input type="email" class="form-control" id="editEmail" name="email">
                </div>
                <div class="form-group">
                    <label for="editPssword">Password</label>
                    <input type="password" class="form-control" id="editPassword" name="password">
                </div>
                <div class="form-group">
                    <label for="editAvatar">Upload New Avatar</label>
                    <input type="file" class="form-control-file" id="editAvatar" name="image" accept="image/*">
                </div>
             
                
                <button type="submit" class="btn btn-success btn-block">Save Changes</button>
            </form>
        </div>
    </div>
</div>
@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
@endsection