<?php

namespace App\Http\Controllers;

use Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Response;
use App\Model\Consulta;
use Auth;

class ConsultaController extends Controller
{
    public function Selecionar()
    {
    	return view("Consulta/Selecao");
    }

    public function Novo()
    {
    	$params = Request::all();
    	try
    	{
    		Consulta::Salvar($params, Auth::user()->id);
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
        $consultas = Consulta::ListarPorBovino($params['id']);
        return Response::json($consultas);
    }
}
