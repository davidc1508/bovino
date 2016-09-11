<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Usuario extends Model
{
    protected $table = "usuario";
    protected $fillable = array('usr_nome', 'usr_email', 'usr_senha', 'usr_login', 'usr_grupo');
    public $timestamps = false;

    public function Grupo()
    {
    	return $this->belongsTo('App\Model\Grupo', 'usr_grupo');
    }

    public function Eventos()
    {
        return $this->hasMany('App\Model\Evento', 'eve_autor');
    }

    public static function Salvar($params)
    {
    	DB::beginTransaction();
    	try
    	{
    		$usr = new Usuario();
	    	$usr->usr_nome = $params['usr_nome'];
	    	$usr->usr_email = $params['usr_email'];
	    	$usr->usr_senha = bcrypt($params['usr_senha']);
	    	$usr->usr_login = $params['usr_login'];
	    	$grp = Grupo::findOrFail($params['usr_grupo']);
	    	$usr->grupo()->associate($grp);
	    	$usr->save();
    	}
    	catch(\Exception $e)
		{
		   DB::rollback();
		   throw $e;
		}
		DB::commit();    	
    }
}
