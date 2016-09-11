<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    public $timestamps = false;
    protected $table = 'evento';

    protected $fillable = array('eve_data', 'eve_inicio', 'eve_fim', 'eve_cor', 'eve_titulo', 'eve_descricao', 'eve_excluido', 'eve_autor', 'eve_tipo');

    public function AutorEvento()
    {
    	return $this->belongsTo('App\Model\Usuario', 'eve_autor');
    }

    public function TipoEvento()
    {
    	return $this->belongsTo('App\Model\TipoEvento', 'eve_tipo');
    }

    public static function ListarEventos()
    {
        $eventos = self::with([
            'AutorEvento' => function($query) {
                $query->select('usr_nome', 'id');
            },
            'TipoEvento' => function($query) {
                $query->select('tpe_nome', 'id');
            }
            ])->get();
        return $eventos;
    }

    public static function Salvar($data, $autor)
    {
        $eve = new Evento();
        $eve->eve_data      = $data['eve_data'];
        $eve->eve_inicio    = $data['eve_inicio'];
        $eve->eve_fim       = $data['eve_fim'];
        $eve->eve_cor       = $data['eve_cor'];
        $eve->eve_titulo    = $data['eve_titulo'];
        $eve->eve_descricao = $data['eve_descricao'];
        $eve->eve_tipo      = $data['eve_tipo'];
        $aut = Usuario::findOrFail($autor);
        $eve->AutorEvento()->associate($aut);
        $eve->save();
    }

    public static function MontarCalendario()
    {
        $result = self::where('eve_excluido', '=', '0')->get()->all();
        $eventos = array();
        foreach($result as $evento):
            $e = array();
            $e['start']      = $evento->eve_data.' '.$evento->eve_inicio;
            $e['end']        = $evento->eve_data.' '.$evento->eve_fim;
            $e['allDay']     = false;
            $e['id']         = $evento->id;
            $e['title']      = $evento->eve_titulo;
            $e['color'] = $evento->eve_cor;
            array_push($eventos, $e);
        endforeach;
        return $eventos;
    }

    public static function AtualizarEvento($dados)
    {
        $evento = self::findOrFail($dados['id']);
        if($evento == null)
            throw new Exception("Error Processing Request", 1);
        $evento->update($dados);
        return true;
    }

    public static function BuscarEvento($id)
    {
        $evento = self::with(['TipoEvento' => function($query) {
            $query->select('tpe_nome', 'id');
        }, 'AutorEvento' => function($query) {
            $query->select('usr_nome', 'id');
        }
        ])->findOrFail($id);
        return $evento;
    }
}
