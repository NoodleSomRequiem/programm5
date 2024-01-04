@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ $mod->name }}</h2>
        <p><strong>Description:</strong> {{ $mod->description }}</p>
        <p><strong>Image:</strong> {{ $mod->image }}</p>
        <!-- mods.show.blade.php or any relevant view file -->
        <form method="post" action="{{ route('mods.toggleFavorite', $mod->id) }}">
            @csrf
            <button type="submit" class="btn btn-{{ Auth::user() && Auth::user()->favoriteMods->contains($mod) ? 'success' : 'secondary' }}">
                {{ Auth::user() && Auth::user()->favoriteMods->contains($mod) ? 'Unfavorite' : 'Favorite' }}
            </button>
        </form>

        <a href="{{ route('mods.index') }}" class="btn btn-primary">Back to Mods List</a>
    </div>
@endsection
