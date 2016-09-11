<?php

namespace App\Http\Controllers;

use Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Response;
use App\Model\Inseminacao;

class InseminacaoController extends Controller
{
    public function Selecionar()
    {
    	return view("Inseminacao/Selecao");
    }

    public function Novo()
    {
    	$data = Request::all();
    	try
    	{
    		Inseminacao::Salvar($data);
    		return Response::json("sucesso"); 
    	}
    	catch(\Exception $e)
		{
			//return view('Erro/Erro');
			return Response::json($e->getMessage());
		}
    }

    public function ListarPorBovino()
    {
        $params = Request::all();
        $inseminacoes = Inseminacao::ListarPorBovino($params['id']);
        return Response::json($inseminacoes);
    }
}
