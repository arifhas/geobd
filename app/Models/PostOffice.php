<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostOffice extends Model
{

    protected $fillable = ['name', 'bn_name', 'code', 'thana_id'];

    public function thana()
    {
        return $this->belongsTo(Thana::class, 'thana_id');
    }
}
