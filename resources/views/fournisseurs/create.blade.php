@extends('layouts.app')
@section('content')
<form action="{{ route('fournisseurs.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="nom">Nom</label>
        <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom') }}" required>
    </div>
    <div class="form-group">
        <label for="telephone">Téléphone</label>
        <input type="text" name="telephone" id="telephone" class="form-control" value="{{ old('telephone') }}" required>
    </div>

    <div class="form-group">
        <label for="mobile">Mobile</label>
        <input type="text" name="mobile" id="mobile" class="form-control" value="{{ old('mobile') }}" required>
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
    </div>

    <button type="submit" class="btn btn-primary">Enregistrer</button>
    <div class="mb-3">
        <a href="{{ route('fournisseurs.index') }}" class="btn btn-primary">Retour à l'Index</a>
    </div>
</form>
@endsection