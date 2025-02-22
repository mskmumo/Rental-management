<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'gallery';

    protected $fillable = [
        'image_path',
        'title',
        'description',
        'is_featured'
    ];

    protected $casts = [
        'is_featured' => 'boolean'
    ];

    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image_path);
    }
}