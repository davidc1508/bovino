<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Pesagem extends Model
{
    public $timestamps = false;
    protected $table = "pesagem";

    protected $fillable = array('pes_data', 'pes_bovino', 'pes_valor');

    public function Bovino()
    {
    	return $this->belongsTo('App\Model\Bovino', 'pes_bovino');
    }

    public static function RegistrarPesagem($dados)
    {
    	DB::beginTransaction();
    	try
    	{
    		$pesagem = new Pesagem();
    		$pesagem->pes_data = $dados['ins_data'];
    		$pesagem->pes_bovino = $dados['ins_bovino'];
    		$pesagem->pes_valor = $dados['ins_peso'];
    		$pesagem->save();

    		DB::commit();
    	}
    	catch (\Exception $e)
    	{
    		DB::rollBack();
    		throw $e;    		
    	}
    }

    public static function SalvarTabela($dados)
    {
        DB::beginTransaction();
        try
        {
            $count = sizeof($dados['bovinos']);
            $bovinos = $dados['bovinos'];
            $datas = $dados['datas'];
            $pesos = $dados['pesos'];

            for($i = 0; $i < $count; $i++)
            {
                if((isset($bovinos[$i]) && $bovinos[$i] != 0 && $bovinos[$i] != null ) && (isset($datas[$i]) && $datas[$i] != null ) && (isset($pesos[$i])  && $pesos[$i] != 0 && $pesos[$i] != null )) {                    
                        $pes = new Pesagem();
                        $pes->pes_data = $datas[$i];
                        $pes->pes_bovino = $bovinos[$i];
                        $pes->pes_valor = $pesos[$i];
                        $pes->save();
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
