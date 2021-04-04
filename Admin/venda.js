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
            }
        });
    });

    function Adicionar() {
        if (Number(document.getElementById('quantidade').value) < Number(document.getElementById('quantV').value) ||
            Number(document.getElementById('quantV').value) <= 0) {
            alert("Quantidade Indisponível");
        } else {

            var Produto_id = $("#Produto_id").val()
            var produto_nome = $("#Produto_id option:selected").text()
            var quantV = Number($("#quantV").val())
            var preco = Number($("#preco").val())
            var valorTotalDoItem = quantV * preco

            let enterCondition = false;
            let rows = document.querySelectorAll('tr');
            rows.forEach(row => {
                if (row.querySelector('#id') != null) {
                    if (Number(row.querySelector('#id').innerHTML) == Number(Produto_id)) {
                        alert('Produto já Presente na Lista de Compras, por favor, remova-o da lista para inclui-lo novamente');
                        enterCondition = true;
                    }
                }
            });
            if (enterCondition) {
                $("#quantV").val("");
                document.getElementById('quantV').max = "";
                return;
            }



            //Troca de ponto pra vírgula para exibir os decimais no valor
            var precoStr = formataValorStr(preco)
            var valorTotalItemStr = formataValorStr(valorTotalDoItem)


            //Adiciona linha na tabela dinâmica
            $("#tabela").append(
                "<tr>" +
                "<input type=\"hidden\" name=\"Produto_id[]\" value='" + Produto_id + "' />" +
                "<input type=\"hidden\" name=\"quantV[]\" value='" + quantV + "' />" +
                "<input type=\"hidden\" name=\"valor[]\" value='" + preco + "' />" +

                "<td class=\"text-danger font-weight-bold\" id=\"id\">" + Produto_id + "</td>" +
                "<td>" + produto_nome + "</td>" + //"+ $Produto_id +"
                "<td id=\"quantidade\" class=\"text-right\" id=\"quantV\">" + quantV + "</td>" + //"+ $quantV +"
                "<td class=\"text-right\" id=\"preco\">" + precoStr + "</td>" + //"+ $valor +"
                "<td class=\"text-right text-primary font-weight-bold\" id=\"valorTotalItem\">" + valorTotalItemStr + "</td>" +
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

    // function Finalizar(){

    // }


    $(".excluir").bind("click", Excluir);
    $("#adicionarProdutos").bind("click", Adicionar);
    $("#btnAplicarDesconto").bind("click", AplicarDesconto);
    // $("#finalizar").bind("click", Finalizar);
});
