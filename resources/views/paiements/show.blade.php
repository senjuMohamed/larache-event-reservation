@extends('layouts.app')

@section('content')
    <h1>Détails du Paiement</h1>
    <p><strong>ID:</strong> {{ $paiement->id }}</p>
    <p><strong>Montant:</strong> {{ $paiement->montant }} MAD</p>
    <p><strong>Type:</strong> {{ $paiement->type }}</p>
    <p><strong>Date:</strong> {{ $paiement->date }}</p>
    <a href="{{ route('paiements.index') }}" class="btn btn-secondary">Retour</a>
@endsection
