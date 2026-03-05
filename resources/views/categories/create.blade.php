@extends('layout')

@section('title', 'Create Category')

@section('content')
    <h1>Create New Category</h1>
    
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" required>
        </div>
        
        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="4"></textarea>
        </div>
        
        <button type="submit" class="btn">Create</button>
        <a href="{{ route('categories.index') }}" class="btn" style="background-color: #6c757d;">Cancel</a>
    </form>
@endsection

