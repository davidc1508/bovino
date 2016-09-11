<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public $timestamps = false;
    protected $table = 'Status';
    protected $fillable = array('sts_nome', 'sts_excluido');
}
