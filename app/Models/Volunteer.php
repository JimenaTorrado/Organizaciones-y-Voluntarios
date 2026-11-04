<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['first_name', 'last_name', 'phone', 'email', 'city', 'birth_date', 'image', 'status', 'registered_by'])]
#[Hidden(['status', 'registered_by'])]
class Volunteer extends Model
{
    use HasFactory;

    protected $table = 'volunteers';
    protected $primaryKey = 'id';

    public function membership(): HasMany
    {
        return $this->hasMany(OrganizationVolunteer::class, 'volunteer_id');
    }
}
