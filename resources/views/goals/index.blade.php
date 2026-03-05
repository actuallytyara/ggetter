@extends('layout')

@section('title', 'Goals')

@section('content')
    <h1>Goals</h1>
    <a href="{{ route('goals.create') }}" class="btn">Create New Goal</a>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>User</th>
                <th>Category</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($goals as $goal)
            <tr>
                <td>{{ $goal->id }}</td>
                <td>{{ $goal->judul }}</td>
                <td>{{ $goal->user->name ?? 'N/A' }}</td>
                <td>{{ $goal->category->nama ?? 'N/A' }}</td>
                <td>{{ $goal->status }}</td>
                <td class="actions">
                    <a href="{{ route('goals.edit', $goal->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('goals.destroy', $goal->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection

