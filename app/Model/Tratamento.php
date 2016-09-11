<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Tratamento extends Model
{
    protected $table = "tratamento";
    protected $fillable = array('tra_bovino', 'tra_inicio', 'tra_tipo', 'tra_descricao', 'tra_idtra', 'tra_excluido', 'tra_fim', 'tra_status');
    public $timestamps = false;

    public function Medicamentos()
    {
    	return $this->belongsToMany('App\Model\Medicamento');
    }

    public function Acompanhamentos()
    {
    	return $this->hasMany('App\Model\Tratamento', 'tra_idtra');
    }

    public function TratamentoPrincipal()
    {
    	return $this->belongsTo('App\Model\Tratamento', 'tra_idtra');
    }

    public function Tipo()
    {
    	return $this->belongsTo('App\Model\TipoConsulta', 'tra_tipo');
    }

    public function StatusTratamento()
    {
    	return $this->belongsTo('App\Model\Status', 'tra_status');
    }

    public function Participante()
    {
        return $this->belongsTo('App\Model\Bovino', 'con_bovino');
    }

    public static function Salvar($dados)
    {
        DB::beginTransaction(); //Start transaction!

        try
        {
            $consulta = new Tratamento();
            $consulta->tra_descricao = $dados['tra_descricao'];
            $consulta->tra_bovino = $dados['tra_bovino'];
            $consulta->tra_tipo = $dados['tra_tipo'];
            $consulta->tra_inicio = $dados['tra_inicio'];
            $consulta->tra_status = $dados['tra_status'];
            if(isset($dados['tra_fim']) && $dados['tra_fim'] != '0000-00-00')
                $consulta->tra_fim = $dados['tra_fim'];
            $consulta->save();

            if(isset($dados['medicamentos'])) {
                $meds = $dados['medicamentos'];
                if(!empty($meds)) {
                    $count = sizeof($meds);
                    for($i = 0; $i < $count; $i++)
                    {
                        $consulta->medicamentos()->attach($consulta->id, array('medicamento_id' => $meds[$i]));
                    }
                }
            }
                   
        }
        catch(\Exception $e)
        {
           DB::rollback();
           throw $e;
        }
        DB::commit();
    }

    public static function BuscarTratamento($id)
    {
        $consulta = self::with(['Tipo' => function($query){
            $query->select('tpc_nome', 'id');
        }, 'Participante' => function($query){
            $query->select('bov_nome', 'id');
        }, 'Medicamentos' => function($query){
            $query->select('med_nome', 'id');
        }, 'StatusTratamento' => function($query){
            $query->select('sts_nome', 'id');
        }])->findOrFail(1);
        return $consulta;
    }

    public static function ListarPorBovino($id)
    {
        $consulta = self::with(['StatusTratamento' => function($query) {
            $query->select('sts_nome', 'id');
        }, 'Tipo' => function($query){
            $query->select('tpc_nome', 'id');
        }])
        ->where('tra_bovino', '=', $id)
        ->where('tra_excluido', '=', '0')
        ->orderBy('tra_inicio', 'DESC')->get();
        
        return $consulta;
    }
}
