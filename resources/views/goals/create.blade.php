@extends('layout')

@section('title', 'Create Goal')

@section('content')
    <h1>Create New Goal</h1>
    
    <form action="{{ route('goals.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="user_id">User</label>
            <select name="user_id" id="user_id" required>
                <option value="">Select User</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="form-group">
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->nama }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="form-group">
            <label for="judul">Judul</label>
            <input type="text" name="judul" id="judul" required>
        </div>
        
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" required>
                <option value="pending">Pending</option>
                <option value="in_progress">In Progress</option>
                <option value="completed">Completed</option>
            </select>
        </div>
        
        <button type="submit" class="btn">Create</button>
        <a href="{{ route('goals.index') }}" class="btn" style="background-color: #6c757d;">Cancel</a>
    </form>
@endsection

