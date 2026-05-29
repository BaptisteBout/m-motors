<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold mb-0 text-dark">
            {{ __('Gestion du Parc Automobile - M-Motors') }}
        </h2>
    </x-slot>

    <div class="container pb-5">
        <div class="row">
            <div class="col-12">

                {{-- Message de succès après action --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- Carte du Tableau Principal --}}
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3 border-bottom">
                        <h5 class="mb-0 text-dark font-weight-bold d-flex align-items-center">
                            <i class="bi bi-car-front-fill me-2 text-primary"></i> Liste des véhicules
                        </h5>
                        
                        {{-- En haut, on ne garde QUE le bouton de création globale --}}
                        <a href="{{ route('admin.vehicles.create') }}" class="btn btn-success btn-sm px-3 shadow-sm">
                            <i class="bi bi-plus-lg me-1"></i> Ajouter un véhicule
                        </a>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover mb-0 align-middle">
                                <thead class="table-light text-secondary border-bottom">
                                    <tr>
                                        <th class="ps-4 py-3 text-uppercase small tracking-wider" style="font-size: 0.8rem;">Marque</th>
                                        <th class="py-3 text-uppercase small tracking-wider" style="font-size: 0.8rem;">Modèle</th>
                                        <th class="py-3 text-uppercase small tracking-wider" style="font-size: 0.8rem;">Type d'acquisition</th>
                                        <th class="py-3 text-uppercase small tracking-wider" style="font-size: 0.8rem;">Prix Achat</th>
                                        <th class="py-3 text-uppercase small tracking-wider" style="font-size: 0.8rem;">Statut</th>
                                        <th class="text-end pe-4 py-3 text-uppercase small tracking-wider" style="font-size: 0.8rem;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($vehicles as $vehicle)
                                        <tr>
                                            <td class="ps-4 fw-bold text-dark">{{ $vehicle->brand }}</td>
                                            <td class="text-secondary fw-semibold">{{ $vehicle->model }}</td>
                                            <td>
                                                <span class="badge bg-info text-dark px-3 py-2 text-uppercase" style="letter-spacing: 0.5px; font-size: 0.75rem;">
                                                    {{ $vehicle->acquisition_type }}
                                                </span>
                                            </td>
                                            <td class="fw-bold text-dark">
                                                {{ number_format($vehicle->price_purchase, 2, ',', ' ') }} €
                                            </td>
                                            <td>
                                                <span class="badge {{ $vehicle->status === 'available' ? 'bg-success' : 'bg-warning' }} px-3 py-2 text-uppercase" style="font-size: 0.75rem;">
                                                    {{ $vehicle->status }}
                                                </span>
                                            </td>
                                            <td class="text-end pe-4">
                                                <div class="d-inline-flex gap-2">
                                                    {{-- 1. Bouton Documents (Placé au bon endroit, la variable $vehicle existe ici) --}}
                                                    <a href="{{ route('admin.vehicles.documents', $vehicle->id) }}"
                                                       class="btn btn-sm btn-outline-secondary d-flex align-items-center px-2.5">
                                                        <i class="bi bi-file-earmark-arrow-up me-1"></i> Documents
                                                    </a>

                                                    {{-- 2. Bouton Modifier --}}
                                                    <a href="{{ route('admin.vehicles.edit', $vehicle->id) }}"
                                                       class="btn btn-sm btn-outline-primary d-flex align-items-center px-2.5">
                                                        <i class="bi bi-pencil-square me-1"></i> Modifier
                                                    </a>

                                                    {{-- 3. Bouton Supprimer --}}
                                                    <form action="{{ route('admin.vehicles.destroy', $vehicle->id) }}"
                                                          method="POST" onsubmit="return confirm('Supprimer ce véhicule ?');" class="m-0">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger d-flex align-items-center px-2.5">
                                                            <i class="bi bi-trash3-fill me-1"></i> Supprimer
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-5 text-muted">
                                                <i class="bi bi-car-front d-block display-6 mb-3 text-secondary"></i>
                                                Aucun véhicule n'est enregistré dans la base de données.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Pagination --}}
                    @if($vehicles->hasPages())
                        <div class="card-footer bg-white d-flex justify-content-center py-3 border-top">
                            {{ $vehicles->links() }}
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>