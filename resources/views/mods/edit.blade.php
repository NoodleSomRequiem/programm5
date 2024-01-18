@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Mod</h2>
        <form method="POST" action="{{ route('mods.update', $mod->id) }}">
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
            <div class="form-group">
                <label for="is_visible">Is Visible:</label>
                <input type="checkbox" name="is_visible" value="1" {{ $mod->is_visible ? 'checked' : '' }}>
            </div>
            <button type="submit" class="btn btn-primary">Update Mod</button>
        </form>
    </div>
@endsection
