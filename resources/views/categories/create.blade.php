@extends('layouts.app')
@section('content')
    <h1>Create Category</h1>
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div>
            <label for="nom">Category Name</label>
            <input type="text" name="nom" required>
        </div>
        <button type="submit">Save</button>
        <div class="mb-3">
        <a href="{{ route('categories.index') }}" class="btn btn-primary">Retour à l'Index</a>
    </div>
    </form>
    @endsection