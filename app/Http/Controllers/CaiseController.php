<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CaiseController extends Controller
{
    // Show the page with payment data (Entrée, Sortie)
    public function index(Request $request)
{
    // Initialize the query for Paiement model
    $query = Paiement::query();

    // Filter by Origine (reservation or purchase)
    if ($request->has('origine') && in_array($request->origine, ['reservation', 'purchase'])) {
        $query->where('origine', $request->input('origine'));
    }

    // Filter by Date
    if ($request->has('date') && !empty($request->date)) {
        $query->whereDate('date_paiement', $request->input('date'));
    }

    // Filter by Month
    if ($request->has('month') && !empty($request->month)) {
        $query->whereMonth('date_paiement', $request->input('month'));
    }

    // Get the filtered paiements
    $paiements = $query->get();

    // Separate into Entrée and Sortie based on 'origine'
    $entree = $paiements->where('origine', 'reservation');
    $sortie = $paiements->where('origine', 'purchase');

    // Calculate totals for Entrée and Sortie
    $totalEntree = $entree->sum('montant');
    $totalSortie = $sortie->sum('montant');

    return view('caise.index', compact('paiements', 'entree', 'sortie', 'totalEntree', 'totalSortie'));
}

}
