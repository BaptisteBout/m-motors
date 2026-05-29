<x-app-layout>
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">📁 Demandes & Justificatifs Clients</h1>
        </div>

        <div class="card shadow-sm border-0 radius-10">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover mb-0 align-middle">
                        <thead class="table-light text-secondary border-bottom">
                            <tr>
                                <th class="ps-4 py-3 text-uppercase small fw-bold" style="font-size: 0.8rem;">ID Demande</th>
                                <th class="py-3 text-uppercase small fw-bold" style="font-size: 0.8rem;">Véhicule</th>
                                <th class="py-3 text-uppercase small fw-bold" style="font-size: 0.8rem;">Type de Document</th>
                                <th class="py-3 text-uppercase small fw-bold" style="font-size: 0.8rem;">Nom du Fichier d'Origine</th>
                                <th class="py-3 text-uppercase small fw-bold" style="font-size: 0.8rem;">Date de Réception</th>
                                <th class="text-end pe-4 py-3 text-uppercase small fw-bold" style="font-size: 0.8rem;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($documents as $document)
                                <tr>
                                    <td class="ps-4 fw-bold text-dark">#{{ $document->application_id }}</td>
                                    <td>
                                        @if($document->vehicle)
                                            <span class="fw-bold text-primary">{{ $document->vehicle->brand }}</span> 
                                            <span class="text-secondary">{{ $document->vehicle->model }}</span>
                                        @else
                                            <span class="text-muted small">Aucun véhicule</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary text-white px-2.5 py-1.5 text-uppercase" style="font-size: 0.7rem;">
                                            {{ str_replace('_', ' ', $document->document_type) }}
                                        </span>
                                    </td>
                                    <td class="text-secondary fw-medium text-truncate" style="max-width: 250px;">
                                        {{ $document->original_filename }}
                                    </td>
                                    <td class="text-muted small">
                                        {{ $document->created_at->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="text-end pe-4">
                                        <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank" class="btn btn-sm btn-success px-3">
                                            <i class="bi bi-eye-fill me-1"></i> Voir le justificatif
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="bi bi-folder-x d-block display-6 mb-3 text-secondary"></i>
                                        Aucun justificatif ou demande reçu pour le moment.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>