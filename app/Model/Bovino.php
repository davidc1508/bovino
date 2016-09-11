<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Bovino extends Model
{
    public $timestamps = false;

    protected $fillable = array('bov_codigo', 'bov_nome', 'bov_nascimento', 'bov_sexo', 'bov_pesonascimento', 'bov_descricao','bov_matriz', 'bov_reprodutor', 'bov_excluido');

    public function Matriz() {
    	return $this->belongsTo('App\Model\Bovino', 'bov_matriz');
    }

    public function Reprodutor() {
    	return $this->belongsTo('App\Model\Reprodutor', 'bov_reprodutor');
    }

    public function Parente() {
    	return $this->hasMany('App\Model\Bovino', 'bov_matriz');
    }

    public function Raca()
    {
    	return $this->belongsToMany('App\Model\Raca')->withPivot('mistura');
    }

    public function Descarte()
    {
    	return $this->hasOne('App\Model\Descarte', 'des_bovino');
    }

    public function Inseminacao()
    {
    	return $this->hasMany('App\Model\Inseminacao', 'ins_bovino');
    }

    public function Producao()
    {
    	return $this->hasMany('App\Model\Lactacao', 'lac_bovino');
    }

    public function Evolucao()
    {
    	return $this->hasMany('App\Model\Pesagem', 'pes_bovino');
    }

    public function Secagens()
    {
    	return $this->hasMany('App\Model\Secagem', 'sec_bovino');
    }

    public static function Salvar($params)
    {
    	DB::beginTransaction(); //Start transaction!

		try
		{
			$bovino = new Bovino();
		   	$bovino->bov_codigo = $params['bov_codigo'];
	    	$bovino->bov_nome = $params['bov_nome'];
	    	$bovino->bov_nascimento = $params['bov_nascimento'];
	    	$bovino->bov_sexo = $params['bov_sexo'];
	    	$bovino->bov_descricao = $params['bov_descricao'];
	    	$bovino->bov_pesonascimento = $params['bov_pesonascimento'];
	    	if(!empty($params['bov_matriz']))
	    	{
	    		$matriz = Bovino::where('bov_codigo', '=', $params['bov_matriz'])->firstOrFail();
	    		if($matriz)
	    			$bovino->matriz()->associate($matriz);
	    	}
	    	if(!empty($params['bov_reprodutor']))
	    	{
	    		$reprodutor = Reprodutor::where('rep_codigo', '=', $params['bov_reprodutor'])->firstOrFail();
	    		if($reprodutor)
	    			$bovino->reprodutor()->associate($reprodutor->id);
	    	}
	    	$bovino->save();

	    	$raca = $params['bov_raca'];
	    	$mistura = $params['procedencia'];
	    	$count = sizeof($raca);
	    	for($i = 0; $i < $count; $i++)
	    	{
	    		$bovino->raca()->attach($bovino->id, array('raca_id' => $raca[$i], 'mistura' => $mistura[$i]));
	    	}
	    	
		}
		catch(\Exception $e)
		{
		   DB::rollback();
		   throw $e;
		}
		DB::commit();		    
	}
}