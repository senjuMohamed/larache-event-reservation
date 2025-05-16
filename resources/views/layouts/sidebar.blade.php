<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin 2</div>
    </a>

    <!-- Nav Item - Produits Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProduits"
            aria-expanded="false" aria-controls="collapseProduits">
            <i class="fas fa-fw fa-box"></i>
            <span>Produits</span>
        </a>
        <div id="collapseProduits" class="collapse" aria-labelledby="headingProduits" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Gestion des Produits:</h6>
        <a class="collapse-item" href="{{ route('produits.index') }}">Afficher Produits</a>
        <a class="collapse-item" href="{{ route('produits.create') }}">Ajouter Produit</a>
<!-- Add Category Management Section -->
        <h6 class="collapse-header">Gestion des Catégories:</h6>
        <a class="collapse-item" href="{{ route('categories.index') }}">Afficher Catégories</a> <!-- List categories -->
        <a class="collapse-item" href="{{ route('categories.create') }}">Ajouter Catégorie</a> <!-- Add a new category -->
    </div>
</div>

    </li>

    <!-- Nav Item - Fournisseurs Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFournisseurs"
            aria-expanded="false" aria-controls="collapseFournisseurs">
            <i class="fas fa-fw fa-truck"></i>
            <span>Fournisseurs</span>
        </a>
        <div id="collapseFournisseurs" class="collapse" aria-labelledby="headingFournisseurs" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Gestion des Fournisseurs:</h6>
                <a class="collapse-item" href="{{ route('fournisseurs.index') }}">Afficher Fournisseurs</a>
                <a class="collapse-item" href="{{ route('fournisseurs.create') }}">Ajouter Fournisseur</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Clients Collapse Menu -->
    <li class="nav-item {{ request()->routeIs('clients.*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseClients"
            aria-expanded="false" aria-controls="collapseClients">
            <i class="fas fa-fw fa-users"></i>
            <span>Clients</span>
        </a>
        <div id="collapseClients" class="collapse {{ request()->routeIs('clients.*') ? 'show' : '' }}" aria-labelledby="headingClients" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Gestion des Clients:</h6>
                <a class="collapse-item" href="{{ route('clients.index') }}">Afficher Clients</a>
                <a class="collapse-item" href="{{ route('clients.create') }}">Ajouter Client</a>
            </div>
        </div>
    </li>
<!-- Nav Item - Events Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEvents"
        aria-expanded="false" aria-controls="collapseEvents">
        <i class="fas fa-fw fa-calendar-alt"></i>
        <span>Événements</span>
    </a>
    <div id="collapseEvents" class="collapse" aria-labelledby="headingEvents" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Gestion des Événements:</h6>
            <a class="collapse-item" href="{{ route('events.index') }}">Afficher Événements</a>
            <a class="collapse-item" href="{{ route('events.create') }}">Ajouter Événement</a>
        </div>
    </div>
</li>
<!-- Nav Item - Purchases Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePurchases"
        aria-expanded="false" aria-controls="collapsePurchases">
        <i class="fas fa-fw fa-truck"></i>
        <span>Achats</span>
    </a>
    <div id="collapsePurchases" class="collapse" aria-labelledby="headingPurchases" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Gestion des Achats:</h6>
            <a class="collapse-item" href="{{ route('purchases.index') }}">Afficher Achats</a>
            <a class="collapse-item" href="{{ route('purchases.create') }}">Ajouter Achat</a>
        </div>
    </div>
</li>   



    <!-- Nav Item - DemandReservation -->
    <li class="nav-item {{ request()->routeIs('reservations.*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDemandReservation"
            aria-expanded="false" aria-controls="collapseDemandReservation">
            <i class="fas fa-fw fa-calendar-check"></i>
            <span>Reservations</span>
        </a>
        <div id="collapseDemandReservation" class="collapse {{ request()->routeIs('demandereservation.*') ? 'show' : '' }}" aria-labelledby="headingDemandReservation" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Gestion des Réservation:</h6>
                <a class="collapse-item" href="{{ route('demandereservation.create') }}">Créer une Demande</a>
                <a class="collapse-item" href="{{ route('demandereservation.index') }}">Afficher les Reservations</a>
            </div>
        </div>
    </li>
    <!-- Nav Item - FactureReservation -->
    <li class="nav-item" @class(['active' => request()->routeIs('paiements.*')])>
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePaiements"
        aria-expanded="false" aria-controls="collapsePaiements">
        <i class="fas fa-fw fa-file-invoice"></i>
        <span>Factures</span>
    </a>
    <div id="collapsePaiements" class="collapse" @class(['show' => request()->routeIs('paiements.*')]) aria-labelledby="headingPaiements" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Gestion des Paiements:</h6>

            <!-- Lien vers l'index des paiements -->
            <a class="collapse-item" href="{{ route('paiements.index') }}">
                Voir les Paiements
            </a>

            <!-- Lien vers la création d'un paiement -->
            <a class="collapse-item" href="{{ route('paiements.create') }}">
                Ajouter un Paiement
            </a>
        </div>
    </div>
</li>

<!-- Nav Item - Caise Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCaise"
        aria-expanded="false" aria-controls="collapseCaise">
        <i class="fas fa-fw fa-cash-register"></i>
        <span>Caise</span>
    </a>
    <div id="collapseCaise" class="collapse" aria-labelledby="headingCaise" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Gestion de la Caise:</h6>
            <a class="collapse-item" href="{{ route('caise.index') }}">Voir la Caise</a>
        </div>
    </div>
</li>


    <!-- Nav Item - Salles Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSalles"
            aria-expanded="false" aria-controls="collapseSalles">
            <i class="fas fa-fw fa-building"></i>
            <span>Salles</span>
        </a>
        <div id="collapseSalles" class="collapse" aria-labelledby="headingSalles" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Gestion des Salles:</h6>
                <a class="collapse-item" href="{{ route('salles.index') }}">Afficher Salles</a>
                <a class="collapse-item" href="{{ route('salles.create') }}">Ajouter Salle</a>
            </div>
            </div>
    </li>

    
    <!-- Nav Item - Personnels Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePersonnels"
            aria-expanded="false" aria-controls="collapsePersonnels">
            <i class="fas fa-fw fa-users"></i>
            <span>Personnels</span>
        </a>
        <div id="collapsePersonnels" class="collapse" aria-labelledby="headingPersonnels" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Gestion des Personnels:</h6>
                <a class="collapse-item" href="{{ route('personnels.index') }}">Afficher Personnels</a>
                <a class="collapse-item" href="{{ route('personnels.create') }}">Ajouter Personnel</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTaxes"
            aria-expanded="false" aria-controls="collapseTaxes">
            <i class="fas fa-fw fa-percent"></i>
            <span>Taxes</span>
        </a>
        <div id="collapseTaxes" class="collapse" aria-labelledby="headingTaxes" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Gestion des Taxes:</h6>
                <a class="collapse-item" href="{{ route('taxes.index') }}">Afficher taxes</a>
                <a class="collapse-item" href="{{ route('taxes.create') }}">Ajouter taxes</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>

<!-- jQuery -->
<script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>

<!-- Bootstrap JS -->
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

<!-- SB Admin JS -->
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
