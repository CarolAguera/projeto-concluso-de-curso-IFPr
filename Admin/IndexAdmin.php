<?php
require_once("../dependencias.php");
require_once("../verificaSessao.php");
require_once("../menu.php");
if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Depósito Brasil</title>
    <style>
        @media only screen and (min-width: 992px) {
            .data {
                width: 570px;
                text-align: left;
                padding-left: 0px;
            }

            .hora {
                width: 570px;
                text-align: right;

            }
        }

        @media only screen and (max-width: 991.98px) {
            .col {
                flex-basis: auto;
            }
        }
    </style>
</head>

<body>
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">Bem-Vindo(a) <?= $_SESSION['nome_completo']; ?></h1>

        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body text-center">

                        <h5 class="card-title">Produto</h5>
                        <a href="Produto.php" class="btn btn-info">Cadastrar</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Estoque</h5>
                        <a href="Estoque.php" class="btn btn-info">Gerenciar/Consultar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container" style="margin-top: 40px;">
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Marca</h5>
                        <a href="Marca.php" class="btn btn-info">Cadastrar/Consultar</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Cliente</h5>
                        <a href="NovoCliente.php" class="btn btn-info">Cadastrar</a>
                        <a href="clientes.php" class="btn btn-info">Consultar</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row " style="margin-top: 40px;">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Categoria</h5>
                        <a href="Categoria.php" class="btn btn-info">Cadastrar/Consultar</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Usuários</h5>
                        <a href="NovoUsuario.php" class="btn btn-info">Cadastrar</a>
                        <a href="usuarios.php" class="btn btn-info">Consultar</a>
                    </div>
                </div>
            </div>
        </div>
        <!--<div class="row" style="margin-top: 10px;">
            <iframe src="https://open.spotify.com/embed/playlist/6PXGjohvrsyrMIt7ZQMYIr" width="1122" height="400" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>
        </div>-->
    </div>
    <div id="dataHora" class="container" style=" margin-top: 40px; font-size: 32px; color: #000000; font-family: Arial, Helvetica, sans-serif; ">
        <div class="row">
            <div class="col data w-100">
                <script language="JavaScript">
                    var mydate = new Date()
                    var year = mydate.getYear()
                    if (year < 2000)
                        year += (year < 1900) ? 1900 : 0
                    var day = mydate.getDay()
                    var month = mydate.getMonth()
                    var daym = mydate.getDate()
                    if (daym < 10)
                        daym = "0" + daym
                    var dayarray = new Array("Domingo", "Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", "Sábado")
                    var montharray = new Array(" de Janeiro de ", " de Fevereiro de ", " de Março de ", "de Abril de ", "de Maio de ", "de Junho de", "de Julho de ", "de Agosto de ", "de Setembro de ", " de Outubro de ", " de Novembro de ", " de Dezembro de ")
                    document.write("   " + dayarray[day] + ", " + daym + " " + montharray[month] + year + " ")
                    document.write("</b></i></font>")
                </script>
            </div>
            <div>
                <script type="text/javascript">
                    function startTime() {
                        var today = new Date();
                        var h = today.getHours();
                        var m = today.getMinutes();
                        var s = today.getSeconds();
                        // adicione um zero na frente de números<10
                        m = checkTime(m);
                        s = checkTime(s);
                        document.getElementById('txt').innerHTML = h + ":" + m + ":" + s;
                        t = setTimeout('startTime()', 500);
                    }

                    function checkTime(i) {
                        if (i < 10) {
                            i = "0" + i;
                        }
                        return i;
                    }
                </script>


                <body onload="startTime()">
                    <div class="col hora w-100" id="txt"></div>
                </body>
            </div>
        </div>
    </div>


</body>

</html>