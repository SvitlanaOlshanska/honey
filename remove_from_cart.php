<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
if (!isset($_SESSION["user_id"])){
  header("Location: login.php");
  exit;
}
$user_id = $_SESSION["user_id"];
require "connection.php";

if(isset($_GET["id_cart"])){
  $id_cart = $_GET["id_cart"];

  $stmt = mysqli_stmt_init($link);
  if (mysqli_stmt_prepare($stmt, 'DELETE FROM cart WHERE id_user=? AND id_cart=?')) {
    mysqli_stmt_bind_param($stmt, "ii", $user_id, $id_cart);
    $res = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($link);
    header("Location: list_cart.php");
    exit;
  }else{
    echo "Si è presentato qualche errore";
    echo mysqli_error($link);
  }
}else{
  echo "Perchè sia soddisfatta la richiesta, mancano dei dati !";
}
?>
