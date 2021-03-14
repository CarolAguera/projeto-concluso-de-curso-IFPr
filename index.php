<?php require_once("dependencias.php"); ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link rel="icon" href="img/iconPNG.png" type="image/png" sizes="16x16">
    <a href='https://br.freepik.com/fotos/fundo'></a>
    <style>
        @media only screen and (max-width: 986px) {
            form {
                width: 236px;
            }
        }

        .w-100 {
            width: 100% !important;
            height: 90%;
        }

        .teste {
            background-image: url("img/textura2.jpg");
        }

        .banner_btn {
            display: inline-block;
            padding: 6px 20px;
            font-size: 1em;
            cursor: pointer;
            background: rgb(20, 141, 197);
            color: #fff;
            font-weight: 500;
            text-decoration: none;
            outline: none;
            border-radius: 5px;
        }

        .banner_btn:hover {
            background: #22967c;
            color: #fff;
            text-decoration: none;
        }

        .footer_bottom {
            margin-top: 20px;
            padding: 2em 0;
            /* background: #2ABB9B; */
            background: rgb(20, 141, 197);
        }

        .follow-us {
            margin-top: 10px;
            margin-bottom: 20px;
            text-align: center;
        }

        .fa {
            display: inline-block;
            font: normal normal normal 14px/1 FontAwesome;
            font-size: inherit;
            text-rendering: auto;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .social-icon {
            padding-top: 6px;
            font-size: 16px;
            text-align: center;
            width: 32px;
            height: 32px;
            border: 2px solid #d5f1eb;
            border-radius: 50%;
            color: #d5f1eb;
            margin: 5px;
        }

        a.social-icon:hover,
        a.social-icon:active,
        a.social-icon:focus {
            text-decoration: none;
            color: #e5e52d;
            border-color: #e5e52d;
        }

        .copy {
            text-align: center;
        }

        .copy p {
            font-size: 1em;
            color: #fff;
        }

        .copy p a {
            color: #fff;
            border-bottom: 1px dotted;
        }

        .copy p a:hover {
            color: #e5e52d;
            border-bottom: 1px solid;
            text-decoration: none;
        }
    </style>
</head>

<body style="height: 100%;" class="teste">
    <div>
        <nav class="navbar navbar-expand-lg navbar-dark " style="background-color:  rgb(20, 141, 197);">
            <div class="container">
                <a class="navbar-brand"><img class="img-responsive img-thumbnail" src="img/dpbrasillogo.png" alt="" width="100px" height="60px"></a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Início<span class="sr-only"></span></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="Orcamento.php"> Orçamento</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="login.php"><i class="fas fa-users-cog"></i><b> Login/Cadastro</b></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="bd-example">
            <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel" data-interval="3000">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="img/dpbrasil.jpg" class="d-block w-100 imagem-carrossel img-fluid" alt="Imagem com a foto da loja depósito Brasil">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Visite a nossa Loja</h5>
                            <p>Os melhores preços de Umuarama</p>
                            <a class="banner_btn" href="Orcamento.php">Faça Já Seu Orçamento!</a>
                        </div>
                    </div>
                </div>


                <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Anterior</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Próximo</span>
                </a>
            </div>
        </div>
        <div class="container" style="margin-top: 20px;">
            <div class="card-deck">
                <div class="card">
                    <img class="card-img-top" src="img/orca.jpg" alt="Imagem de capa do card">
                    <div class="card-body">
                        <h5 class="card-title">Orçamento</h5>
                        <p class="card-text">Venha cotar os preços conosco!</p>
                    </div>
                    <div class="card-footer">
                        <center>
                            <a href="Orcamento.php" class="btn btn-warning">Saber Mais</a>
                        </center>
                    </div>
                </div>
                <div class="card">
                    <img class="card-img-top" src="img/login3.jpg" height="360px" alt="Imagem de capa do card">
                    <div class="card-body">
                        <h5 class="card-title">Login/Cadastro</h5>
                        <p class="card-text">Sistema de Gerenciamento de Estoque e Vendas</p>
                    </div>
                    <div class="card-footer">
                        <center>
                            <a href="login.php" class="btn btn-primary">Acessar</a>
                        </center>
                    </div>
                </div>
            </div>
        </div>
        <!-- <footer style="background-color: rgb(20, 141, 197);">
            <div class="mt-4 p-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-4 col-sm-12 mb-2">
                            <div class="embed-responsive embed-responsive-4by3">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4445.140863658188!2d-53.32245081688335!3d-23.77603677667682!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94f2d6bb5afcedf1%3A0xb883c62b96efd16c!2sDep%C3%B3sito+Brasil!5e1!3m2!1spt-BR!2sbr!4v1564142531790!5m2!1spt-BR!2sbr" class="embed-responsive-item" allowfullscreen></iframe>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="dados">
                                <h4>• Dados da Empresa:</h4>
                                <p> - Av. Brasil, 2060 - Zona VII, Umuarama - PR, 87503-420</p>
                                <p> - Telefone: 44 3639-7282 / 44 98417-9895</p>
                                <p> - &copy; Depósito Brasil - Materiais para Construcão - 1994 - 2021</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer> -->

        <div class="footer">
            <div class="footer_bottom">
                <div class="follow-us"> <a class="fa fa-facebook social-icon" href="#"></a> <a class="fa fa-twitter social-icon" href="#"></a> <a class="fa fa-linkedin social-icon" href="#"></a> <a class="fa fa-google-plus social-icon" href="#"></a> </div>
                <div class="copy">
                    <p>Copyright &copy; Depósito Brasil - Materiais para Construcão - 1994 - 2021</p>
                </div>
            </div>
        </div>


    </div>
</body>

</html>