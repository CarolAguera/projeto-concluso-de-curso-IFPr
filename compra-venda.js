$(function() {
    
    /////////////////////////////////////////////////////
    // EVENTOS DE FORMULÁRIO/////////////////////////////
    /////////////////////////////////////////////////////
    
    function Adicionar() {
        if (!validaCamposFormularioProduto()) {
            return false
        }
        
        var produto_id        = $("#produto_id").val() //form.produto_id.value
        var produto_descricao = $("#produto_id option:selected").text()
        var quantidade        = Number($("#quantidade").val())
        var valorUnitario     = Number($("#valorUnitario").val().replace(',', '.'))
        var valorTotalDoItem  = quantidade * valorUnitario

        //Troca de ponto pra vírgula para exibir os decimais no valor
        var valorUnitarioStr  = formataValorStr(valorUnitario)
        var valorTotalItemStr = formataValorStr(valorTotalDoItem)


        //Adiciona linha na tabela dinâmica
		$("#tabela").append(
        "<tr>"+
            "<input type=\"hidden\" name=\"produto_id[]\" value='"+ produto_id +"' />" + 
            "<input type=\"hidden\" name=\"quantidade[]\" value='"+ quantidade +"' />" + 
            "<input type=\"hidden\" name=\"valor[]\" value='"+ valorUnitario +"' />" +

            "<td>"+ produto_descricao +"</td>"+ //"+ $produto_id +"
            "<td class=\"text-right\" id=\"quantidade\">"+ quantidade +"</td>"+ //"+ $quantidade +"
            "<td class=\"text-right\" id=\"valorUnitario\">"+ valorUnitarioStr +"</td>"+ //"+ $valor +"
            "<td class=\"text-right\" id=\"valorTotalItem\">"+ valorTotalItemStr +"</td>"+
            "<td class=\"text-center\">"+
                "<button type=\"button\" class=\"btn btn-danger btn-sm btnExcluir\">"+
                    "<i class=\"far fa-trash-alt\"></i>"+
                "</button>"+
            "</td>"+
        "</tr>");
        
		$(".btnExcluir").bind("click", Excluir);

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
	
    /////////////////////////////////////////////////////
    // FUNÇÕES AUXILIARES ///////////////////////////////
    /////////////////////////////////////////////////////

    //Valida os campos do form de Produtos
    function validaCamposFormularioProduto() {
        if (form.produto_id.value == '') {
            alert('O campo produto é obrigatório.')
            form.produto_id.focus()
            return false
        } else if (form.quantidade.value == '') {
            alert('O campo quantidade é obrigatório.')
            form.quantidade.focus()
            return false
        } else if (form.valorUnitario.value == '') {
            alert('O campo valor unitário é obrigatório.')
            form.valorUnitario.focus()
            return false
        }

        return true
    }

    function limpaCampos() {
        form.produto_id.value = ''
        form.quantidade.value = '1'
        form.valorUnitario.value = ''
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
        var desconto   = Number(form.desconto.value.replace(',', '.'))
        var valorTotal = somaProdutos - desconto
        $("#resumoValorTotal").text(formataValorStr(valorTotal))
    }

    function formataValorStr(valor) {
        return valor.toFixed(2).toString().replace('.', ',')
    }


    $(".btnExcluir").bind("click", Excluir);
	$("#btnAdicionar").bind("click", Adicionar);
	$("#btnAplicarDesconto").bind("click", AplicarDesconto);
});
