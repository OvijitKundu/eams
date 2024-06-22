<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Maintenanceschdule extends Model
{
    use HasFactory;

    public function workshop()
    {
        return $this->belongsTo(Workshop::class);
    }
    public function assetitem()
    {
        return $this->belongsTo(Assetitem::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
