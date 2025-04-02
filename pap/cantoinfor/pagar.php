<?php
require_once("server.php");
$db_handle = new dbconfig();
// Cart actions add remover and empty
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
case "add":
if(!empty($_GET["quantidade"])) {
$productByCode = $db_handle->runQuery("SELECT * FROM produtos WHERE id='" . $_GET["codigo"] . "'");
$itemArray = array($productByCode[0]["id"]=>array('name'=>$productByCode[0]["name"], 'id'=>$productByCode[0]["id"], 'quantidade'=>$_GET["quantidade"], 'imagem'=>$productByCode[0]["imagem"], 'price'=>$productByCode[0]["price"]));

if(!empty($_SESSION["cart_item"])) {
if(in_array($productByCode[0]["id"],array_keys($_SESSION["cart_item"]))) {
foreach($_SESSION["cart_item"] as $k => $v) {
if($productByCode[0]["id"] == $k) {
if(empty($_SESSION["cart_item"][$k]["quantidade"])) {
$_SESSION["cart_item"][$k]["quantidade"] = 0;
}
$_SESSION["cart_item"][$k]["quantidade"] += $_GET["quantidade"];
}
}
} else {
$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
}
} else {
$_SESSION["cart_item"] = $itemArray;
}
}
break;
case "remover":
if(!empty($_SESSION["cart_item"])) {
foreach($_SESSION["cart_item"] as $k => $v) {
if($_GET["codigo"] == $_SESSION["cart_item"][$k]["id"])
unset($_SESSION["cart_item"][$k]);
if(empty($_SESSION["cart_item"]))
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
<!-- Cart End -->

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
    <link href="css/style.css" rel="stylesheet" />
    <!-- FontAwesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.js" crossorigin="anonymous"></script>

</head>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark">
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

<!-- Shop Cart -->
<div id="id01" class="w3-modal">
    <div class="w3-modal-content">
      <header class="w3-container w3-teal" style="background-color: #00264d !important;">
        <span onclick="document.getElementById('id01').style.display='none'"
        class="w3-button w3-display-topright">&times;</span>
        <h2 class="font-weight-bold">Carrinho <i class="fas fa-shopping-cart"></i></h2>
      </header>
      <div id="shopping-cart">
<?php
if(isset($_SESSION["cart_item"])){
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
foreach ($_SESSION["cart_item"] as $item){
$item_preco = $item["quantidade"]*$item["price"];
?>
<tr>
<td style="color:black;"><img src="./images/<?php echo $item["imagem"]; ?>" class="cart-item-image" /><?php echo $item["name"]; ?></td>
<td style="color:black;"><?php echo $item["id"]; ?></td>
<td style="text-align:right;color:black;"><?php echo $item["quantidade"]; ?></td>
<td  style="text-align:right;color:black;"><?php echo $item["price"]."€"; ?></td>
<td  style="text-align:right;color:black;"><?php echo number_format($item_preco, 2)."€"; ?></td>
<td style="text-align:center;color:black;"><a href="index.php?action=remover&codigo=<?php echo $item["id"]; ?>" class="btnRemoverAction"><img src="imagens/delete.png" alt="Remover Item" /></a></td>
</tr>
<?php
$total_quantity += $item["quantidade"];
$total_price += ($item["price"]*$item["quantidade"]);
}
?>

</tbody>
</table>
<!-- Footer do carrinho-->
<footer class="w3-container w3-teal" style="background-color: #00264d !important;">
<!-- Esvazia o carrinho -->
<a id="btnEmpty" href="index.php?action=empty" class="text-danger font-weight-bold">Limpar tudo <i class="fas fa-trash-alt"></i></a>
<p style="text-align: right;">Total: <br>
<?php echo "Quantidade: ".$total_quantity; ?><br><strong><?php echo "Valor: ".number_format($total_price, 2)."€"; ?></strong>
</p>
<a id="btnPay" href="pagar.php" class="text-success font-weight-bold">Processar encomenda <i class="fas fa-check-square"></i></a>
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
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados de Facturação</title>
    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
 <!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados de Facturação</title>
    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .container {
            flex: 1;
        }
        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-md-8 order-md-1">
                <h1>Dados de Facturação</h1>
                <form>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName">Nome</label>
                            <input type="text" class="form-control" id="firstName" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName">Último Nome</label>
                            <input type="text" class="form-control" id="lastName" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@</span>
                            </div>
                            <input type="email" class="form-control" id="email" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="address">Morada</label>
                        <input type="text" class="form-control" id="address" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="city">Cidade</label>
                            <input type="text" class="form-control" id="city" required>
                            <div class="invalid-feedback">
                                É necessária a Cidade!
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="zip">Código-Postal</label>
                            <input type="text" class="form-control" id="zip" required>
                            <div class="invalid-feedback">
                                É necessário o Código Postal!
                            </div>
                        </div>
                    </div>
                    <hr class="mb-4">
                    <button class="btn btn-success btn-lg btn-block font-weight-bold" type="submit">Concluir Encomenda <i class="fas fa-check-square"></i></button>
                </form>
            </div>
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Métodos de Pagamento</span>
                </h4>
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="paymentMethod" id="bankTransfer" value="bankTransfer" required>
                            <label class="custom-control-label" for="bankTransfer">Transferência Bancária</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="paymentMethod" id="cashOnDelivery" value="cashOnDelivery" required>
                            <label class="custom-control-label" for="cashOnDelivery">Pagamento à Cobrança</label>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <p style="text-align: right;"><strong>Total: <?php echo $total_price ?>€</strong></p>
                    </li>
                </ul>
                <div class="div1" style="display:none;">
                    <p class="text-success">Dados para o pagamento:<br>
                    NIB: PT50.0046.0345.881000567819-1</p>
                    <br><br>
                    <h5 class="text-danger">IMPORTANTE!</h5>
                    <p>Ao concluir a transferência envie o comprovativo para o seguinte email: cantoinfor@gmail.com</p>
                </div>
                <div class="div2" style="display:none;">
                    <h5 class="text-danger">Informações Adicionais!</h5>
                    <p>A entrega será feita no prazo de 5-7 dias úteis. Poderá sempre recorrer aos nossos contactos para esclarecimento de dúvidas:<br>+351 296 642 127<br>cantoinfor@gmail.com</p>
                </div>
            </div>
        </div>
    </div>

    <br><br><br>
    <!-- Footer -->
    <footer class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-4 col-xs-12">
                    <h3>Contactos</h3>
                    <ul>
                        <li>Canto Informático</li>
                        <li>+351 296 642 127</li>
                        <li>cantoinfor@gmail.com</li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <h3>Links Úteis</h3>
                    <ul>
                        <li><a href="local.php">Localização</a></li>
                        <li><a href="index.php">Homepage</a></li>
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

    <!-- Bootstrap core JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS -->
    <script src="js/scripts.js"></script>
</body>
</html>