@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Mods List</h2>

        <!-- Add the search form -->
        <form action="{{ route('mods.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search mods" name="search">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                </div>
            </div>
        </form>

        <div class="mt-3">
            <a href="{{ route('home') }}" class="btn btn-primary">Go back</a>
        </div>

        <!-- Display the role-based message -->
        <div class="mt-3">
            @if(Auth::user() && Auth::user()->role === 'admin')
                <p>You are: admin</p>
            @else
                <p>You are: user</p>
            @endif
        </div>

        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Image</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($mods as $mod)
                <tr>
                    <td>{{ $mod->name }}</td>
                    <td>{{ $mod->description }}</td>
                    <td>{{ $mod->image }}</td>
                    <td>
                        <a href="{{ route('mods.show', $mod->id) }}" class="btn btn-info">Show</a>
                        <a href="{{ route('mods.edit', $mod->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('mods.destroy', $mod->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <a href="{{ route('mods.create') }}" class="btn btn-success">Create Mod</a>
    </div>
@endsection
