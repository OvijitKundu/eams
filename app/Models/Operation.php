<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Operation extends Model
{
    use HasFactory;


    protected $fillable = ['operation_name', 'description'];

    public function user()
    {
        return $this->belongsTo(Operation::class);
    }
}
