<?php

namespace App\Http\Controllers;

use Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Response;
use App\Model\Lactacao;

class LactacaoController extends Controller
{
    public function Index()
    {

    }

    public function Novo()
    {
    	return view("/Lactacao/formulario");
    }

    public function Registrar()
    {
    	$data = Request::all();
    	try
    	{
    		Lactacao::SalvarTabela($data);
    		return Response::json("sucesso"); 
    	}
    	catch(\Exception $e)
    	{
    		return Response::json($e->getMessage()); 
    	}
    }
}
