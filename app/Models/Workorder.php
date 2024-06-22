<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Workorder extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    
    protected $fillable = ['workorder_no', 'failure_cause', 'workorder_type','priority',
    'before_efficiency','status','approval_stas','approve_stats_by','workshop_id','assetitem_id' ,'user_id','company_id'];


    public function assetitem()
    {
        return $this->belongsTo(Assetitem::class);
    }

    
    public function workshop()
    {
        return $this->belongsTo(Workshop::class);
    }


    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
    public function wooperation()
    {
        return $this->hasMany(Wooperation::class);
    }

    public function womaterial()
    {
        return $this->hasMany(Womaterial::class);
    }

}
