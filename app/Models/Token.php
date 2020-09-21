<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{

    private $contract;

    private $name;

    private $chain;
    
    private $quantity;

    private $adapted_quantity;

    private $asset_image;

    private $asset_id;


    public function collection()
    {
        return $this->hasMany('App\Models\Collection');
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


    public function getContract()
    {
        return $this->contract;
    }

    public function setContract($contract)
    {
        $this->contract = $contract;
        return $this;
    }


    public function getChain()
    {
        return $this->chain;
    }

    public function setChain($chain)
    {
        $this->chain = $chain;
        return $this;
    }


    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }


    public function getAdaptedQuantity()
    {
        return $this->adapted_quantity;
    }

    public function setAdaptedQuantity($adapted_quantity)
    {
        $this->adapted_quantity = $adapted_quantity;
        return $this;
    }


    public function getAssetImage()
    {
        return $this->asset_image;
    }

    public function setAssetImage($asset_image)
    {
        $this->asset_image = $asset_image;
        return $this;
    }

    
    public function getAssetId()
    {
        return $this->asset_id;
    }

    public function setAssetId($asset_id)
    {
        $this->asset_id = $asset_id;
        return $this;
    }
}