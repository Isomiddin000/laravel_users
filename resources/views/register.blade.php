@extends('layouts.app')
@section('title','Register')
@section('content')
<style>
    body {
      background-color: #b138c6; 
    }
  </style>
  
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="text-center">Register</h2>
                <form action="{{route('register')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="registerName">Name</label>
                        <input type="text" class="form-control" id="registerName" name="name">
                    </div>
                    <div class="form-group">
                        <label for="registerEmail">Email address</label>
                        <input type="email" class="form-control" id="registerEmail" name="email">
                    </div>
                    <div class="form-group">
                        <label for="Password">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="form-group">
                        <label for="passwordConfirmation">Confirm Password</label>
                        <input type="password" class="form-control" id="passwordConfirmation" name="password_confirmation">
                    </div>
                    <div class="form-group">
                        <label for="registerAvatar">Upload Avatar</label>
                        <input type="file" class="form-control-file" id="registerAvatar" name="image">
                    </div>
                    <button type="submit" class="btn btn-success btn-block">Register</button>
                </form>
                <p class="text-center mt-2">Already have an account? <a href="{{route('handleLogin')}}">Login</a></p>
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