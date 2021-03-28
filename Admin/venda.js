$(function () {

    $('#Produto_id').change(function () {
        $.ajax({
            type: "POST",
            data: "Produto_id=" + $('#Produto_id').val(),
            url: "./obterDadosProdutos.php",
            success: function (r) {
                let dado = jQuery.parseJSON(r);
                $('#quantidade').val(dado['quantidade']);
                $('#preco').val(Number(dado['valor_venda']).toFixed(2));
                document.getElementById('quantV').max = Number(dado['quantidade']);
            }
        });
    });

    function Adicionar() {
        if (Number($("#quantV").val()) > document.getElementById('quantV').max || $("#quantV").val() < 1) {
            alert("Quantidade Indisponível");
        } else {

            var Produto_id = $("#Produto_id").val()
            var produto_nome = $("#Produto_id option:selected").text()
            var quantV = Number($("#quantV").val())
            var preco = Number($("#preco").val())
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

            recalculaValores()
        }
        $("#quantV").val("")
        document.getElementById('quantV').max = ""
    };

    function Excluir() {
        var par = $(this).parent().parent(); //tr
        par.remove();

        recalculaValores()
    };

    function AplicarDesconto() {
        recalculaValores()
    }


    function recalculaValores() {
        var conteudo = document.getElementById("tabela").rows //Pega todas as 'tr' da tabela

        var somaProdutos = 0
        for (i = 1; i < conteudo.length; i++) { //Começa a partir de 1, pq a linha 0 é o cabeçalho
            var valorItemStr = conteudo[i].querySelector(`#valorTotalItem`).textContent //Pega o valor total do item
            somaProdutos += Number(valorItemStr.replace(',', '.')) //Converte pra numérico e soma com somaProdutos
        }

        //document.getElementById("resumoSoma").textContent = formataValorStr(somaProdutos)

        $("#resumoSoma").val(formataValorStr(somaProdutos)) //Substitui a linha acima, porém agora usando jQuery
        $("#resumoSomaSpan").text(formataValorStr(somaProdutos))
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
