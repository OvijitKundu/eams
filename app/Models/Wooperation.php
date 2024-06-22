<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wooperation extends Model
{
    use HasFactory;
    protected $table = 'wooperations';

    protected $fillable = [ 'workorder_id', 'operation_id','resoulation',
    'member_id','duration','started_at','ended_at'];

    // `workorder_id`, `operation_id`, `resoulation`, `member_id`, `duration`, `started_at`, `ended_at`, `updated_by`, `created_at`, `updated_at`SELECT * FROM `wooperations` WHERE 1

    public function workorder()
    {
        return $this->belongsTo(Workorder::class);
    }
}
