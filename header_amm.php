<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
$first_name = null;

if(isset($_SESSION["user_id"])){
  $id = $_SESSION["user_id"];
  require "../connection.php";
  
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
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sweet Honey</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
  <link rel="stylesheet" href="../assets/css/stylesheet.css">
</head>
<body>

  <div class="wrapper">
    <nav class="navbar navbar-expand-lg navbar-light fixed-top navbar-custom">
      <div class="container-fluid">
        <a class="navbar-brand" href="./">
          <img src="./../assets/img/favicon.png" alt="" width="35" height="29">  Sweet Honey</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto">
              <li class="nav-item">
                <a class="nav-link" href="./../index.php">Continua a navigare  come utente</a>
              </li>
              <li>
                <a class="nav-link" href="./../logout.php"></i> Esci </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <main class="main">
