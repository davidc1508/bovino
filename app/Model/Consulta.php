<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Consulta extends Model
{
    protected $table = "consulta";
    protected $fillable = array('con_bovino', 'con_usuario', 'con_data', 'con_tipo', 'con_descricao', 'con_idcon', 'con_excluido');
    public $timestamps = false;

    public function Medicamentos()
    {
    	return $this->belongsToMany('App\Model\Medicamento');
    }

    public function Retornos()
    {
    	return $this->hasMany('App\Model\Consulta', 'con_idcon');
    }

    public function ConsultaPrincipal()
    {
    	return $this->belongsTo('App\Model\Consulta', 'con_idcon');
    }

    public function Responsavel()
    {
    	return $this->belongsTo('App\Model\Usuario', 'con_usuario');
    }

    public function Tipo()
    {
    	return $this->belongsTo('App\Model\TipoConsulta', 'con_tipo');
    }

    public function Participante()
    {
        return $this->belongsTo('App\Model\Bovino', 'con_bovino');
    }

    public static function Salvar($dados, $resp)
    {
        DB::beginTransaction(); //Start transaction!

        try
        {
            $consulta = new Consulta();
            $consulta->con_data = $dados['con_data'];
            $consulta->con_descricao = $dados['con_descricao'];
            $consulta->con_bovino = $dados['con_bovino'];
            $consulta->con_tipo = $dados['con_tipo'];
            $aut = Usuario::findOrFail($resp);
            $consulta->Responsavel()->associate($aut);
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

    public static function BuscarConsulta($id)
    {
        $consulta = self::with(['Responsavel' => function($query) {
            $query->select('usr_nome', 'id');
        }, 'Tipo' => function($query){
            $query->select('tpc_nome', 'id');
        }, 'Participante' => function($query){
            $query->select('bov_nome', 'id');
        }, 'Medicamentos' => function($query){
            $query->select('med_nome', 'id');
        }, 'Retornos' => function($query){
            $query->select('con_data', 'id');
        }, 'ConsultaPrincipal' => function($query){
            $query->select('con_data', 'id');
        }])->findOrFail(1);
        return $consulta;
    }

    public static function ListarPorBovino($id)
    {
        $consulta = self::with(['Responsavel' => function($query) {
            $query->select('usr_nome', 'id');
        }, 'Tipo' => function($query){
            $query->select('tpc_nome', 'id');
        }])
        ->where('con_bovino', '=', $id)
        ->where('con_excluido', '=', '0')
        ->orderBy('con_data', 'DESC')->get();
        
        return $consulta;
    }

}
