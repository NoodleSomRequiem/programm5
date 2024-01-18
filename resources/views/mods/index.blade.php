@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Mods List</h2>

        @if(Auth::user())
            <form action="{{ route('mods.index') }}" method="GET">
                <input type="text" name="search" placeholder="Zoekveld">
                <select name="filter">
                    <option value="">Alle mods</option>
                    <option value="favorites">Mijn favorieten</option>
                </select>
                <button type="submit">Zoeken</button>
            </form>
        @endif
        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Image</th>
                @if(Auth::user())
                    <th>Visibility</th>
                    <th>Actions</th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach ($mods as $mod)
                <tr>
                    <td>{{ $mod->name }}</td>
                    <td>{{ $mod->description }}</td>
                    <td>
                        <div>
                            <img src="{{ asset('storage/' . $mod->image) }}" alt="Post Image"
                                 style="max-width: 50%; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); margin-bottom: 10px;">
                        </div>
                    </td>
                    @if(Auth::check())
                        <td>
                            @if(Auth::user()->role === 'admin')
                                <p>Visibility: {{ $mod->is_visible ? 'Visible' : 'Not Visible' }}</p>
                            @endif
                        </td>
                        <td>
                            @if(Auth::user()->role === 'admin')
                                <a href="{{ route('mods.show', $mod->id) }}" class="btn btn-info">Show</a>
                            @endif
                            @if(Auth::user()->role === 'admin' && Auth::user()->id === $mod->user_id)
                                <a href="{{ route('mods.edit', $mod->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('mods.destroy', $mod->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            @endif
                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
        @if(Auth::user() && Auth::user()->role === 'admin')
            <a href="{{ route('mods.create') }}" class="btn btn-success">Create Mod</a>
        @endif
    </div>
@endsection
