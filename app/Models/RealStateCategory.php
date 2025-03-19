<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RealStateCategory extends Model
{
    use HasFactory;


    protected     $table = 'real_state_categories';

    
     public function real_state(){
        return $this->belongsTo(RealState::class);
     }

}
