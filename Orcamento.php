<?php
require_once("dependencias.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="icon" href="img/iconPNG.png" type="image/png" sizes="16x16">
  <title>Orçamento</title>
</head>

<body>


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
  <center style="margin-top: 10px;">
    <h1><strong> Orçamento</strong></h1>
  </center>
  <br>
  <br>
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body text-center">
            <h5 class="card-title">Faça seu Orçamento direto pelo WhatsApp</h5>
            <a href="https://api.whatsapp.com/send?phone=5544984179895&text=Quero%20fazer%20um%20or%C3%A7amento." type="submit" class="btn btn-primary" style="background-color: #32CD32; border: #32CD32;" target="_blank"><i class="fab fa-whatsapp"></i> Mandar Mensagem</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class=" text-center">
          <h4 style="margin-top: 40px; ">Localização</h4>
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.201835796854!2d-53.32434728501822!3d-23.77582598457689!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94f2d6bb5afcedf1%3A0xb883c62b96efd16c!2sDep%C3%B3sito%20Brasil!5e0!3m2!1spt-BR!2sbr!4v1615722387875!5m2!1spt-BR!2sbr" width="100%" height="auto" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
      </div>
    </div>
  </div>


  <?php require_once("footer.php") ?>
</body>

</html>