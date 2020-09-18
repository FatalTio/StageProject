<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{

    private $collectionId;

    private $name;

    private $description;
    
    private $imageUrl;


    public function datasource()
    {
        return $this->hasMany('App\Models\Datasource');
    }


    public function token()
    {
        return $this->belongsTo('App\Models\Token');
    }


    public function getCollectionId()
    {
        return $this->collectionId;
    }

    public function setCollectionId($collectionId)
    {
        $this->collectionId = $collectionId;
        return $this;
    }


    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    
    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    public function setImageUrl($imageUrl)
    {
        $this->imageUrl = $imageUrl;
        return $this;
    }

}