<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Reprodutor extends Model
{
   	protected $table = "reprodutor";
   	public $timestamps = false;

   	protected $fillable = array('rep_codigo','rep_nome');

   	public function Raca()
    {
    	return $this->belongsToMany('App\Model\Raca', 'racas_reprodutor')->withPivot('mistura');
    }

    public function Heranca()
    {
    	return $this->hasMany('App\Model\Bovino', 'bov_reprodutor');
    }

    public function Inseminacao()
    {
        return $this->hasMany('App\Model\Inseminacao', 'ins_reprodutor');
    }

    public static function Salvar($params)
    {
    	$rep = new Reprodutor();
    	$rep->rep_nome = $params['rep_nome'];
    	$rep->rep_codigo = $params['rep_codigo'];
    	$rep->save();
    	$raca = $params['bov_raca'];
    	$mistura = $params['procedencia'];
    	$count = sizeof($raca);
    	for($i = 0; $i < $count; $i++)
    	{
    		$rep->raca()->attach($rep->id, array('raca_id' => $raca[$i], 'mistura' => $mistura[$i]));
    	}
    }

}
