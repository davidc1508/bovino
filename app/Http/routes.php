<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'IndexController@Index');

Route::group(['prefix' => '/'], function(){
	Route::get('index', ['as' => 'index', 'uses' => 'IndexController@Index']);
});

Route::group(['prefix' => 'raca'], function() {
	Route::get('/', ['as' => 'raca', 'uses' => 'RacaController@Index']);
	Route::get('listar', ['as' => 'listarRaca', 'uses' => 'RacaController@Lista']);
	Route::post('cadastrar', ['as' => 'cadastrar', 'uses' => 'RacaController@Cadastrar']);	
	Route::post('editar', ['as' => 'editar', 'uses' => 'RacaController@Editar']);
	Route::post('excluir', ['as' => 'excluir', 'uses' => 'RacaController@Deletar']);
});

Route::group(['prefix' => 'bovino'], function() {
	Route::get('/',['as' => 'bovino', 'uses' => 'BovinoController@Index']);
	Route::get('novo', ['as' => 'novoBov', 'uses' => 'BovinoController@Novo']);
	Route::post('cadastrar', ['as' => 'cadastrar', 'uses' => 'BovinoController@Cadastrar']);
	Route::get('listar', ['as' => 'listar', 'uses' => 'BovinoController@Listar']);
	Route::post('excluir', ['as' => 'excluir', 'uses' => 'BovinoController@Excluir']);
	Route::get('perfilBovino', ['as' => 'perfil', 'uses' => 'BovinoController@Perfil']);
});

Route::group(['prefix' => 'reprodutor'], function() {
	Route::get('/', ['as' => 'reprodutor', 'uses' => 'ReprodutorController@Index']);
	Route::get('novo', ['as' => 'novoRep', 'uses' => 'ReprodutorController@Novo']);
	Route::get('listar', ['as' => 'listar', 'uses' => 'ReprodutorController@Listar']);
	Route::post('cadastrar', ['as' => 'cadrep', 'uses' => 'ReprodutorController@Cadastrar']);
});

Route::group(['prefix' => 'Ajax'], function () {
	Route::post('NomeMatriz', 'AjaxController@NomeMatriz');
	Route::post('BuscarMatriz', 'AjaxController@BuscarMatriz');
	Route::post('InfoBovino', 'BovinoController@InfoBovino');
	Route::post('NomeReprodutor', 'AjaxController@NomeReprodutor');	
	Route::post('BuscarReprodutor', 'AjaxController@BuscarReprodutor');
	Route::get('ComboUsr', 'AjaxController@ComboGrupo');
	Route::post('ValidarMed', 'AjaxController@ValidarCodMedicamento');
	Route::post('ValidarCnpj', 'AjaxController@ValidarCnpj');
	Route::get('ComboTpe', 'AjaxController@ComboTipoEvento');
	Route::get('ComboTpc', 'AjaxController@ComboTipoConsulta');
	Route::get('SelectBovino', 'AjaxController@Select2Bovino');
	Route::get('Bovino', 'AjaxController@Bovino');
	Route::get('SelectMedicamento', 'AjaxController@Select2Medicamento');
	Route::get('Medicamento', 'AjaxController@Medicamento');
	Route::get('ComboStatus', 'AjaxController@ComboStatus');
});

Route::group(['prefix' => 'usuario'], function() {
	Route::get('/', ['as' => 'usuarios', 'uses' => 'UsuarioController@Index']);
	Route::get('listar', ['as' => 'listaUsr', 'uses' => 'UsuarioController@Listar']);
	Route::post('cadastrar', ['as' => 'cadastrar', 'uses' => 'UsuarioController@Cadastrar']);
});

Route::group(['prefix' => 'medicamento'], function() {
	Route::get('/', ['as' => 'medicamentos', 'uses' => 'MedicamentoController@Index']);
	Route::get('listar', ['as' => 'listaMed', 'uses' => 'MedicamentoController@Listar']);
	Route::post('cadastrar', ['as' => 'cadastrarMed', 'uses' => 'MedicamentoController@Cadastrar']);
	Route::post('excluir', 'MedicamentoController@Excluir');
});

Route::group(['prefix' => 'fornecedor'], function() {
	Route::get('/', ['as' => 'fornecedores', 'uses' => 'FornecedorController@Index']);
	Route::get('listar', ['as' => 'listaForn', 'uses' => 'FornecedorController@ListarFornecedor']);
	Route::post('cadastrar', ['as' => 'cadastrarFornecedor', 'uses' => 'FornecedorController@Cadastrar']);
	Route::post('excluir', ['as' => 'deletarFornecedor', 'uses' => 'FornecedorController@Excluir']);
	Route::post('editar', ['as' => 'editarFornecedor', 'uses' => 'FornecedorController@Editar']);
});

Route::group(['prefix' => 'evento'], function() {
	Route::get('/', ['as' => 'eventos', 'uses' => 'EventoController@Index']);
	Route::post('registrar', ['as' => 'registrar', 'uses' => 'EventoController@Registrar']);
	Route::get('listar', ['as' => 'listar', 'uses' => 'EventoController@Listar']);
	Route::post('atualizar', ['as' => 'atualizar', 'uses' => 'EventoController@Atualizar']);
	Route::post('carregar', ['as' => 'carregar', 'uses' => 'EventoController@Carregar']);
});

Route::group(['prefix' => 'consulta'], function() {
	Route::get('selecionar', ['as' => 'selectConsulta', 'uses' => 'ConsultaController@Selecionar']);
	Route::post('novo', ['as' => 'novo', 'uses' => 'ConsultaController@Novo']);
	Route::post('listarbovino', ['as' => 'listarbovino', 'uses' => 'ConsultaController@ListarPorBovino']);
});

Route::group(['prefix' => 'inseminacao'], function() {
	Route::get('selecionar', ['as' => 'selectInsem', 'uses' => 'InseminacaoController@Selecionar']);
	Route::post('novoregistro', ['as' => 'novoregistro', 'uses' => 'InseminacaoController@Novo']);
	Route::post('listarbovino', ['as' => 'listarbovino', 'uses' => 'InseminacaoController@ListarPorBovino']);
});

Route::group(['prefix' => 'tratamento'], function() {
	Route::post('novo', ['as' => 'novo', 'uses' => 'TratamentoController@Novo']);
	Route::post('listarbovino', ['as' => 'listarbovino', 'uses' => 'TratamentoController@ListarPorBovino']);
});

Route::group(['prefix' => 'secagem'], function() {
	Route::post('registrar', ['as' => 'registrarSecagem', 'uses' => 'SecagemController@Registrar']);
	Route::post('listarbovino', ['as' => 'listarbovino', 'uses' => 'SecagemController@ListarPorBovino']);
});

Route::group(['prefix' => 'selecionar'], function() {
	Route::get('/{acao}', ['as' => 'selecionar', 'uses' => "SelecionarController@Index"]);
});

Route::group(['prefix' => 'lactacao'], function() {
	Route::get('/', ['as' => 'lactacao', 'uses' => 'LactacaoController@Index']);
	Route::get('informar', ['as' => 'novlac', 'uses' => 'LactacaoController@Novo']);
	Route::post('registrar', ['as' => 'registrar', 'uses' => 'LactacaoController@Registrar']);
});

Route::group(['prefix' => 'pesagem'], function() {
	Route::get('/', ['as' => 'pesagem', 'uses' => 'PesagemController@Index']);
	Route::get('informar', ['as' => 'novapes', 'uses' => 'PesagemController@Novo']);
	Route::post('registrar', ['as' => 'registrarPesagem', 'uses' => 'PesagemController@Registrar']);
});

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

Route::get('/teste', 'TestController@Test');