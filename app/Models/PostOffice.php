<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostOffice extends Model
{

    protected $fillable = ['name', 'bn_name', 'code', 'upazila_id'];

    public function upazila()
    {
        return $this->belongsTo(Upazila::class, 'upazila_id');
    }
}
