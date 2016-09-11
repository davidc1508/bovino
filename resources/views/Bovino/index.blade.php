@extends('base')

@section('content')
<div id="alert"></div>
<link type="text/css" rel="stylesheet" href="/css/animal.css">
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">
                        Bovinos cadastrados
                    </h3>
                </div>                
                <div class="box-body">
                    <div class="table-responsive">
                        <table data-show-columns="true" id="events-table"
                            data-url="bovino/listar"
                            data-height="400" data-search="true" data-pagination="true"
                            class="table table-bordered table-hover table-condensed table-responsive table-striped">
                            <thead>
                                <tr>
                                    <th data-field="id" data-visible="false">Id</th>
                                    <th data-field="bov_codigo" data-sortable="true" class="col-lg-2">N&ordm; Brinco</th>
                                    <th data-field="bov_nome" data-sortable="true" class="col-lg-2">Nome</th>
                                    <th data-field="bov_nascimento" data-sortable="true" class="col-lg-3">Data Nascimento</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                    <div class="form-actions">
                        <button type="button" class="btn btn-success glyphicon glyphicon-search" data-toggle="modal" id="openModalView"> Informa&ccedil;&otilde;es</button>
                        <a href="bovino/novo" class="btn btn-success glyphicon glyphicon-plus"> Novo</a>
                        <button type="button" class="btn btn-success glyphicon glyphicon-pencil" data-toggle="modal" id="openModalEdit"> Alterar</button>
                        <button type="button" class="btn btn-danger glyphicon glyphicon-trash" style="float: right;" id="openModalExcluir"> Excluir</button>

                    </div>
                </div>
            </div>
            </div>
        </div>
</section>
@endsection

@section('script')
    <script src='/js/bovino.js'></script>
    <script src='/js/consulta.js'></script>
    <script src='/js/tratamento.js'></script>
    <script src='/js/inseminacao.js'></script>
@endsection

@section('modal')
@include('Partials/Modal/bovino')
@include('Partials/Modal/bovino-cadastro')
@include('Partials/Modal/consulta')
@include('Partials/Modal/tratamento')
@include('Partials/Modal/inseminacao')
@endsection

