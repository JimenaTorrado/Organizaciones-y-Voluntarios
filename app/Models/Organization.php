<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'description', 'type', 'phone', 'email', 'address', 'city', 'creation_date', 'status', 'registered_by'])]
#[Hidden(['status', 'registered_by'])]
class Organization extends Model
{
    use HasFactory;

    protected $table = 'organizations';
    protected $primaryKey = 'id';

    public function membership(): HasMany
    {
        return $this->hasMany(OrganizationVolunteer::class, 'organization_id');
    }

    public function volunteers(): BelongsToMany
    {
        return $this->belongsToMany(Volunteer::class)
            ->withPivot('join_date', 'role', 'registered_by')
            ->withTimestamps();
    }
}
