<?php include('server.php') ?>
<!DOCTYPE html>
<html>

<head>

  <title>Canto Informático - Loja Online</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!--icone-->
  <link rel="icon" type="image/x-icon" href="img/icone.png">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <!--CSS Personalizado-->
  <link rel="stylesheet" type="text/css" href="css/styleslr.css">

  <!-- FontAwesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.js" crossorigin="anonymous"></script>


</head>

<body>
  <section class="container-fluid">
    <section class="row justify-content-center">
      <section class="col-12 col-sm-6 col-md-3">
        <!-- Div do Card -->
        <div class="card" style="width: 100%;">
          <!-- Div Logotipo Card -->
          <div class="card-header">
            <a href="index.php"><img src="images/loginlogo.png" class="img-fluid mx-auto d-block"></a>
          </div>
          <!-- Fim Div Logotipo Card -->
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              <form class="form-container" method="post" action="register.php">
                <?php include('errors.php'); ?>
                <!-- Inserir Nome -->
                <div class="form-group">
                  <span class="fas fa-user form-control-icon"></span>
                  <input type="text" class="form-control" placeholder="Nome" name="username">
                </div>
                <!-- Fim Inserir Nome -->
                <!-- Inserir Email -->
                <div class="form-group">
                  <span class="fas fa-envelope form-control-icon"></span>
                  <input type="email" class="form-control" placeholder="Email" name="email">
                </div>
                <!-- Fim Inserir Email -->
                <!-- Inserir Password -->
                <div class="form-group">
                  <span class="fas fa-key form-control-icon"></span>
                  <input type="password" class="form-control" placeholder="Password" name="password_1">
                </div>
                <!-- Fim de Inserir Password -->
                <!-- Inserir Password2 -->
                <div class="form-group">
                  <span class="fas fa-key form-control-icon"></span>
                  <input type="password" class="form-control" placeholder="Confirmar Password" name="password_2">
                </div>
                <!-- Fim de Inserir Password2 -->
                <!--Botão Registar -->
                <button class="btn btn-primary btn-block" name="reg_user">Registar</button>
                <!-- Fim Botão Registar -->
              </form>
            </li>
            <!-- Link para Login.html -->
            <li class="list-group-item">Já tens uma conta? <a href="login.php">Login</a></li>
          </ul>
          <!-- Fim Link para Login.html -->
        </div>
        <!-- Div do Card -->

      </section>
    </section>
  </section>
</body>

</html>