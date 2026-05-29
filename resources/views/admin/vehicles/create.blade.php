<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold mb-0 text-dark">
            {{ __('Ajouter un nouveau véhicule') }}
        </h2>
    </x-slot>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header bg-white py-3 border-bottom">
                        <h5 class="mb-0 text-dark fw-bold">
                            <i class="bi bi-car-front text-success me-2"></i>Informations du véhicule
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('admin.vehicles.store') }}" method="POST">
                            @csrf

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Marque</label>
                                    <input type="text" name="brand" class="form-control @error('brand') is-invalid @enderror" value="{{ old('brand') }}" required>
                                    @error('brand') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Modèle</label>
                                    <input type="text" name="model" class="form-control @error('model') is-invalid @enderror" value="{{ old('model') }}" required>
                                    @error('model') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Type d'acquisition</label>
                                    <select name="acquisition_type" class="form-select @error('acquisition_type') is-invalid @enderror" required>
                                        <option value="Achat" {{ old('acquisition_type') == 'Achat' ? 'selected' : '' }}>Achat</option>
                                        <option value="Location" {{ old('acquisition_type') == 'Location' ? 'selected' : '' }}>Location</option>
                                    </select>
                                    @error('acquisition_type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Prix d'Achat (€)</label>
                                    <input type="number" step="0.01" name="price_purchase" class="form-control @error('price_purchase') is-invalid @enderror" value="{{ old('price_purchase') }}" required>
                                    @error('price_purchase') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Statut</label>
                                    <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                        <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
                                        <option value="sold" {{ old('status') == 'sold' ? 'selected' : '' }}>Sold</option>
                                    </select>
                                    @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="mt-4 pt-3 border-top d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.vehicles.index') }}" class="btn btn-outline-secondary">Annuler</a>
                                <button type="submit" class="btn btn-success px-4">Enregistrer le véhicule</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>