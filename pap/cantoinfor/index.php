<?php
require_once("server.php");
$db_handle = new dbconfig();
// Cart actions add remover and empty
if (!empty($_GET["action"])) {
    switch ($_GET["action"]) {
        case "add":
            if (!empty($_GET["quantidade"])) {
                $productByCode = $db_handle->runQuery("SELECT * FROM produtos WHERE id='" . $_GET["codigo"] . "'");
                $itemArray = array($productByCode[0]["id"] => array('name' => $productByCode[0]["name"], 'id' => $productByCode[0]["id"], 'quantidade' => $_GET["quantidade"], 'imagem' => $productByCode[0]["imagem"], 'price' => $productByCode[0]["price"]));

                if (!empty($_SESSION["cart_item"])) {
                    if (in_array($productByCode[0]["id"], array_keys($_SESSION["cart_item"]))) {
                        foreach ($_SESSION["cart_item"] as $k => $v) {
                            if ($productByCode[0]["id"] == $k) {
                                if (empty($_SESSION["cart_item"][$k]["quantidade"])) {
                                    $_SESSION["cart_item"][$k]["quantidade"] = 0;
                                }
                                $_SESSION["cart_item"][$k]["quantidade"] += $_GET["quantidade"];
                            }
                        }
                    } else {
                        $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
                    }
                } else {
                    $_SESSION["cart_item"] = $itemArray;
                }
            }
            break;
        case "remover":
            if (!empty($_SESSION["cart_item"])) {
                foreach ($_SESSION["cart_item"] as $k => $v) {
                    if ($_GET["codigo"] == $_SESSION["cart_item"][$k]["id"])
                        unset($_SESSION["cart_item"][$k]);
                    if (empty($_SESSION["cart_item"]))
                        unset($_SESSION["cart_item"]);
                }
            }
            break;
        case "empty":
            unset($_SESSION["cart_item"]);
            break;
    }
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
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!-- Import Stylesheets of Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet" />
    <!-- FontAwesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.js" crossorigin="anonymous"></script>


</head>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="nav-link" href="index.php"><img src="images/loginlogo.png" height="50px"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="btn btn-link" href="index.php">Loja</a></li>
                    <li class="nav-item"><a class="btn btn-link" href="local.php">Localização</a></li>
                    <li class="nav-item"><button class="btn btn-link" onclick="document.getElementById('id01').style.display='block'">Carrinho</button></li>



                    <?php
                    if (isset($_SESSION["level"]) ? $_SESSION["level"] == 1 : false) {
                    ?>
                        <div class="dropdown">
                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Área Admin
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="viewstock.php">Stock</a>
                            </div>
                        </div>
                    <?php
                    }
                    ?>

                    <?php if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
                    ?>
                        <li class="nav-item"><a href="logout.php" class="btn btn-danger">Terminar Sessão</a></li>
                    <?php } else { ?>
                        <li class="nav-item"><a href="login.php" class="btn btn-info">Login</a></li>

                    <?php } ?>
                    <li><?php if (isset($_SESSION['username'])) : ?>
                            <p class="font-weight-bold" style="color: white;"><strong><i class="fas fa-user"></i> <?php echo $_SESSION['username']; ?></strong></p>
            </div>
        <?php endif ?>
        </li>
        </ul>
        </div>
        </div>
    </nav>
    <!-- Page Content-->

    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <h1 class="my-4">PRODUTOS</h1>
                <div class="list-group">
                    <a class="list-group-item" href="index.php?category=computadores">Computadores</a>
                    <a class="list-group-item" href="index.php?category=perifericos">Periféricos</a>
                    <a class="list-group-item" href="index.php?category=jogos">Jogos</a>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="carousel slide my-4" id="carouselExampleIndicators" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li class="active" data-target="#carouselExampleIndicators" data-slide-to="0"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <!-- Carousel #1-->
                        <div class="carousel-item active"><img class="d-block img-fluid" src="./images/razer.jpg"></div>
                        <!-- Carousel #2-->
                        <div class="carousel-item"><img class="d-block img-fluid" src="./images/rocket.jpg">
                        </div>
                        <!-- Carousel #3 -->
                        <div class="carousel-item"><img class="d-block img-fluid" src="./images/laptop.png"></div>
                    </div>
                    <!-- Button Next -->
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Seguinte</span>
                    </a>
                    <!-- Button previous -->
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Anterior</span>
                    </a>
                    <!-- Product Area -->
                </div>
                <div class="row">
                    <?php
                    if (isset($_GET['category'])) {
                        $category = $_GET['category'];
                        $sql = "SELECT * FROM produtos WHERE category='$category' AND stock>0";
                    } else {
                        $sql = "SELECT * FROM produtos WHERE stock>0";
                    }
                    $product_array = $db_handle->runQuery($sql);
                    if (!empty($product_array)) {
                        foreach ($product_array as $key => $value) {
                    ?>
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card h-100">
                                    <a href="#!"><img class="card-img-top" src="images/<?php echo $product_array[$key]["imagem"]; ?>"></a>
                                    <div class="card-body">
                                        <h4 class="card-title"><a href="#!"><?php echo $product_array[$key]['name'] ?></a></h4>
                                        <h5><?php echo $product_array[$key]['price'] ?>€</h5>
                                        <p class="card-text"><?php echo $product_array[$key]['description'] ?></p>
                                    </div>
                                    <div class="card-footer">
                                        <form method="post" action="index.php?action=add&quantidade=1&codigo=<?php echo $product_array[$key]["id"]; ?>">
                                            <!-- Botao de ir para o carrinho -->
                                            <input type="submit" value="Adicionar" class="button btnAddAction" />
                                        </form>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>


    <!-- Shop Cart -->
    <div id="id01" class="w3-modal">
        <div class="w3-modal-content">
            <header class="w3-container w3-teal" style="background-color: #00264d !important;">
                <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                <h2 class="font-weight-bold">Carrinho <i class="fas fa-shopping-cart"></i></h2>
            </header>
            <div id="shopping-cart">
                <?php
                if (isset($_SESSION["cart_item"])) {
                    $total_quantity = 0;
                    $total_price = 0;
                ?>

                    <!-- Tabela. Cabeçalho -->
                    <table class="tbl-cart" cellpadding="10" cellspacing="1">
                        <tbody>
                            <tr>
                                <th class="th-cart" style="text-align:left;color:black;">Nome</th>
                                <th style="text-align:left;color:black;">Codigo</th>
                                <th style="text-align:right;color:black;" width="5%">Quantidade</th>
                                <th style="text-align:right;color:black;" width="10%">Preco por unidade</th>
                                <th style="text-align:right;color:black;" width="10%">Preco</th>
                                <th style="text-align:center;color:black;" width="5%">Remover</th>
                            </tr>
                            <?php
                            foreach ($_SESSION["cart_item"] as $item) {
                                $item_preco = $item["quantidade"] * $item["price"];
                            ?>
                                <tr>
                                    <td style="color:black;"><img src="./images/<?php echo $item["imagem"]; ?>" class="cart-item-image" /><?php echo $item["name"]; ?></td>
                                    <td style="color:black;"><?php echo $item["id"]; ?></td>
                                    <td style="text-align:right;color:black;"><?php echo $item["quantidade"]; ?></td>
                                    <td style="text-align:right;color:black;"><?php echo $item["price"] . "€"; ?></td>
                                    <td style="text-align:right;color:black;"><?php echo number_format($item_preco, 2) . "€"; ?></td>
                                    <td style="text-align:center;color:black;"><a href="index.php?action=remover&codigo=<?php echo $item["id"]; ?>" class="btnRemoverAction"><i class="fa-solid fa-trash" style="color: #a2a1a0;"></i></a></td>
                                </tr>
                            <?php
                                $total_quantity += $item["quantidade"];
                                $total_price += ($item["price"] * $item["quantidade"]);
                            }
                            ?>

                        </tbody>
                    </table>
                    <!-- Footer do carrinho-->
                   <footer class="w3-container w3-teal" style="background-color: #00264d !important;">
    <div class="d-flex justify-content-between">
        <!-- Esvazia o carrinho -->
        <a id="btnEmpty" href="index.php?action=empty" class="text-danger font-weight-bold">Limpar tudo <i class="fas fa-trash-alt"></i></a>
        <p style="text-align: right;">Total: <br>
            <?php echo "Quantidade: " . $total_quantity; ?><br><strong><?php echo "Valor: " . number_format($total_price, 2) . "€"; ?></strong>
        </p>
        <a id="btnPay" href="pagar.php" class="text-success font-weight-bold">Processar encomenda <i class="fas fa-check-square"></i></a>
    </div>
</footer>
                    <!-- se não tiver produtos no carro, da esta sms -->
                <?php
                } else {
                ?>
                    <div class="text-danger font-weight-bold">Ainda não escolheu nenhum produto</div>

                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <!-- Shop Cart FIM -->

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


    <!-- Import From Web Bootstrap 4.6.0 -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>

</html>