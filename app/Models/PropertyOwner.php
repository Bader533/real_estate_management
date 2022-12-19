<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class PropertyOwner extends Authenticatable
{
    use HasFactory, HasRoles;

    public function compounds()
    {
        return $this->hasMany(Compound::class);
    }

    public function buildings()
    {
        return $this->hasMany(Building::class);
    }

    public function apartments()
    {
        return $this->hasMany(Apartment::class);
    }
}
