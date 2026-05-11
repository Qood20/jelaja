<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['destination_id', 'image_url'])]
class DestinationGallery extends Model
{
    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }
}
