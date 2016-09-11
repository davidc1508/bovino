<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Inseminacao extends Model
{
    public $timestamps = false;
    protected $table = "inseminacao";

    protected $fillable = array('ins_data', 'ins_bovino', 'ins_reprodutor', 'ins_status', 'ins_peso', 'ins_observacao');

    public function Bovino()
    {
    	return $this->belongsTo('App\Model\Bovino', 'ins_bovino');
    }

    public function Reprodutor()
    {
    	return $this->belongsTo('App\Model\Reprodutor', 'ins_reprodutor');
    }

    public function Status()
    {
    	return $this->belongsTo('App\Model\Status', 'ins_status');
    }

    public function Evolucao()
    {
    	return $this->hasMany('App\Model\AcompanhamentoInseminacao', 'aco_inseminacao');
    }

    public static function Salvar($data)
    {
        DB::beginTransaction();

        try 
        {
            $inseminacao = new Inseminacao();
            $inseminacao->ins_data = $data['ins_data'];
            $inseminacao->ins_observacao = $data['ins_observacao'];
            $inseminacao->ins_bovino = $data['ins_bovino'];
            $inseminacao->ins_status = $data['ins_status'];
            $inseminacao->ins_reprodutor = $data['ins_reprodutor'];
            $inseminacao->ins_peso = $data['ins_peso'];
            $inseminacao->save();
            DB::commit();
        }
        catch(\Exception $e)
        {
           DB::rollback();
           throw $e;
        }
        if(isset($data['add_sec']) && ($data['add_sec'] === true || $data['add_sec'] === 'true'))
            Secagem::AdicionarPorInseminacao($data);
        if(isset($data['add_pes']) && ($data['add_pes'] === true || $data['add_pes'] === 'true'))
            Pesagem::RegistrarPesagem($data);
    }

    public static function ListarPorBovino($id)
    {
        $inseminacao = self::with(['Status' => function($query){
            $query->select('sts_nome', 'id');
        }])
        ->where('ins_bovino', '=', $id)
        ->orderBy('ins_data', 'DESC')->get();
        
        return $inseminacao;
    }
}
