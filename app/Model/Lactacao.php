<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Lactacao extends Model
{
    public $timestamps = false;
    protected $table = "lactacao";

    protected $fillable = array('lac_data', 'lac_bovino', 'lac_quantidade', 'lac_qualidade');

    public function Bovino()
    {
    	return $this->belongsTo('App\Model\Bovino', 'lac_bovino');
    }

    public static function SalvarTabela($dados)
    {
    	DB::beginTransaction();
    	try
    	{
    		$count = sizeof($dados['bovinos']);
    		$bovinos = $dados['bovinos'];
    		$datas = $dados['datas'];
    		$quantidades = $dados['quantidades'];

    		for($i = 0; $i < $count; $i++)
            {
            	if((isset($bovinos[$i]) && $bovinos[$i] != 0 && $bovinos[$i] != null ) && (isset($datas[$i]) && $datas[$i] != null ) && (isset($quantidades[$i])  && $quantidades[$i] != 0 && $quantidades[$i] != null )) {
            		$sec = Secagem::where('sec_bovino', '=', $bovinos[$i])->where('sec_status', '!=', '2')->first();
            		if(isset($sec) && $sec != null)
            			continue;
            		$old = self::where('lac_bovino', '=', $bovinos[$i])->where('lac_data', '=', $datas[$i])->first();
            		if(isset($old) && $old != null) {
            			$qt = $old->lac_quantidade;
            			$qt += $quantidades[$i];
            			$old->lac_quantidade = $qt;
            			$old->save();
            		} else {
            			$lac = new Lactacao();
		        		$lac->lac_data = $datas[$i];
		        		$lac->lac_bovino = $bovinos[$i];
		        		$lac->lac_quantidade = $quantidades[$i];
		        		$lac->save();
            		}            		
            	}
            }
            DB::commit();
    	}
    	catch(\Exception $e)
    	{
    		DB::rollBack();
    		throw $e;    		
    	}
    }
}
