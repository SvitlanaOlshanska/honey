
<?php

if (isset($_GET["email"])){

  $email = $_GET["email"];

  require "connection.php";

  if($stmt = mysqli_prepare($link, 'SELECT id, pass FROM user WHERE email = ?'))  {
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    if ( mysqli_stmt_num_rows($stmt) == 1)
    echo"Ci dispice, l'email da lei inserita non è stata accettata. Riprova";
    else echo"Siamo felici di averti con noi. E' importante che i tuoi dati siano corretti, ci serviranno per poter interagire. La tua password deve avere almeno 5 caratteri. ";


    mysqli_stmt_close($stmt);
  }

}
?>
