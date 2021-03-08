<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Thana extends Model
{

    protected $fillable = ['name', 'bn_name', 'district_id'];

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function post_offices()
    {
        return $this->hasMany(PostOffice::class, 'thana_id');
    }

    public function unions()
    {
        return $this->hasMany(Union::class, 'thana_id');
    }
}
