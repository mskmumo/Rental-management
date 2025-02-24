<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'apartment_type_id',
        'bed_type_id',
        'name',
        'description',
        'price_per_night',
        'capacity',
        'status', // available, booked, maintenance
        'featured_image',
        'is_featured',
        'image_path',
        'latitude',
        'longitude',
        'location_description',
        'address'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'price_per_night' => 'decimal:2',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8'
    ];

    public function apartmentType()
    {
        return $this->belongsTo(ApartmentType::class);
    }

    public function bedType()
    {
        return $this->belongsTo(BedType::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function amenities(): BelongsToMany
    {
        return $this->belongsToMany(Amenity::class, 'room_amenity');
    }
} 