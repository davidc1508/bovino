<?php

namespace App\Http\Controllers;

use Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Response;
use App\Model\Tratamento;
use Auth;

class TratamentoController extends Controller
{
    public function Novo()
    {
    	$params = Request::all();
    	try
    	{
    		Tratamento::Salvar($params);
    		return Response::json("sucesso");
    	}
    	catch(\Exception $e)
		{
			//return view('Erro/Erro');
			return Response::json($e);
		}
    }

    public function ListarPorBovino()
    {
        $params = Request::all();
        $consultas = Tratamento::ListarPorBovino($params['id']);
        return Response::json($consultas);
    }
}
