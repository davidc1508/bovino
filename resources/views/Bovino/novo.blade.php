@extends('base')

@section('content')
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">
                        Cadastro de Bovino
                    </h3>
                </div>
                <hr/>
                <div class="box-body">
                    <form method="post" action="cadastrar">                    
                    <input type="hidden" name="count" value="1" id="count"/>
                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="bov_codigo" class="control-label">Nº Brinco</label>
                                    <input type="text" name="bov_codigo" class="form-control" id="bov_codigo" required="required"/>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="bov_nome" class="control-label">Nome</label>
                                    <input type="text" name="bov_nome" id="bov_nome" class="form-control" required="required">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="bov_nascimento" class="control-label">Data nascimento</label>
                                    <input type="date" name="bov_nascimento" class="form-control" id="bov_nascimento" required="requried">                                    
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label class="control-label" for="bov_pesonascimento">Peso Nasc.</label>
                                    <input type="text" name="bov_pesonascimento" id="bov_pesonascimento" class="form-control" />
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label class="control-label" for="bov_sexo">Sexo</label>
                                    <div>
                                        <label class="radio-inline">
                                            <input type="radio" id="bov_sexo" name="bov_sexo" value="F"> Femea
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" id="bov_sexo" name="bov_sexo" value="M"> Macho
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row linhaRaca">
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label class="control-label" for="box_raca">Ra&ccedil;a</label>
                                    <select name="bov_raca[]" id="box_raca" class="form-control" required="required">
                                        <option value="">Selecione</option>
                                        @foreach($lista as $raca):
                                        <option value="{{$raca->id}}">{{$raca->rac_nome}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label class="control-label" for="box_procedencia">Mistura</label>
                                    <input type="text" name="procedencia[]" class="form-control" />
                                </div>
                            </div>
                            <div class="col-lg-1">
                                <div class="form-group">
                                    <label for="addRac" class="control-label">Adicionar</label>
                                    <button id="addRac" class="btn btn-success fa fa-plus"></button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label" for="mat_brinco">Matriz</label>
                                    <div class=row>
                                        <div class="col-lg-4">
                                            <label class="control-label" for="bov_matriz">N&ordm; Brinco</label>
                                            <input type="text" name="bov_matriz" id="bov_matriz" class="form-control">
                                        </div>
                                        <div class="col-lg-4">
                                            <label class="control-label" for="mat_nome">Nome</label>
                                            <input type="text" name="mat_nome" id="mat_nome" class="form-control">
                                        </div>
                                        <div class="col-lg-4">
                                            <label class="control-label hidText">Busca</label>
                                            <input type="button" class="btn btn-info form-control" id="srcMatriz" value="Buscar">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label" for="rep_codigo">Reprodutor</label>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label class="control-label" for="bov_reprodutor">Identificador</label>
                                            <input type="text" name="bov_reprodutor" id="bov_reprodutor" class="form-control">
                                        </div>
                                        <div class="col-lg-4">
                                            <label class="control-label" for="rep_nome">Nome</label>
                                            <input type="text" name="rep_nome" class="form-control" id="rep_nome">
                                        </div>
                                        <div class="col-lg-4">
                                            <label class="control-label hidText">Busca</label>
                                            <input type="button" value="Buscar" class="btn btn-info form-control" id="srcRepro">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="control-label" for="bov_desc">Descri&ccedil;&atilde;o</label>
                                    <textarea rows="5" name="bov_descricao" class="form-control" id="bov_desc"></textarea>
                                </div>
                            </div>
                        </div>
                    <hr />
                    <div class="row text-center">
                        <input type="submit" value="Cadastrar" class="btn btn-success" />
                    </div>
                    
                    </form>
                </div>
            </div>            
        </div>
    </div>
</section>
@endsection

@section('modal')
@include('Partials/Modal/bovino-cadastro')
@endsection

@section('script')
<script src='/js/bovino.js'></script>
<script>
    function AddBoxRaca() {
        var target = $('.linhaRaca');
        var htmlStructure = '<div class="tst"><div class="col-lg-8">'
                           + '         <div class="form-group">'
                           + '             <label class="control-label" for="box_raca">Ra&ccedil;a</label>'
                           + '             <select name="bov_raca[]" id="box_raca" class="form-control" required="required">'
                           + '                 <option value="">Selecione</option>';
        
        <?php
        foreach($lista as $raca):
        ?>
        htmlStructure += '<option value="<?=$raca->id?>"><?=$raca->rac_nome?></option>';
        <?php endforeach; ?>        
        htmlStructure += '     </select>'
                       + '      </div>'
                       + '      </div>'
                       + '     <div class="col-lg-3">'
                       + '     <div class="form-group">'
                       + '         <label class="control-label" for="box_procedencia">Mistura</label>'
                       + '         <input type="text" name="procedencia[]" class="form-control" />'
                       + '     </div>'
                       + '     </div>'
                       + '     <div class="col-lg-1">'
                       + '     <div class="form-group">'
                       + '          <label for="addRaca" class="control-label">Remover</label>'
                       + '         <button id="addRaca" class="btn btn-danger fa fa-minus rmvRac"></button>'
                       + '     </div>'
                       + '     </div></div>';
    var count = $('#count').val();
    count++;
    $('#count').val(count);
    $(target).append(htmlStructure);
}
</script>
@endsection