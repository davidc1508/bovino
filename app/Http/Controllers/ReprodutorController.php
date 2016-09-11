<?php

namespace App\Http\Controllers;

use Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Response;
use App\Model\Raca;
use App\Model\Reprodutor;

class ReprodutorController extends Controller
{
    public function Index()
    {
    	return view("/Reprodutor/index");
    }

    public function Novo()
    {
    	$lista = Raca::all()->where('rac_excluido', '=', '0');
    	return view("/Reprodutor/novo", compact('lista'));
    }

    public function Cadastrar()
    {
    	$params = Request::all();
    	try
    	{
    		Reprodutor::Salvar($params);
    		return redirect()->action('ReprodutorController@Index');
    	}
    	catch(\Exception $e)
    	{
    		dd($e);
    		return view('Erro/Erro');
    	}
    }

    public function Listar()
    {
    	$reps = Reprodutor::all()->where('rep_excluido', '=', '0');
    	return Response::Json($reps);
    }

    public function Excluir()
    {

    }
}
