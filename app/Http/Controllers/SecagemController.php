<?php

namespace App\Http\Controllers;

use Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Response;
use App\Model\Secagem;

class SecagemController extends Controller
{
    public function Registrar() 
    {
    	$data = Request::all();
    	try
    	{
    		Secagem::RegistrarNovo($data);
    		return Response::json("sucesso"); 
    	}
    	catch(\Exception $e)
		{
			return Response::json($e->getMessage());
		}
    }

    public function ListarPorBovino()
    {
    	$params = Request::all();
        $secagens = Secagem::ListarPorBovino($params['id']);
        return Response::json($secagens);    	
    }
}
