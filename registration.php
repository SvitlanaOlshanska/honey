<?php include 'header.php'; ?>

<div class="container">
  <form action="registration.php" method="post" class="reg_form">
    <div class="row">
      <div class="col-md-6">
        <img src="./assets/img/miele.png" alt="Sweet Honey" class="img-fluid">
      </div>
      <div class="col-md-6">
        <header class="section-header">
          <h1 class="mb-4">Registrati</h1>
        </header>
        <div class="mb-3">
          <label for="firstname" class="form-label">Nome</label>
          <input type="text" id="firstname" name="firstname" class="form-control">
        </div>
        <div class="mb-3">
          <label for="lastname" class="form-label">Cognome</label>
          <input type="text" id="lastname" name="lastname" class="form-control">
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email </label>
          <input type="email" id="email" name="email" required onchange="checkEmail();" class="form-control">
        </div>
        <div class="mb-3">
          <label for="pass" class="form-label">Inserisci  la password</label>
          <input type="password" name="pass" class="form-control" id="pass">
        </div>
        <div class="mb-5">
          <label for="confirm" class="form-label">Conferma  la  password</label>
          <input type="password" name="confirm" class="form-control" id="confirm">
        </div>
        <div class="d-grid gap-2 col-6 mx-auto" >
          <input type="submit" name="submit" onclick="checkdata()"  value="Registrati" class="btn btn-lg button"> </div>
        </div>
      </div>
    </form>
    <script src="./assets/js/script.js"></script>
  </div>

  <?php
  $list_require_fild = ["firstname", "lastname", "email", "pass", "confirm"];
  $erore_msg = "Inserisci i dati ";
  $err = false;

  foreach($list_require_fild as $item){
    if(!isset($_POST[$item]) || $_POST[$item] == ""){
      $erore_msg.=$item;
      $erore_msg.=" ";
      $err = true;
    }
  }
  if ($err){
    echo '<div class="container mt-5"><div class="alert alert-warning" role="alert">'.$erore_msg.'</div></div>';
    exit;
  }
  $firtsname  = $_POST ["firstname"];
  $lastname   = $_POST ["lastname"];
  $email      = $_POST ["email"];
  $pass       = $_POST ["pass"];
  $conf_pass  = $_POST ["confirm"];
  

  if ($email && $pass ){
    require "connection.php";

	if ($pass !=  $conf_pass ){
    echo '<div class="container mt-5"><div class="alert alert-warning" role="alert">'."Password e conferma password non corrispondono. Riprova".'</div></div>';
    exit;
  	}

    if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
      echo '<div class="container mt-5"><div class="alert alert-warning" role="alert">'."Email non è valida. Riprova ".'</div></div>';
      exit;
    }

    $hash=password_hash($pass, PASSWORD_DEFAULT);
    $stmt = mysqli_stmt_init($link);
	
    if (mysqli_stmt_prepare($stmt, 'INSERT INTO user (`email`, `pass`) VALUES (?,?)')) {
      mysqli_stmt_bind_param($stmt, "ss", $email,$hash);
      mysqli_stmt_execute($stmt);
      if(mysqli_affected_rows($link)!=1){
        echo '<div class="container mt-5"><div class="alert alert-warning" role="alert">'."Impossibile registrarsi con le credenziali inserite. Riprova con altre credenziali".'</div></div>';
        exit;
      }
      mysqli_stmt_close($stmt);
    }

    $stmt = mysqli_stmt_init($link);
    $indirizzo = null;
    $tel  = null;
    $id_user = mysqli_insert_id($link);
    if (mysqli_stmt_prepare($stmt, 'INSERT INTO user_profile (`first_name`, `last_name`, `indirizzo`, `tel`, `id_user`) VALUES (?,?,?,?,?)')) {
      mysqli_stmt_bind_param($stmt, "ssssi", $firtsname, $lastname,$indirizzo, $tel, $id_user);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
    echo '<div id="container mt-5"><div class="alert alert-warning" role="alert">'."Complimenti , la registrazione è stata effettuata con successo.".'</div></div>';
  }?>

  <?php include 'footer.php'; ?>
