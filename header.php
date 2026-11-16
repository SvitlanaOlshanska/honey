<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

$first_name = null;

if(isset($_SESSION["user_id"])){

  $id = $_SESSION["user_id"];
  
 require "connection.php";
 
  if ($stmt = mysqli_prepare($link, 'SELECT first_name FROM user_profile WHERE id_user = ?')) {
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $first_name);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <script src="./assets/js/script.js"></script>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sweet Honey</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
  <link rel="stylesheet" href="./assets/css/stylesheet.css">
</head>
<body>

  <div class="wrapper">
    <nav class="navbar navbar-expand-lg navbar-light fixed-top navbar-custom">
      <div class="container-fluid">
        <a class="navbar-brand" href="./index.php">
          <img src="./assets/img/favicon.png" alt="" width="35" height="29">  Sweet Honey</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto">
              <li class="nav-item">
                <a class="nav-link" href="./lista_prodotti.php">Prodotti</a>
              </li>
            </ul>
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="./list_cart.php"><i class="fas fa-shopping-bag"></i> Carrello</a>
              </li>
              <?php if(!$first_name) { ?>
                <li class="nav-item">
                  <a class="nav-link" href="./login.php"><i class="fas fa-sign-in-alt"></i> Accedi</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="./registration.php"><i class="fas fa-user-plus"></i> Registrati</a>
                </li>
              <?php } else { ?>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <strong>Ciao <?php echo $first_name; ?></strong>
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li>
                      <a class="dropdown-item" href="./show_profile.php"><i class="far fa-user"></i> Profilo</a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="./logout.php"><i class="fas fa-door-open"></i> Esci</a>
                    </li>
                  </ul>
                </li>
              <?php } ?>
            </ul>
          </div>
        </div>
      </nav>
      <main class="main">
