<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold mb-0 text-dark">
            {{ __('Dépôt de Documents') }}
        </h2>
    </x-slot>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                {{-- Messages de retour (Succès / Erreurs) --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- 1. Résumé du véhicule concerné --}}
                <div class="card shadow-sm border-0 rounded-3 mb-4">
                    <div class="card-body bg-light rounded-3 d-flex align-items-center justify-content-between py-3 px-4">
                        <div>
                            <span class="text-muted small text-uppercase fw-bold">Véhicule sélectionné</span>
                            <h4 class="mb-0 text-dark fw-bold">{{ $vehicle->brand }} {{ $vehicle->model }}</h4>
                        </div>
                        <div>
                            <span class="badge bg-dark px-3 py-2 text-uppercase">{{ $vehicle->status }}</span>
                        </div>
                    </div>
                </div>

                {{-- 2. Formulaire de dépôt de document --}}
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header bg-white py-3 border-bottom">
                        <h5 class="mb-0 text-dark fw-bold">
                            <i class="bi bi-file-earmark-arrow-up text-primary me-2"></i>Téléverser un nouveau document
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        {{-- TRÈS IMPORTANT : enctype="multipart/form-data" pour l'envoi de fichiers --}}
                        <form action="{{ route('admin.vehicles.documents.store', $vehicle->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row g-4">
                                {{-- Nom / Titre du document --}}
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Nom ou titre du document</label>
                                    <input type="text" name="document_name" class="form-control @error('document_name') is-invalid @enderror" placeholder="Ex: Carte Grise, Facture d'achat, Assurance..." value="{{ old('document_name') }}" required>
                                    @error('document_name') 
                                        <div class="invalid-feedback">{{ $message }}</div> 
                                    @enderror
                                </div>

                                {{-- Type de document --}}
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Type de pièce</label>
                                    <select name="document_type" class="form-select @error('document_type') is-invalid @enderror" required>
                                        <option value="" selected disabled>Choisir un type...</option>
                                        <option value="registration">Carte Grise</option>
                                        <option value="invoice">Facture / Contrat</option>
                                        <option value="insurance">Attestation d'Assurance</option>
                                        <option value="other">Autre document</option>
                                    </select>
                                    @error('document_type') 
                                        <div class="invalid-feedback">{{ $message }}</div> 
                                    @enderror
                                </div>

                                {{-- Input File d'envoi --}}
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Fichier (PDF, PNG, JPG)</label>
                                    <input type="file" name="vehicle_document" class="form-control @error('vehicle_document') is-invalid @enderror" required>
                                    @error('vehicle_document') 
                                        <div class="invalid-feedback">{{ $message }}</div> 
                                    @enderror
                                    <div class="form-text text-muted">Taille max : 5 Mo.</div>
                                </div>
                            </div>

                            <div class="mt-4 pt-3 border-top d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.vehicles.index') }}" class="btn btn-outline-secondary">
                                    Annuler
                                </a>
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="bi bi-cloud-upload me-1"></i> Envoyer le document
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>