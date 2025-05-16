@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4 text-center fw-bold text-primary">Gestion des Catégories</h2>

    <div class="d-flex justify-content-center gap-3 mb-4">
        <!-- Afficher Catégories Button with blue color -->
        <a href="#" class="btn btn-outline-primary shadow-sm px-4 py-2 fw-semibold" id="showCategoriesBtn">
            <i class="fas fa-list-ul"></i> Afficher Catégories
        </a>

        <!-- Ajouter Catégorie Button with primary color -->
        <a href="#" class="btn btn-primary shadow-sm px-4 py-2 fw-semibold" id="createCategoryBtn">
            <i class="fas fa-plus-circle"></i> Ajouter Catégorie
        </a>
    </div>

    <div class="card shadow-lg border-0 rounded-4" style="background-color: white;">
        <div class="card-body">
            <!-- Section for 'Afficher Catégories' -->
            <div id="afficherCategories" class="section-content" style="display: none;">
                @include('categories.index') <!-- Replace with your categories listing view -->
            </div>

            <!-- Section for 'Ajouter Catégorie' -->
            <div id="createCategory" class="section-content" style="display: none;">
                @include('categories.create') <!-- Replace with your create category view -->
            </div>
        </div>
    </div>
</div>

<style>
    .btn {
        transition: all 0.3s ease-in-out;
        border-radius: 8px;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }

    .card {
        background: #ffffff;
        padding: 20px;
    }

    h2 {
        text-transform: uppercase;
        letter-spacing: 1px;
    }
</style>


@endsection
