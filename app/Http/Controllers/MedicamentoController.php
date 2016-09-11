<?php

namespace App\Http\Controllers;

use Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Response;
use App\Model\Medicamento;

class MedicamentoController extends Controller
{
    public function Index()
    {
    	return view('Medicamento/index');
    }

    public function Listar()
    {
    	$lista = Medicamento::where('med_excluido', '=', 0)->get();
    	return Response::json($lista);
    }

    public function Cadastrar()
    {
    	$params = Request::all();
		Medicamento::create($params);
		return Response::json("sucesso");
    }

    public function Excluir()
    {
    	$params = Request::all();
    	$med = Medicamento::findOrFail($params['id']);
    	$med->med_excluido = true;
    	$med->update();
    	return Response::json("sucesso");
    }
}
