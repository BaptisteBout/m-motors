<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Application;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Les attributs qui peuvent être remplis massivement (Mass Assignment).
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * Les attributs cachés (pour la sécurité lors des exports API).
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Relation : Un utilisateur peut déposer plusieurs dossiers.
     * Indispensable pour l'espace client "Suivi de dossier".
     */
    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }

    /**
     * Helper : Vérifier si l'utilisateur est un employé.
     */
    public function isEmployee(): bool
    {
        return in_array($this->role, ['employee', 'admin']);
    }
}