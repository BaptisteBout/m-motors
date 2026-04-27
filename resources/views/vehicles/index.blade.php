<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue M-Motors</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="container mx-auto py-10">
        <h1 class="text-3xl font-bold text-center mb-8 text-blue-900">Catalogue M-Motors</h1>

        <div class="flex justify-center space-x-4 mb-10">
            <a href="{{ route('vehicles.index') }}"
                class="px-6 py-2 bg-gray-500 text-white rounded-full hover:bg-gray-600 transition">Tous</a>
            <a href="{{ route('vehicles.index', ['type' => 'achat']) }}"
                class="px-6 py-2 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition">Achat</a>
            <a href="{{ route('vehicles.index', ['type' => 'location']) }}"
                class="px-6 py-2 bg-green-600 text-white rounded-full hover:bg-green-700 transition">Location</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($vehicles as $vehicle)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <h2 class="text-xl font-bold">{{ $vehicle->brand }} {{ $vehicle->model }}</h2>
                            <span
                                class="px-3 py-1 text-xs font-semibold rounded-full {{ $vehicle->is_new ? 'bg-blue-100 text-blue-800' : 'bg-orange-100 text-orange-800' }}">
                                {{ $vehicle->is_new ? 'Neuf' : 'Occasion' }}
                            </span>
                        </div>

                        <p class="text-gray-600 mb-4 text-sm">VIN: {{ $vehicle->vin }}</p>

                        <div class="border-t pt-4">
                            @if($vehicle->acquisition_type == 'achat' || $vehicle->acquisition_type == 'both')
                                <div class="flex justify-between mb-2">
                                    <span class="text-gray-500">Prix d'achat</span>
                                    <span
                                        class="font-bold text-blue-600">{{ number_format($vehicle->price_purchase, 0, ',', ' ') }}
                                        €</span>
                                </div>
                            @endif

                            @if($vehicle->acquisition_type == 'location' || $vehicle->acquisition_type == 'both')
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Loyer mensuel</span>
                                    <span class="font-bold text-green-600">{{ $vehicle->price_rental_monthly }} € / mois</span>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="bg-gray-50 p-4 border-t">
                        <a href="{{ route('application.create', $vehicle->id) }}"
                            class="block text-center w-full bg-blue-900 text-white py-2 rounded-lg font-semibold hover:bg-blue-800 transition">
                            Déposer un dossier
                        </a>
                    </div>
                </div>
            @empty
                <p class="col-span-3 text-center text-gray-500">Aucun véhicule disponible pour ce critère.</p>
            @endforelse
        </div>
    </div>

</body>

</html>