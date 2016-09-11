<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class SelecionarController extends Controller
{
    public function Index($acao)
    {
    	return view('Selecionar/Select', ['acao' => $acao]);
    }
}
