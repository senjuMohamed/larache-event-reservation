@extends('layouts.app')
@section('content')
<h1>Détails de l'Employé</h1>
<p><strong>ID:</strong> {{ $personnel->id }}</p>
<p><strong>Nom:</strong> {{ $personnel->nom }}</p>
<p><strong>Email:</strong> {{ $personnel->email ?? 'N/A' }}</p>
<p><strong>Téléphone:</strong> {{ $personnel->telephone ?? 'N/A' }}</p>
<p><strong>Mobile:</strong> {{ $personnel->mobile ?? 'N/A' }}</p>
<p><strong>Rôle:</strong> {{ $personnel->role }}</p>
<a href="{{ route('personnels.index') }}" class="btn btn-secondary">Retour</a>
@endsection