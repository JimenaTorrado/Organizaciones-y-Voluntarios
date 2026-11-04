<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['organization_id', 'volunteer_id', 'join_date', 'role', 'registered_by'])]
#[Hidden(['registered_by'])]
class OrganizationVolunteer extends Model
{
    use HasFactory;

    protected $table = 'organization_volunteer';
    protected $primaryKey = 'id';

    /** Roles permitidos dentro de una organización. */
    public const ROLES = ['Voluntario', 'Coordinador', 'Asistente', 'Administrador'];

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function volunteer(): BelongsTo
    {
        return $this->belongsTo(Volunteer::class);
    }
}
