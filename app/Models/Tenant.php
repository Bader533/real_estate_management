<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    public function propertyOwner()
    {
        return $this->belongsTo(PropertyOwner::class);
    }

    public function contract()
    {
        return $this->hasOne(Contract::class);
    }

    public function tenantInfos()
    {
        return $this->hasMany(TenantInfo::class);
    }
}
