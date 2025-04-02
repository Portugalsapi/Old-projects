<?php 
include 'server.php';
if ($_SESSION["level"] != 1) {
  header("Location: index.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Canto Informático - Loja Online</title>
    <link rel="icon" type="image/x-icon" href="images/logo1.png" />
    <!-- CSS LINK -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet" />
    <!-- FontAwesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.js" crossorigin="anonymous"></script>
</head>
<body>
<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="nav-link" href="index.php"><img src="images/loginlogo.png" height="50px"> </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="btn btn-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="btn btn-link" href="createstock.php">Criar Stock</a></li>
                <li class="nav-item"><a class="btn btn-link" href="viewstock.php">Visualizar Stock</a></li>
                <li class="nav-item"><a href="login.php?logout='1'" class="btn btn-danger">Terminar Sessão</a></li>
                <li><?php if (isset($_SESSION['username'])) : ?>
                    <p class="font-weight-bold" style="color: white;"><strong><i class="fas fa-user"></i> <?php echo $_SESSION['username']; ?></strong></p>
                </li>
                <?php endif ?>
            </ul>
        </div>
    </div>
</nav>
<!-- Page Content-->
<div class="container">
    <div class="box">
        <h2 class="display-4 text-center">STOCK</h2><hr><br>
        <?php if (isset($_GET['success'])) { ?>
        <div class="alert alert-success" role="alert">
            <?php echo $_GET['success']; ?>
        </div>
        <?php } ?>
        <?php if (mysqli_num_rows($result)) { ?>
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Preço</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Modificar</th>
                    <th scope="col">Apagar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                while ($rows = mysqli_fetch_assoc($result)) {
                    $i++;
                ?>
                <tr>
                    <th scope="row"><?=$i?></th>
                    <td><?=$rows['name']?></td>
                    <td><?=$rows['price']?>€</td>
                    <td><?=$rows['description']?></td>
                    <td><?=$rows['category']?></td>
                    <td><?=$rows['stock']?> UNI</td>
                    <td><a href="update.php?id=<?php echo $rows['id'];?>" class="btn btn-success">Modificar</a></td>
                    <td><a type="submit" name="delete" href="delete.php?id=<?php echo $rows['id'];?>" class="btn btn-danger">Apagar</a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php } ?>
        <div class="link-right">
            <a href="createstock.php" class="link-primary">Criar</a>
        </div>
    </div>
</div>
<br>
<!-- Footer-->
    <footer class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-4 col-xs-12">
                    <ul>
                        <h3>Contactos</h3>
                        <br>
                        <li>
                            Canto Informático
                        </li>

                        <li>
                            +351 296 642 127
                        </li>

                        <li>
                            cantoinfor@gmail.com
                        </li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <ul>
                        <h3>Links Úteis</h3>
                        <br>
                        <li>
                            <a href="local.php">Localização</a>
                        </li>
                        <li>
                            <a href="index.php">Homepage </a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                    <ul id="logos">
                        <h3>Social</h3>
                        <br>
                        <li>
                            <a href="#"><i class="fa-brands fa-facebook fa-2xl" style="color: #ffffff;"></i></a>
                        </li>

                        <li>
                            <a href="#"><i class="fa-brands fa-instagram fa-2xl" style="color: #ffffff;"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

<!-- Bootstrap core JS-->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>

</body>
</html>