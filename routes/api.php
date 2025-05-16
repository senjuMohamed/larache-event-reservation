<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EventController; 
use App\Http\Controllers\Api\BlogController;
use App\Models\Event;
use App\Models\Salle;
use App\Http\Controllers\WordPressController;
use App\Models\Produit; // Use Produit model
Route::match(['get', 'post'], '/store-client-data', [WordPressController::class, 'storeClientData']);
Route::get('blog', [BlogController::class, 'index']); // BlogController route
Route::post('store-client', [WordPressController::class, 'storeClientData']);
// Fetch events, salles, and produits of type "service"
Route::get('/fetch-data', function () {
    $csrfToken = csrf_token();  // Get CSRF token from Laravel

    // Fetch the necessary data and map it
    return response()->json([
        'csrfToken' => $csrfToken,  // Include CSRF token at the root of the response
        'events' => Event::select('id', 'name')->get(),
        'salles' => Salle::select('id', 'nom')->get(),
        'services' => Salle::with('produits') // Corrected to 'produits' to match the relationship
            ->select('id', 'nom')
            ->get()
            ->map(function($salle) {
                return [
                    'salle_id' => $salle->id,
                    'salle_nom' => $salle->nom,
                    'produits' => $salle->produits->pluck('nom', 'id') // Plucking the 'nom' and 'id' from the related produits
                ];
            })
    ]);
});

// EventController routes
Route::get('/events-json', [EventController::class, 'index']);
Route::get('events', [EventController::class, 'getEvents']);
Route::get('events/{id}', [EventController::class, 'getEvent']);
Route::post('events', [EventController::class, 'store']);
Route::put('events/{id}', [EventController::class, 'update']);
Route::delete('events/{id}', [EventController::class, 'destroy']);
Route::get('archived-events', [EventController::class, 'getArchivedEvents']);
Route::put('events/restore/{id}', [EventController::class, 'restore']);
Route::delete('events/force-delete/{id}', [EventController::class, 'forceDelete']);

// Route that requires authentication
Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/unavailable-dates', [WordPressController::class, 'getUnavailableDates']);
Route::post('/send-whatsapp-message', [WordPressController::class, 'sendWhatsAppMessage']);
