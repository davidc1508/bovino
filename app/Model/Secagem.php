<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Secagem extends Model
{
    public $timestamps = false;
    protected $table = 'secagem';

    protected $fillable = array('sec_bovino', 'sec_data', 'sec_status', 'sec_fim');

    public function Bovino()
    {
    	return $this->belongsTo('App\Model\Bovino', 'sec_bovino');
    }

    public function Status()
    {
    	return $this->belongsTo('App\Model\Status', 'sec_status');
    }

    public static function AdicionarPorInseminacao($dados)
    {
        DB::beginTransaction();
        try 
        {
            $obj = new Secagem();
            $obj->sec_bovino = $dados['ins_bovino'];
            $obj->sec_data = $dados['ins_data'];
            $obj->sec_status = $dados['sec_status'];
            $obj->save();
            DB::commit();
        }
        catch (\Excetion $e)
        {
            DB::rollback();
            throw $e;            
        }
    }

    public static function RegistrarNovo($dados)
    {
        DB::beginTransaction();
        try 
        {
            $obj = new Secagem();
            $obj->sec_bovino = $dados['sec_bovino'];
            $obj->sec_data = $dados['sec_data'];
            $obj->sec_status = $dados['sec_status'];
            if(isset($dados['sec_fim']) && ($dados['sec_fim'] != null && $dados['sec_fim'] != ''))
                $obj->sec_fim = $dados['sec_fim'];
            $obj->save();
            DB::commit();
        }
        catch (\Excetion $e)
        {
            DB::rollback();
            throw $e;            
        }
    }

    public static function ListarPorBovino($id)
    {
        $secagem = self::with(['Status' => function($query) {
            $query->select('sts_nome', 'id');
        }])
        ->where('sec_bovino', '=', $id)
        ->orderBy('sec_data', 'DESC')->get();
        
        return $secagem;
    }
}
