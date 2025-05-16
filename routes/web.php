<?php
use App\Models\Event;
use App\Models\Salle;
use App\Models\Produit;
use App\Http\Controllers\{
    CategoryProduitController,
    ClientController,
    DashboardController,
    DemandeReservationController,
    EventController,
    FactureReservationController,
    FournisseurController,
    HomeController,
    PaiementController,
    PageController,
    PersonnelController,
    ProduitController,
    ProfileController,
    PurchaseController,
    PurchaseLineController,
    SalleController,
    ServiceController,
    FacturePurchaseController,
    TaxController,
    Clientelcontroller
};
use App\Http\Controllers\WordPressController;
use App\Http\Controllers\CaiseController;

Route::get('/get-produits/{salleId}', [DemandeReservationController::class, 'getProduitsBySalle']);
Route::get('/caise', [CaiseController::class, 'index'])->name('caise.index');

// Route::prefix('wordpress')->group(function () {
    // Route::get('/fetch-data', [WordPressController::class, 'fetchData']);
// });
Route::resource('paiements', PaiementController::class);

    
Route::get('/events-json', [EventController::class, 'getEventsJson']);
Route::get('/salles-json', [SalleController::class, 'getSallesJson']);
Route::get('/services-json', [ServiceController::class, 'getServicesJson']);



// Route to fetch data for events, salle, and services
// Route::get('/fetch-data', [Clientelcontroller::class, 'getData']);
// Route::get('/client/data', [Clientelcontroller::class, 'getData']);

// Route to allow the client to send their data back
// Route::post('/client/store', [Clientelcontroller::class, 'storeClientData']);
Route::get('/facture_reservations/create/{demandeReservation}', [FactureReservationController::class, 'create'])->name('facture_resevations.create');
// Create route for storing facture reservations
Route::post('/facture_reservations', [FactureReservationController::class, 'store'])->name('facture_reservations.store');

Route::get('/facture_purchases/show/{id}', [FacturePurchaseController::class, 'show'])->name('facture_purchases.show');

    Route::resource('facture_reservations', FactureReservationController::class)->parameters([
        'facture_reservations' => 'reservation_id'
    ]);
    


// Archive Routes for Categories, Produits, Clients, Taxes, Events, Purchases, Fournisseurs, Salles, Services, Personnels, DemandeReservations
Route::prefix('categories')->group(function () {
    Route::get('archive', [CategoryProduitController::class, 'archive'])->name('categories.archive');
    Route::post('{category}/restore', [CategoryProduitController::class, 'restore'])->name('categories.restore');
    Route::delete('{category}/force-delete', [CategoryProduitController::class, 'forceDelete'])->name('categories.forceDelete');
});



Route::prefix('clients')->group(function () {
    Route::get('archive', [ClientController::class, 'archive'])->name('clients.archive');
    Route::post('{client}/restore', [ClientController::class, 'restore'])->name('clients.restore');
    Route::delete('{client}/forceDelete', [ClientController::class, 'forceDelete'])->name('clients.forceDelete');
});
Route::get('taxes', [TaxController::class, 'index'])->name('taxes.index');
Route::prefix('taxes')->group(function () {
    Route::get('archive', [TaxController::class, 'archive'])->name('taxes.archive');
    Route::post('{id}/restore', [TaxController::class, 'restore'])->name('taxes.restore');
    Route::delete('{id}/forceDelete', [TaxController::class, 'forceDelete'])->name('taxes.forceDelete');
});

Route::prefix('events')->group(function () {
    Route::get('archive', [EventController::class, 'archive'])->name('events.archive');
    Route::post('{id}/restore', [EventController::class, 'restore'])->name('events.restore');
    Route::delete('{id}/forceDelete', [EventController::class, 'forceDelete'])->name('events.forceDelete');
});

Route::prefix('purchases')->group(function () {
    Route::get('archive', [PurchaseController::class, 'archive'])->name('purchases.archive');
    Route::post('{purchase}/restore', [PurchaseController::class, 'restore'])->name('purchases.restore');
    Route::delete('{purchase}/forceDelete', [PurchaseController::class, 'forceDelete'])->name('purchases.forceDelete');
});

Route::prefix('fournisseurs')->group(function () {
    Route::get('archive', [FournisseurController::class, 'archive'])->name('fournisseurs.archive');
    Route::post('{fournisseur}/restore', [FournisseurController::class, 'restore'])->name('fournisseurs.restore');
    Route::delete('{fournisseur}/forceDelete', [FournisseurController::class, 'forceDelete'])->name('fournisseurs.forceDelete');
});

Route::prefix('salles')->group(function () {
    Route::get('archive', [SalleController::class, 'archive'])->name('salles.archive');
    Route::post('{salle}/restore', [SalleController::class, 'restore'])->name('salles.restore');
    Route::delete('{salle}/forceDelete', [SalleController::class, 'forceDelete'])->name('salles.forceDelete');
});

Route::prefix('services')->group(function () {
    Route::get('archive', [ServiceController::class, 'archive'])->name('services.archive');
    Route::post('{service}/restore', [ServiceController::class, 'restore'])->name('services.restore');
    Route::delete('{service}/forceDelete', [ServiceController::class, 'forceDelete'])->name('services.forceDelete');
});

Route::prefix('personnels')->group(function () {
    Route::get('archive', [PersonnelController::class, 'archive'])->name('personnels.archive');
    Route::post('{personnel}/restore', [PersonnelController::class, 'restore'])->name('personnels.restore');
    Route::delete('{personnel}/forceDelete', [PersonnelController::class, 'forceDelete'])->name('personnels.forceDelete');
});

Route::prefix('demandereservation')->group(function () {
    Route::get('archive', [DemandeReservationController::class, 'archive'])->name('demandereservation.archive');
    Route::post('{demandeReservation}/restore', [DemandeReservationController::class, 'restore'])->name('demandereservation.restore');
    Route::delete('{demandeReservation}/forceDelete', [DemandeReservationController::class, 'forceDelete'])->name('demandereservation.forceDelete');
});

// Facture Purchases Routes
Route::get('/facture_purchases', [FacturePurchaseController::class, 'index'])->name('purchase.index');
Route::get('facture_purchases/create/{purchase?}', [FacturePurchaseController::class, 'create'])->name('facture_purchases.create');
Route::post('/facture_purchases/store/{purchase}', [FacturePurchaseController::class, 'store'])->name('facture_purchases.store');

// Dashboard Route
Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Authentication Routes
require __DIR__.'/auth.php';

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('produits')->group(function () {
        Route::get('archive', [ProduitController::class, 'archive'])->name('produits.archive');
        Route::get('create', [ProduitController::class, 'create'])->name('produits.create');
        Route::post('', [ProduitController::class, 'store'])->name('produits.store');
        Route::post('{produit}/restore', [ProduitController::class, 'restore'])->name('produits.restore');
        Route::delete('{produit}/forceDelete', [ProduitController::class, 'forceDelete'])->name('produits.forceDelete');
        Route::get('trashed', [ProduitController::class, 'trashed'])->name('produits.trashed');
    });

    Route::resources([
        'demandereservation' => DemandeReservationController::class,
        'events'             => EventController::class,
        'categories'         => CategoryProduitController::class,
        'produits'           => ProduitController::class,
        'clients'            => ClientController::class,
        'paiements'          => PaiementController::class,
        'fournisseurs'       => FournisseurController::class,
        'services'           => ServiceController::class,
        'salles'             => SalleController::class,
        'taxes'             => TaxController::class,
        'personnels'         => PersonnelController::class,
    ]);
});

// Facture Reservations Routes

// Purchases with Purchase Lines Inside
Route::resource('purchases', PurchaseController::class);
Route::prefix('purchases/{purchase}')->group(function () {
    Route::get('lines', [PurchaseController::class, 'showLines'])->name('purchases.lines');
    Route::post('lines', [PurchaseController::class, 'storeLine'])->name('purchases.lines.store');
    Route::delete('lines/{line}', [PurchaseController::class, 'deleteLine'])->name('purchases.lines.delete');
});

// Main Resources


Route::get('/produits/{produit}', [ProduitController::class, 'show'])->name('produits.show');

// Client Demand Routes
Route::prefix('clients/{client}')->name('clients.')->group(function () {
    Route::resource('demandes', DemandeReservationController::class)->shallow();
    Route::get('historique', [ClientController::class, 'show'])->name('historique');
});
