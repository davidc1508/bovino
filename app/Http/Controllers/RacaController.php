<?php namespace App\Http\Controllers;

use Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Response;
use App\Model\Raca;

class RacaController extends Controller {

	public function Index() {
		return view("/Raca/index");
	}

	public function Cadastrar() {
		$params = Request::all();
		Raca::create($params);
		return Response::json("sucesso");
	}

	public function Lista() {
		$racas = Raca::all()->where('rac_excluido', '=', '0');		
		return Response::json($racas);
	}

	public function Editar() {
		$params = Request::all();
		$raca = Raca::findOrFail($params['id']);
		$raca->update($params);
		return Response::json("sucesso");
	}

	public function Deletar() {
		$params = Request::all();
		$raca = Raca::findOrFail($params['id']);
		$raca->rac_excluido = true;
		$raca->update();
		return Response::json("sucesso");
	}
}

?>