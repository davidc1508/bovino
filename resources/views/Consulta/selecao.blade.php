@extends('base')

@section('content')
<section class="content">
    <div class="row">
        <div class="col-sm-12">              
			<div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">Bovino</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-xs btn-success btn-box-tools" data-widget="collapse" title="Minimizar">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="filtro_bovino" class="control-label">Filtro de Bovinos</label><small class="pull-right">Utilize o filtro para buscar o bovino utilizando o brinco ou nome</small>
                                <select name="filtro_bovino" id="filtro_bovino" class="form-control" style="max-width: 99%;">
                                    <option></option>
                                </select>
                            </div>

                            <hr/>

                            <div id="info-cliente">
                                <div class="form-group">
                                	<input type="hidden" id="bov_id"></input>
                                    <div class="col-sm-3">
                                        <label class="control-label" for="bov_codigo">Brinco</label>
                                        <input class="form-control bov_codigo" id="bov_codigo" name="bov_codigo" readonly="readonly" type="text" value="" required="required"/>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="control-label" for="bov_nome">Nome</label>
                                        <input class="form-control bov_nome" disabled="disabled" id="bov_nome" name="bov_nome" type="text" value="" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <p class="text-center">
                <button class="btn btn-sm btn-success" id="showModal">
                    <i class="fa fa-check"></i> Próximo
                </button>
            </p>
        </div>
    </div>
</section>

@endsection

@section('script')
<script src='/js/consulta.js'></script>
@endsection

@section('modal')
@include('Partials/Modal/consulta')
@endsection