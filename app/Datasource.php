<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Datasource extends Model
{
    protected $fillable = [
        'name'
    ];

    public function blockchain(){

        return $this->belongsTo(Blockchain::class, 'blockchain');
    }
}
