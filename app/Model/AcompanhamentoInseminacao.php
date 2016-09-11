<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AcompanhamentoInseminacao extends Model
{
    public $timestamps = false;
    protected $fillable = array('aco_inseminacao', 'aco_data', 'aco_status', 'aco_peso', 'aco_observacao');

    public function InseminacaoPrincipal()
    {
    	return $this->belongsTo('App\Model\Inseminacao', 'aco_inseminacao');
    }

    public function Status()
    {
    	return $this->belongsTo('App\Model\Status', 'aco_status');
    }
}
