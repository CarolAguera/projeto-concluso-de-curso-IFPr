<?php
require_once("verificaSessao.php");
require_once("conexao.php");
?>

<?php
    $titulo1 = "Compra/Venda";
    require_once("cabecalho.php");
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript" src="compra-venda.js"></script>


<div class="container">
    <form name="form" action="compra-venda.php" method="post">
            
    <div class="row">
        
        <!-- div Resumo -->
        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Resumo</span>
            </h4>
            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <span>Soma dos Produtos</span>
                    <span class="text-muted"><div id="resumoSoma">0,00</div></span>
                </li>
                <div class="input-group text-right">
                    <div class="input-group-prepend">
                        <div class="input-group-text font-weight-bold text-success">Desconto R$</div>
                    </div>
                    <input type="text" class="form-control text-right" name="desconto" value="0,00">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-secondary" id="btnAplicarDesconto"><i class="fas fa-check"></i></button>
                    </div>
                </div>
                <li class="list-group-item d-flex justify-content-between">
                    <h6 class="my-0">Total (R$)</h6>
                    <strong><div id="resumoValorTotal">0,00</div></strong>
                </li>
            </ul>
            <div class="input-group">
                <button type="submit" name="finalizar" value="finalizar" class="btn btn-primary btn-lg btn-block">Finalizar</button>
            </div>
        </div>

        <!-- Dados -->
        <div class="col-md-8 order-md-1">

            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="operacao" class="font-weight-bold">Operação</label>
                    <select id="operacao" name="operacao" required class="custom-select d-block w-100">
                        <option value="V">Venda</option>
                        <option value="C">Compra</option>
                    </select>
                </div>
            
                <div class="col-md-9">
                    <label for="cliente_id" class="font-weight-bold">Cliente</label>
                    <select name="cliente_id" id="cliente_id" class="custom-select">
                        <option value="">-- Selecione --</option>
                    </select>
                </div>
            </div>
            <hr>
            
            <h4 class="mb-3">Produtos</h4>

            <div class="card card-body">
                <div class="row">
                    <div class="col-md-12">
                        <label for="produto_id">Produto</label>
                        <select name="produto_id" id="produto_id" class="custom-select">
                            <option value="">-- Selecione --</option>
                        </select>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="qtd">Qtd.</label>
                            <input type="number" id="quantidade" name="quantidade" class="form-control" value='1'>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="valorUnitario">Valor Un.</label>
                            <div class="input-group mb-2 text-right">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">R$</div>
                                </div>
                                <input type="text" id="valorUnitario" name="valorUnitario" placeholder='0,00' class="form-control text-right">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <button type="button" class="btn btn-secondary" id="btnAdicionar">Adicionar</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <hr>
            <h4 class="mb-3">Lista de Produtos</h4>

            <div class="row">
                <div class="col-md-12">
                    <table id="tabela" class="table table-striped table-bordered table-hover table-sm">
                        <thead>
                            <tr>
                                <th scope="col">Produto</th>
                                <th scope="col" class="text-right">Qtd.</th>
                                <th scope="col" class="text-right">Preço Un.</th>
                                <th scope="col" class="text-right">Preço Total</th>
                                <th scope="col" class="text-center">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Conteúdo dinâmico -->
                        </tbody>
                    </table>
                    
                </div>
            </div>

            <hr class="mb-4">
        </div>
    </div>
    
    </form>
</div>

<?php require_once("rodape.php") ?>
