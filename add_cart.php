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

if(isset($_GET["id"])){
  $id_prodotto = $_GET["id"];

  
  $stmt = mysqli_stmt_init($link);

  if (mysqli_stmt_prepare($stmt, 'INSERT INTO cart(`id_user`, `id_prodotto`) VALUES (?,?)')) {
    mysqli_stmt_bind_param($stmt, "ii", $user_id, $id_prodotto);
    $res = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($link);
    header("Location: lista_prodotti.php");
  }else{
    echo "Si è presentato qualche errore...";
  }
}else{
  echo "Perchè sia soddisfatta la richiesta, mancano dei dati !";
}
?>
