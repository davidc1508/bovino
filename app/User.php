<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class User extends Authenticatable
{
    protected $table = 'usuario';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'usr_nome', 'usr_login', 'usr_senha', 'usr_email', 'usr_grupo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'usr_senha', 'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->usr_senha;
    }

    public function getRememberToken()
    {
        return null; // not supported
    }

    public function setRememberToken($value)
    {
       // not supported
    }

    public function getRememberTokenName()
    {
       return null; // not supported
    }

    public function getId()
    {
        return $this->id;
    }

     /**
      * Overrides the method to ignore the remember token.
      */
    public function setAttribute($key, $value)
    {
       $isRememberTokenAttribute = $key == $this->getRememberTokenName();
       if (!$isRememberTokenAttribute)
       {
         parent::setAttribute($key, $value);
       }
    }

    public function getGrupo()
    {
        $grp = $this->Grupo->select('grp_nome')->first();
        echo $grp->grp_nome;
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

    public function Grupo()
    {
        return $this->belongsTo('App\Model\Grupo', 'usr_grupo');
    }
}
