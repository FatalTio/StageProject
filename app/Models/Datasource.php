<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Datasource extends Model
{

    private $name;

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function collections()
    {
        return $this->belongsTo('App\Models\Collection');
    }

}