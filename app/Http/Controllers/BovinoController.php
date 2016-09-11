<?php

namespace App\Http\Controllers;

use Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Response;
use App\Model\Bovino;
use App\Model\Raca;

class BovinoController extends Controller
{
    public function Index() {
    	return view("/Bovino/index");
    }

    public function Novo() {
    	$lista = Raca::all()->where('rac_excluido', '=', '0');
    	return view("/Bovino/novo", compact('lista'));
    }

    public function Cadastrar()
    {
    	$params = Request::all();
    	try
    	{
    		Bovino::Salvar($params);
    		return redirect()->action('BovinoController@Index');
    	}
    	catch(\Exception $e)
		{
            dd($e);
			return view('Erro/Erro');
		}
    }

    public function Listar()
    {
    	$bovinos = Bovino::where('bov_excluido', '=', '0')->get();		
		return Response::json($bovinos);
    }

    public function InfoBovino() 
    {
    	$params = Request::all();
    	$bov = Bovino::with('raca', 'matriz', 'reprodutor')->findOrFail($params['data']);
    	if($bov)
    		return Response::json($bov);
    	else
    		return "error";
    }

    public function Excluir()
    {
    	$params = Request::all();
    	$bov = Bovino::findOrFail($params['id']);
    	$bov->bov_excluido = true;
    	$bov->update();
    	return Response::json("sucesso");
    }
}
