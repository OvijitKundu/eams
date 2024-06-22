<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AssetDisposeDtl;

class AssetDisposeMst extends Model
{
    use HasFactory;

    // Define the primary key for the model
    protected $primaryKey = 'id';

    // Specify the attributes that are mass assignable
    protected $fillable = [
        'panel_members',
        'approver',
        'status',
        'workshop_id',
        'company_id',
        'user_id',
        'updated_by'
    ];

    // Define relationships with other models

    // A AssetDisposeMaster belongs to a Workshop
    public function workshop()
    {
        return $this->belongsTo(Workshop::class);
    }

    // A AssetDisposeMaster belongs to a Company
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    // A AssetDisposeMaster belongs to a User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasMany(AssetDisposeDtl::class);
    }
}
