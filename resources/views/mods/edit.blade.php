@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Mod</h2>
        <form action="{{ route('mods.update', $mod->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" class="form-control" value="{{ $mod->name }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" class="form-control" required>{{ $mod->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="text" name="image" class="form-control" value="{{ $mod->image }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Mod</button>
        </form>
    </div>
@endsection
