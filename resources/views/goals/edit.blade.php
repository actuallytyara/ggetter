@extends('layout')

@section('title', 'Edit Goal')

@section('content')
    <h1>Edit Goal</h1>
    
    <form action="{{ route('goals.update', $goal->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="user_id">User</label>
            <select name="user_id" id="user_id" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $goal->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div class="form-group">
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $goal->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->nama }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div class="form-group">
            <label for="judul">Judul</label>
            <input type="text" name="judul" id="judul" value="{{ $goal->judul }}" required>
        </div>
        
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" required>
                <option value="pending" {{ $goal->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="in_progress" {{ $goal->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                <option value="completed" {{ $goal->status == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>
        
        <button type="submit" class="btn">Update</button>
        <a href="{{ route('goals.index') }}" class="btn" style="background-color: #6c757d;">Cancel</a>
    </form>
@endsection

