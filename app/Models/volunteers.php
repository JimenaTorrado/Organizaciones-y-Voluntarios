<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable(['name', 'lastName', 'phone', 'email', 'city', 'birth_date'])]
#[Hidden(['status', 'registered_by'])]

class volunteers extends Model
{
     use HasFactory;
    protected $table = 'volunteers';
    protected $primaryKey = 'id';
    public function organization_volunteer (): HasMany{
        return $this->hasMany(organization_volunteer::class,'volunteers_id' );
    }
}