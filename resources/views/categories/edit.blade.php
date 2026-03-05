@extends('layout')

@section('title', 'Edit Category')

@section('content')
    <h1>Edit Category</h1>
    
    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" value="{{ $category->nama }}" required>
        </div>
        
        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="4">{{ $category->deskripsi }}</textarea>
        </div>
        
        <button type="submit" class="btn">Update</button>
        <a href="{{ route('categories.index') }}" class="btn" style="background-color: #6c757d;">Cancel</a>
    </form>
@endsection

