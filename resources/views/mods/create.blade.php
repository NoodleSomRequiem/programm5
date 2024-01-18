
@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Create a New Mod</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form method="post" action="{{ route('mods.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="name">Mod Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required>
            </div>

            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="is_visible" name="is_visible" checked>
                <label class="form-check-label" for="is_visible">Visible</label>
            </div>

            <button type="submit" class="btn btn-primary">Create Mod</button>
        </form>
    </div>
@endsection
