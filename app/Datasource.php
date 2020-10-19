<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Datasource extends Model
{
    protected $fillable = [
        'name',
        'datasource_net_id'
    ];

}
