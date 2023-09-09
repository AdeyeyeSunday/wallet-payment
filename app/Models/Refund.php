<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    use HasFactory;
    protected $guarded;

    public function user()
        {
            return $this->belongsTo('App\Models\User', 'upi', 'h_number');
        }
}
