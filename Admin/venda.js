$(function () {

    $('#Produto_id').change(function(){
        console.log($('#Produto_id').val());
        $.ajax({
            type:"POST",
            data:"Produto_id=" + $('#Produto_id').val(),
            url:"./obterDadosProdutos.php",
            success:function(r){
                dado = jQuery.parseJSON(r);
                $('#quantidade').val(dado['quantidade']);
                $('#preco').val(dado['valor_venda']);
            }
        });
    });

    /////////////////////////////////////////////////////
    // EVENTOS DE FORMULÁRIO/////////////////////////////
    /////////////////////////////////////////////////////

    function Adicionar() {
        // if (!validaCamposFormularioProduto()) {
        //     return false
        // }

        var Produto_id = $("#Produto_id").val() //form.Produto_id.value
        var produto_nome = $("#Produto_id option:selected").text()
        var quantV = Number($("#quantV").val())
        var preco = Number($("#preco").val().replace(',', '.'))
        var valorTotalDoItem = quantV * preco

        //Troca de ponto pra vírgula para exibir os decimais no valor
        var precoStr = formataValorStr(preco)
        var valorTotalItemStr = formataValorStr(valorTotalDoItem)


        //Adiciona linha na tabela dinâmica
        $("#tabela").append(
            "<tr>" +
            "<input type=\"hidden\" name=\"Produto_id[]\" value='" + Produto_id + "' />" +
            "<input type=\"hidden\" name=\"quantV[]\" value='" + quantV + "' />" +
            "<input type=\"hidden\" name=\"valor[]\" value='" + preco + "' />" +

            "<td>" + Produto_id + "</td>" + 
            "<td>" + produto_nome + "</td>" + //"+ $Produto_id +"
            "<td class=\"text-right\" id=\"quantV\">" + quantV + "</td>" + //"+ $quantV +"
            "<td class=\"text-right\" id=\"preco\">" + precoStr + "</td>" + //"+ $valor +"
            "<td class=\"text-right\" id=\"valorTotalItem\">" + valorTotalItemStr + "</td>" +
            "<td class=\"text-center\">" +
            "<button type=\"button\" class=\"btn btn-danger btn-sm excluir\">" +
                "<i class=\"far fa-trash-alt\"></i>" +
            "</button>" +
            "</td>" +
            "</tr>");

        $(".excluir").bind("click", Excluir);

        limpaCampos()
        recalculaValores()
    };

    function Excluir() {
        var par = $(this).parent().parent(); //tr
        par.remove();

        recalculaValores()
    };

    function AplicarDesconto() {
        recalculaValores()
    }

    ///////////////////////////////////////////////////
    // FUNÇÕES AUXILIARES ///////////////////////////////
    ///////////////////////////////////////////////////

    // Valida os campos do form de Produtos
    function validaCamposFormularioProduto() {
        if (form.Produto_id.value == '') {
            alert('O campo produto é obrigatório.')
            form.Produto_id.focus()
            return false
        } else if (form.quantV.value == '') {
            alert('O campo quantV é obrigatório.')
            form.quantV.focus()
            return false
        } else if (form.preco.value == '') {
            alert('O campo valor unitário é obrigatório.')
            form.preco.focus()
            return false
        }

        return true
    }

    function limpaCampos() {
        form.Produto_id.value = ''
        form.quantV.value = '1'
        form.preco.value = ''
    }

    function recalculaValores() {
        var conteudo = document.getElementById("tabela").rows //Pega todas as 'tr' da tabela

        var somaProdutos = 0
        for (i = 1; i < conteudo.length; i++) { //Começa a partir de 1, pq a linha 0 é o cabeçalho
            var valorItemStr = conteudo[i].querySelector(`#valorTotalItem`).textContent //Pega o valor total do item
            somaProdutos += Number(valorItemStr.replace(',', '.')) //Converte pra numérico e soma com somaProdutos
        }

        //document.getElementById("resumoSoma").textContent = formataValorStr(somaProdutos)
        $("#resumoSoma").text(formataValorStr(somaProdutos)) //Substitui a linha acima, porém agora usando jQuery
        var desconto = Number(form.desconto.value.replace(',', '.'))
        var valorTotal = somaProdutos - desconto
        $("#resumoValorTotal").text(formataValorStr(valorTotal))
    }

    function formataValorStr(valor) {
        return valor.toFixed(2).toString().replace('.', ',')
    }


    $(".excluir").bind("click", Excluir);
    $("#adicionarProdutos").bind("click", Adicionar);
    $("#btnAplicarDesconto").bind("click", AplicarDesconto);
});
