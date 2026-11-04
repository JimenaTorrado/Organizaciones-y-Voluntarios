<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
#[Fillable(['organization_id', 'volunteer_id','join_date','role','status','timestamps','registered_by'])]
#[Hidden(['registered_by'])]

class organization_volunteer extends Model
{
       use HasFactory;
    protected $table = 'organization_volunteer';
    protected $primaryKey = 'id'; 
    public function organization(){    
    return $this->belonsTo(organization::class);
    }
     public function volunteer(){    
    return $this->belonsTo(volunteer::class);
    }

}
