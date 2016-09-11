<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    protected $table = "medicamento";
    public $timestamps = false;
    protected $fillable = array('med_codigo', 'med_nome', 'med_descricao', 'med_excluido');

    public function MedicamentoConsulta()
    {
    	return $this->belongsToMany('App/Model/Consulta');
    }

    public function MedicamentoTratamento()
    {
    	return $this->belongsToMany('App/Model/Tratamento');
    }
}
