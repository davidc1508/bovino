<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Debugbar;
use App\Http\Requests;
use App\Model\Raca;
use App\Model\Bovino;
use App\Model\Usuario;
use App\Model\Medicamento;
use App\Model\Consulta;
use App\Model\Evento;
use Auth;

class TestController extends Controller
{
    public function Test() { 
    	$params = array(
    			'eve_data' => '2016-06-07',
    			'eve_inicio' => '07:00',
    			'eve_fim' => '08:00',
    			'eve_titulo' => 'Teste',
    			'eve_descricao' => 'ifhaoifuaioufioafuiae',
    			'eve_tipo' => '1',
    			'eve_cor' => '#000000'
    		);
    	try
    	{
    		//Evento::Salvar($params, Auth::user()->id);
            $med = Evento::MontarCalendario();
    	}
    	catch(\Exception $e)
    	{
    		dd($e);
    	}
    	
    	//$med = Evento::ListarEventos();
        echo json_encode($med);    	
    	Debugbar::info($med);
		Debugbar::error('Error!');
		Debugbar::warning('Watch out…');
		Debugbar::addMessage('Another message', 'mylabel');
    	die();
    }
}