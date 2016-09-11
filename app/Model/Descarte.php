<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Descarte extends Model
{
    public $timestamps = false;

    protected $fillable = array('des_data', 'des_motivo', 'des_bovino');

    public function Bovino()
    {
    	return $this->belongsTo('App\Model\Bovino', 'des_bovino');
    }
}
