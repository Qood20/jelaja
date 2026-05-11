<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['operator_id', 'name', 'price', 'opening_hours', 'opening_time', 'closing_time', 'description', 'location_maps_url', 'contact_phone', 'image_url', 'social_media', 'most_booked', 'daily_quota'])]
class Destination extends Model
{
    protected function casts(): array
    {
        return [
            'social_media' => 'json',
        ];
    }

    public function getImageUrlAttribute($value)
    {
        if (!$value) return null;
        
        // Jika sudah berupa URL lengkap (Unsplash dll), kembalikan langsung
        if (str_starts_with($value, 'http')) {
            return $value;
        }

        // Pastikan menggunakan asset() untuk domain hosting
        return asset($value);
    }

    public function operator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'operator_id');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function galleries(): HasMany
    {
        return $this->hasMany(DestinationGallery::class);
    }
}
