<?php

namespace App\Http\Controllers;

use Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Response;
use App\Model\Evento;
use Auth;

class EventoController extends Controller
{
    public function Index()
    {
    	return view('Evento/index');
    }

    public function Registrar()
    {
    	$params = Request::all();
    	try
    	{
    		Evento::Salvar($params, Auth::user()->id);
    		return Response::json('sucesso');
    	}
    	catch(\Exception $e)
    	{
    		//dd($e);
    		return Response::json($e);
    	}
    }

    public function Listar()
    {
    	try
    	{
    		$dados = Evento::MontarCalendario();
    		return Response::json($dados);
    	}
    	catch(\Exception $e)
    	{
    		return Response::json("error");
    	}
    }

    public function Atualizar()
    {
    	$params = Request::all();
    	try
    	{
    		if(Evento::AtualizarEvento($params))
    			return Response::json("success");
    		else
    			return Response::json("error");
    	}
    	catch (\Exception $e)
    	{
    		return Response::json($e);
    	}
    }

    public function Carregar()
    {
    	$params = Request::all();
    	$evento = Evento::BuscarEvento($params['id']);
    	return Response::json($evento);
    }
}
