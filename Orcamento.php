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
            <a class="nav-link" href="Orcamento.php"><b> Orçamento</b><span class="sr-only"></span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Login/Cadastro</a>
          </li>
        </ul>
        <form>
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Oque você deseja ?" aria-label="Input group example" aria-describedby="btnGroupAddon">
            <div class="input-group-prepend Auto-sizing">
              <div class="btn btn-primary butao" style="height:38px;" type="submit"><i class="fas fa-search icone" style="margin-top: 3px;"></i></div>
            </div>
          </div>
        </form>

      </div>
    </div>
  </nav>
  <br>
  <br>
  <center>
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
</body>

</html>