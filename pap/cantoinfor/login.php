<?php include('server.php') ?>
<!DOCTYPE html>
<html>

<head>

  <title>Canto Informático - Loja Online</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!--icone-->
  <link rel="icon" type="image/x-icon" href="img/icone.jpg">
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
        <!-- Div do Card-->
        <div class="card" style="width: 100%;">
          <!-- Logotipo LOGIN -->
          <div class="card-header">
            <a href="index.php"><img src="images/loginlogo.png" class="img-fluid mx-auto d-block"></a>
          </div>
          <!-- Fim Logotipo LOGIN -->
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              <form class="form-container" method="post" action="login.php">
                <?php include('errors.php'); ?>
                <!-- Inserir Email -->
                <div class="form-group">
                  <span class="fas fa-envelope form-control-icon"></span>
                  <input type="email" class="form-control" placeholder="Email" name="username">
                </div>
                <!-- Fim Email -->
                <div class="form-group">
                  <!-- Inserir Password -->
                  <span class="fas fa-key form-control-icon"></span>
                  <input type="password" class="form-control" placeholder="Password" name="password">
                </div>
                <!--Fim de Password -->
                <!--Botão Login-->
                <button class="btn btn-primary btn-block" type="submit" name="login_user">Login</button>
                <!-- Fim Botão Login -->
              </form>
              <!-- Direção para o Register.html -->
            </li>
            <li class="list-group-item">Ainda não tens conta? <a href="register.php">Criar conta!</a>
              <br>
            </li>
          </ul>
          <!-- Direção para o Register.html -->
        </div>
        <!-- Fim Div do Card-->
      </section>
    </section>
  </section>
</body>

</html>