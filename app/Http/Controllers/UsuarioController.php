<?php

namespace App\Http\Controllers;

use Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Response;
use App\Model\Usuario;
use App\Model\Grupo;

class UsuarioController extends Controller
{
    public function Index()
    {
    	return view('Usuario/index');
    }

    public function Listar()
    {
    	$usrs = Usuario::with('grupo')->get();
    	return Response::json($usrs);
    }

    public function Cadastrar()
    {
    	$params = Request::all();
    	try
    	{
    		Usuario::Salvar($params);
    		return Response::json('sucesso');
    	}
    	catch(\Exception $e)
    	{
    		dd($e);
    		return Response::json('erro');
    	}
    }
}
