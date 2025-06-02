<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chalet extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'owner_id', 'price_per_day', 'address', 'description', 'discount', 'status',
        'bedrooms', 'bathrooms', 'wifi', 'pool', 'air_conditioners', 'parking_spaces',
        'area', 'barbecue', 'view', 'kitchen', 'kids_play_area', 'pets_allowed'
    ];

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
    protected static function boot()
    {
        parent::boot();

        static::deleting(function($chalet) {
            if ($chalet->isForceDeleting()) {
                // Permanently delete related records
                $chalet->images()->forceDelete();
                $chalet->reviews()->forceDelete();
                $chalet->bookings()->forceDelete();
            }
        });
    }
}