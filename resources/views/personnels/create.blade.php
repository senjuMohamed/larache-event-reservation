@extends('layouts.app')
@section('content')
<h1>Ajouter un Employé</h1>
<form action="{{ route('personnels.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label class="form-label">Nom :</label>
        <input type="text" name="nom" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">telephone :</label>
        <input type="text" name="telephone" class="form-control" >
    </div>
    <div class="mb-3">
        <label class="form-label">mobile :</label>
        <input type="text" name="mobile" class="form-control" >
    </div>
    <div class="mb-3">
        <label class="form-label">email :</label>
        <input type="text" name="email" class="form-control" >
    </div>
    <div class="mb-3">
        <label class="form-label">Rôle :</label>
        <input type="text" name="role" class="form-control" >
    </div>
    <button type="submit" class="btn btn-success">Ajouter</button>
    <div class="mb-3">
        <a href="{{ route('personnels.index') }}" class="btn btn-primary">Retour à l'Index</a>
    </div>
</form>
@endsection