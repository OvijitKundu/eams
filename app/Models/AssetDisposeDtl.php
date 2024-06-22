<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetDisposeDtl extends Model
{
    use HasFactory;
    
    // Specify the table name if it's not the plural form of the model name
    protected $table = 'asset_dispose_dtls';

    // Specify the fillable fields
    protected $fillable = [
        'asset_dispose_mst_id',
        'assetitem_id',
        'remarks',
        'user_id',
        'updated_by',
    ];

    // Define the relationship to the master table
    public function assetDisposeMst()
    {
        return $this->belongsTo(AssetDisposeMst::class, 'asset_dispose_mst_id');
    }

    // Define the relationship to the assetitems model table
    public function assetitemModel()
    {
        return $this->belongsTo(Assetitem::class, 'assetitem_id');
    }
    
    // Define the relationship to the user table
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
