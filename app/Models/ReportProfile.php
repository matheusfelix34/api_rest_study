<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportProfile extends Model
{
    use HasFactory;

    protected $table = 'reports_profiles';
    protected $primaryKey = 'id';
    protected $fillable = ['report_id','profile_id'];
    public $timestamps = true;

    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
