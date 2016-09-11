<?php

namespace App\Http\Controllers;
use Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Response;
use App\Model\Fornecedor;

class FornecedorController extends Controller
{
    public function Index()
    {
    	return view("Fornecedor/index");
    }

    public function ListarFornecedor()
    {
    	$fornecedores = Fornecedor::where('for_excluido', '=', '0')->get();
    	return Response::json($fornecedores);
    }

    public function Cadastrar()
    {
    	$params = Request::all();
    	Fornecedor::create($params);
    	return Response::json("sucesso");
    }

    public function Editar() {
		$params = Request::all();
		$fornecedor = Fornecedor::findOrFail($params['id']);
		$fornecedor->update($params);
		return Response::json("sucesso");
	}

	public function Excluir() {
		$params = Request::all();
		$fornecedor = Fornecedor::findOrFail($params['id']);
		$fornecedor->for_excluido = true;
		$fornecedor->update();
		return Response::json("sucesso");
	}
}
