@extends('layout')

@section('title', 'Create User')

@section('content')
    <h1>Create New User</h1>
    
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" required>
        </div>
        
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
        </div>
        
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </div>
        
        <button type="submit" class="btn">Create</button>
        <a href="{{ route('users.index') }}" class="btn" style="background-color: #6c757d;">Cancel</a>
    </form>
@endsection

