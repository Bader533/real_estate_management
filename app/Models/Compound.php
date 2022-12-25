<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compound extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'city',
        'address',
        'property_owner_id',
    ];


    public function propertyOwner()
    {
        return $this->belongsTo(PropertyOwner::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'object', 'object_type', 'object_id', 'id');
    }

    public function buildings()
    {
        return $this->hasMany(Building::class);
    }

    public function apartments()
    {
        return $this->hasMany(Apartment::class);
    }

    // public function tenants()
    // {
    //     return $this->hasMany(Tenant::class);
    // }
}
