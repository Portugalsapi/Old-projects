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
<html lang="pt">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Canto Informático - Loja Online</title>
    <link rel="icon" type="image/x-icon" href="images/logo1.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .navbar {
            background-color: #00264d !important;
        }
        .navbar a {
            color: white !important;
        }
        .container1 {
            padding: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        h1, h2 {
            color: #00264d;
        }
        .map-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
        }
        .map-container iframe {
            width: 500px;
            height: 500px;
            border-radius: 15px;
            border: 2px solid #ccc;
        }
        footer {
            background-color: #00264d;
            color: white;
            padding: 10px 0;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
        footer ul {
            list-style: none;
            padding: 0;
        }
        footer ul li {
            margin-bottom: 10px;
        }
        .social-icons a {
            margin-right: 15px;
            color: white;
            font-size: 24px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="images/loginlogo.png" height="50px">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Loja</a></li>
                    <li class="nav-item"><a class="nav-link" href="local.php">Localização</a></li>
                    <li class="nav-item"><button class="btn btn-link nav-link" onclick="document.getElementById('id01').style.display='block'">Carrinho</button></li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Mapa -->
    <div class="container1 text-center">
        <h1>Mapa</h1>
        <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12619.033658093069!2d-25.6047656!3d37.7488115!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x1d1b1a517e2c511a!2sCanto%20%26%20Arte!5e0!3m2!1spt-PT!2spt!4v1623236881451!5m2!1spt-PT!2spt" allowfullscreen></iframe>
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h3>Contactos</h3>
                    <p>Canto Informático</p>
                    <p>+351 296 642 127</p>
                    <p>cantoinfor@gmail.com</p>
                </div>
                <div class="col-md-4">
                    <h3>Links Úteis</h3>
                    <ul>
                        <li><a href="local.php" class="text-light">Localização</a></li>
                        <li><a href="index.php" class="text-light">Homepage</a></li>
                    </ul>
                </div>
                <div class="col-md-4 social-icons">
                    <h3>Social</h3>
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


