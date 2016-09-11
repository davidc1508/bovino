<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TipoEvento extends Model
{
    public $timestamps = false;
    protected $table = 'tipoevento';

    protected $fillable = array('tpe_nome', 'tpe_excluido');
}
