<?php
session_start();
if ($_SESSION["level"] != 1) {
  header("Location: index.php");
  exit();
}
//DELETE
if (isset($_GET['id'])) {
  include "server.php";

  $id = validate($_GET['id']);

  $sql = "DELETE FROM produtos WHERE id=$id";
  $result = mysqli_query($db, $sql);
  if ($result) {
    header("Location: viewstock.php?success=Removido com Sucesso!");
  } else {
    header("Location: viewstock.php?id=$id&error= Erro desconhecido&$user_data");
  }
} else {
  header("Location: viewstock.php");
}
