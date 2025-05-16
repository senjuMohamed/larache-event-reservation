@extends('layouts.app')

@section('content')
    <h1>Edit Category</h1>
    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="nom">Category Name</label>
            <input type="text" name="nom" value="{{ $category->nom }}" required>
        </div>
        <button type="submit">Update</button>
        <div class="mb-3">
        <a href="{{ route('categories.index') }}" class="btn btn-primary">Retour à l'Index</a>
    </div>
    </form>
@endsection
