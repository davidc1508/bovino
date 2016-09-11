<?php

namespace App\Http\Controllers;

use Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Response;
use App\Model\Bovino;
use App\Model\Reprodutor;
use App\Model\Grupo;
use App\Model\Medicamento;
use App\Model\Fornecedor;
use App\Model\TipoEvento;
use App\Model\TipoConsulta;
use App\Model\Status;

class AjaxController extends Controller
{
    public function NomeMatriz()
    {
    	$params = Request::all();
    	$bov = Bovino::where('bov_codigo', '=', $params['data'])->get();    	
    	if(!$bov->isEmpty())
    		return Response::json($bov);
    	else
    		return Response::json("nenhum");
    }

    public function BuscarMatriz()
    {
    	$params = Request::all();
    	$bovinos = Bovino::where('bov_nome', 'LIKE', '%'.$params['data'].'%')->get();
    	return Response::json($bovinos);
    }

    public function NomeReprodutor()
    {
        $params = Request::all();
        $rep = Reprodutor::where('rep_codigo', '=', $params['data'])->get();
        if(!$rep->isEmpty())
            return Response::json($rep);
        else
            return Response::json("nenhum");
    }

    public function BuscarReprodutor()
    {
        $params = Request::all();
        $reprodutores = Reprodutor::where('rep_nome', 'LIKE', '%'.$params['data'].'%')->get();
        return Response::json($reprodutores);
    }

    public function ComboGrupo()
    {
        $grupos = Grupo::all();
        return Response::json($grupos);
    }

    public function ComboTipoEvento()
    {
        $tipo = TipoEvento::all();
        return Response::json($tipo);
    }

    public function ComboTipoConsulta()
    {
        $tipo = TipoConsulta::all();
        return Response::json($tipo);
    }

    public function ComboStatus()
    {
        $status = Status::all();
        return Response::json($status);
    }

    public function ValidarCodMedicamento()
    {
        $params = Request::all();
        $med = Medicamento::where('med_codigo', '=', $params['data'])->get();
        if($med->isEmpty())
            return Response::json("nenhum");
        else
            return Response::json($med);
    }

    public function ValidarCnpj()
    {
        $params = Request::all();
        $forn = Fornecedor::where('for_cnpj', '=', $params['data'])->get();
        if($forn->isEmpty())
            return Response::json("");
        else
            return Response::json("Cadastrado");
    }

    public function Select2Bovino()
    {
        $params = Request::all();
        $bovs = Bovino::where('bov_nome', 'like', '%'.$params['termo'].'%')->orWhere('bov_codigo', 'like', '%'.$params['termo'].'%')->get();
        return Response::json($bovs);
    }

    public function Bovino()
    {
        $params = Request::all();
        $bovino = Bovino::findOrFail($params['id']);
        return Response::json($bovino);
    }

    public function Select2Medicamento()
    {
        $params = Request::all();
        $meds = Medicamento::where('med_nome', 'like', '%'.$params['termo'].'%')->get();
        return Response::json($meds);
    }

    public function Medicamento()
    {
        $params = Request::all();
        $medicamento = Medicamento::findOrFail($params['id']);
        return Response::json($medicamento);
    }
}
