<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    protected $table = "grupo";
    public $timestamps = false;
    protected $fillable = array('grp_nome');

    public function Usuarios()
    {
    	return $this->hasMany('App\Model\Usuario', 'grp_id');
    }
}
