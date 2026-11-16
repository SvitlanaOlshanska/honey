<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
if (!isset($_SESSION["user_id"])){
  header("Location: ../index.php");
  exit;
}

if(isset($_GET["id"])){
  $id_utente = $_GET["id"];
  
require "../connection.php";

  $stmt = mysqli_stmt_init($link);
  if (mysqli_stmt_prepare($stmt, 'DELETE FROM user WHERE  id=?')) {
    mysqli_stmt_bind_param($stmt, "i",  $id_utente);
    $res = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($link);
    header("Location: gestione_utenti.php");
    exit;
  }else{
    echo "Si è presentato qualche errore";
    echo mysqli_error($link);
  }
}else{
  echo "Perchè sia soddisfatta la richiesta, mancano dei dati !";
}
?>
