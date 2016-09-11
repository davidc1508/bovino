<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Raca extends Model
{
    public $timestamps = false;

    protected $fillable = array('rac_nome');

    public function Bovino()
    {
    	return $this->belongsToMany('App\Model\Bovino')->withPivot('mistura');
    }

    public function Reprodutor()
    {
    	return $this->belongsToMany('App\Model\Reprodutor')->withPivot('mistura');
    }
}
