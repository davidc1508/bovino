<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    protected $table = "fornecedor";
    public $timestamps = false;
    protected $fillable = array('for_cnpj', 'for_fantasia', 'for_razao', 'for_telefone', 'for_email','for_contato','for_descricao','for_excluido');
}
