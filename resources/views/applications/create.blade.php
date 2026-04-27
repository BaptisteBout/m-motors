<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>M-Motors - Déposer un dossier</title>
</head>
<body class="bg-gray-100 p-10">
    <div class="max-w-lg mx-auto bg-white p-8 rounded-xl shadow-md">
        <h1 class="text-2xl font-bold mb-6 text-blue-900">Demande pour {{ $vehicle->brand }} {{ $vehicle->model }}</h1>
        
        <form action="{{ route('application.store', $vehicle->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Justificatif d'identité (PDF, JPG, PNG)</label>
                <input type="file" name="document" class="w-full border p-2 rounded-lg bg-gray-50">
                @error('document') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="w-full bg-green-600 text-white py-3 rounded-lg font-bold hover:bg-green-700 transition">
                Envoyer mon dossier 100% dématérialisé
            </button>
        </form>
    </div>
</body>
</html>