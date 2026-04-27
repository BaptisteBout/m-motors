<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Document extends Model
{
    protected $fillable = ['application_id', 'document_type', 'file_path', 'original_filename'];

    // Relation : Le document appartient à un dossier (Application)
    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class);
    }
}