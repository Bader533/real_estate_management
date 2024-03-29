<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use HasFactory;

    public function propertyOwner()
    {
        return $this->belongsTo(PropertyOwner::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'object', 'object_type', 'object_id', 'id');
    }

    public function compound()
    {
        return $this->belongsTo(Compound::class);
    }

    public function apartments()
    {
        return $this->hasMany(Apartment::class);
    }
}
