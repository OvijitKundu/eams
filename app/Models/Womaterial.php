<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Womaterial extends Model
{
    use HasFactory;
    protected $fillable = [ 'activities', 'quantity','spartpart_id',
                        'uom_id','company_id','workorder_id','operation_id','user_id'];

    // `quantity`, `required_date`, `activities`, `spartpart_id`, `uom_id`, `company_id`, `workorder_id`, `operation_id`, `user_id`, `updated_by`, `created_at`, `updated_at`

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function workorder()
    {
        return $this->belongsTo(Workorder::class);
    }

   
}
