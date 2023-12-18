@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ $mod->name }}</h2>
        <p><strong>Description:</strong> {{ $mod->description }}</p>
        <p><strong>Image:</strong> {{ $mod->image }}</p>
        <a href="{{ route('mods.index') }}" class="btn btn-primary">Back to Mods List</a>
    </div>
@endsection
