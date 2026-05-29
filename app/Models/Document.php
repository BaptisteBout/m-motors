<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Document extends Model
{
    protected $fillable = ['application_id', 'document_type', 'file_path', 'original_filename'];

    // Relation : Le document appartient à un dossier (Application)
    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class);
    }

    public function vehicle(): HasOneThrough
    {
        return $this->hasOneThrough(
            Vehicle::class,
            Application::class,
            'id',  
            'id', 
            'application_id',
            'vehicle_id' 
        );
    }
}