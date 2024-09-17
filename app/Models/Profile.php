<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $primarykey= 'id';
    protected $table ='profiles';
    protected $fillable = ['first_name','last_name','dob','gender'];

}
