<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Top extends Model
{
    use HasFactory;
    protected $guarded;

    public function chennel()
    {
        return $this->belongsTo('App\Models\Chennels', 'chennel', 'chennel_id');
    }
    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function bank()
    {
        return $this->belongsTo('App\Models\Banks', 'bank', 'bank_code');
    }

}
