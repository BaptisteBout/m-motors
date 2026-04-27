<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Application extends Model
{
    protected $fillable = ['user_id', 'vehicle_id', 'type', 'status'];

    // Relation : Le dossier appartient à un utilisateur
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relation : Le dossier concerne un véhicule spécifique
    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    // Relation : Un dossier contient plusieurs documents (ID, Paie, etc.)
    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }
}