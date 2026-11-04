<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable(['name', 'description', 'type', 'phone', 'email', 'address', 'city', 'creation_date', 'status'])]
#[Hidden(['status', 'registered_by'])]
class organizations extends Model
{
    use HasFactory;

    protected $table = 'organizations';
    protected $primaryKey = 'id';

}
