<?php
session_start();


class DBConfig {
  private $host = "localhost";
  private $user = "root";
  private $password = "";
  private $database = "cantoinfor";
  private $conn;
  
  function __construct() {
    $this->conn = $this->connectDB();
  }
  
  function connectDB() {
    $conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
    return $conn;
  }
  
  function runQuery($query) {
    $result = mysqli_query($this->conn,$query);
    while($row=mysqli_fetch_assoc($result)) {
      $resultset[] = $row;
    }   
    if(!empty($resultset))
      return $resultset;
  }
  
  function numRows($query) {
    $result  = mysqli_query($this->conn,$query);
    $rowcount = mysqli_num_rows($result);
    return $rowcount; 
  }
}


$dbservidor = "localhost";
$dbutilizador = "root";
$dbpassword = "";
$dbnome = "cantoinfor";

$errors = array();

// Connect to MySqli Server
$db = new mysqli($dbservidor, $dbutilizador, $dbpassword, $dbnome);


// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) {
    array_push($errors, "É necessário um nome!");
  } else if (empty($email)) {
    array_push($errors, "É necessário um email!");
  } else if (empty($password_1)) {
    array_push($errors, "É necessário uma palavra-passe!");
  } else if ($password_1 != $password_2) {
    array_push($errors, "As palavras-passe não combinam!");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Nome já utilizado!");
    } else if ($user['email'] === $email) {
      array_push($errors, "Email já utilizado!");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
    $password = password_hash($password_1,PASSWORD_BCRYPT); //encrypt the password before saving in the database

    $query = "INSERT INTO users (username, email, password) 
          VALUES('$username', '$email', '$password')";
    mysqli_query($db, $query);
    $_SESSION['username'] = $username;
    $_SESSION['success'] = "Estás Loggado!";
    header('location: index.php');
  }
}

// LOGIN USER
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
    array_push($errors, "É necessário um nome!");
  } else if (empty($password)) {
    array_push($errors, "É necessário uma palavra-passe!");
  }

  if (count($errors) == 0) {
    $password = $password;
    $query = "SELECT * FROM users WHERE email='" . $username . "' ";
    $result = mysqli_query($db,$query);
    $row = mysqli_fetch_assoc($result);


    if (count($errors) == 0 && password_verify($password, $row['password'])) {
      $_SESSION['username'] = $username;
      $_SESSION['success'] = "Estás Loggado!";
      $_SESSION['level'] = $row['level'];

      if ($row['level'] == 1) {
        header('location: viewstock.php');
      }else{ 
        header('location: index.php');
      }
    } else {
      array_push($errors, "Nome/palavra-passe incorretos!");
    }
  }
}
//CRIAÇÃO DE GRUPOS POR FAZER

//CRUD BACK-END

//Validate Inputs
function validate($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

//CREATE
if (isset($_POST['create'])){
  $name = validate($_POST['name']);
  $price = validate($_POST['price']);
  $description = validate($_POST['description']);
  $stock = validate($_POST['stock']);
  $category = validate($_POST['category']);
  $imagem = validate($_FILES['imagem']['name']);
  $target = "images/".basename($imagem);

 

  $user_data = 'name=' .$name. 'price=' .$price. 'description=' .$description. 'stock=' .$stock. 'category=' .$category. 'imagem=' .$imagem;

  if (empty($name)) {
      header("Location: createstock.php?error=É necessário um nome&$user_data");  
  }else if (empty($price)) {
      header("Location: createstock.php?error=É necessário uma descrição&$user_data");    
  }else if (empty($description)) {
      header("Location: createstock.php?error=É necessário um preço&$user_data"); 
  }else if (empty($stock)) {
      header("Location: createstock.php?error=É necessário uma quantia&$user_data"); 
  }else if (empty($category)) {
      header("Location: createstock.php?error=É necessário escolher uma category&$user_data"); 
  }else if (empty($imagem)) {
      header("Location: createstock.php?error=É necessário escolher uma imagem&$user_data"); 
  }else{

      $sql = "INSERT INTO produtos(name, price, description, stock, category, imagem)
              VALUES('$name', '$price', '$description', '$stock', '$category', '$imagem')";
      $result = mysqli_query($db, $sql);
      move_uploaded_file($_FILES['imagem']['tmp_name'], $target); 
      if ($result) {
        header("Location: viewstock.php?success=Criado com sucesso!");
      }else {
       header("Location: createstock.php?error=Ocorreu um erro&$user_data");
      }
  }

}

//READ

$sql = "SELECT * FROM produtos ORDER BY id DESC";
$result = mysqli_query($db, $sql);

//UPDATE
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql = "SELECT * FROM produtos WHERE id=$id";
  $result = mysqli_query($db, $sql);

  if (mysqli_num_rows($result)> 0) {
      $row = mysqli_fetch_assoc($result);
 
  }else{
  header("Location: viewstock.php");

}


}
if(isset($_POST['id'])) {
  if(isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $stock = $_POST['stock'];
    $category = $_POST['category'];
    $imagem = validate($_FILES['imagem']['name']);
    $target = "images/".basename($imagem);

    $sql = "UPDATE produtos set name= '".$name."', price= ".$price.", description= '".$description."', stock= ".$stock.", category= '".$category."', 
    imagem='".$imagem."' WHERE id = ".$id;

    mysqli_query($db, $sql);
    
    move_uploaded_file($_FILES['imagem']['tmp_name'], $target); 

    header("Location: viewstock.php");
  }
}

//PRODUTCS EXIBITION

?>