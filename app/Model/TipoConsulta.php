<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TipoConsulta extends Model
{
    public $timestamps = false;
    protected $table = "tipoconsulta";
    protected $fillable = array('tpc_nome', 'tpc_excluido');
}
