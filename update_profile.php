<?php include 'header.php'; ?>
<?php
if (!isset($_SESSION["user_id"])){
  header("Location: login.php");
  exit;
}

$id = $_SESSION["user_id"];
require "connection.php";

$first_name = null;
$last_name = null;
$indirizzo = null;
$tel = null;
$pass = null;
$conf = null;

if(isset($_POST['firstname'])&& ($_POST['firstname'] != "")) { $first_name = $_POST['firstname']; }
if(isset($_POST['lastname']) && ($_POST['lastname'] != ""))	{ $last_name = $_POST['lastname']; }
if(isset($_POST['indirizzo'])&& ($_POST['indirizzo'] != ""))	{ $indirizzo = $_POST['indirizzo'];}
if(isset($_POST['tel']) && ($_POST['tel'] != ""))  { $tel = $_POST['tel']; }
if(isset($_POST['pass']) && ($_POST['pass'] != "")){ $pass = $_POST['pass'];}
if(isset($_POST['confirm']) && ($_POST['confirm'] != "")){ $conf = $_POST['confirm'];}

$hash = password_hash($pass, PASSWORD_DEFAULT);

if ($pass && $conf && $pass == $conf){
  $query_update_pass = 'UPDATE user SET pass = ? WHERE id = ?';
  if ($stmt = mysqli_prepare($link, $query_update_pass)) {
    mysqli_stmt_bind_param($stmt, "si", $hash, $id);
    mysqli_stmt_execute($stmt);
    echo '<div class="container mt-5"><div class="alert alert-warning" role="alert">'."La modifica della password è stata effettuata con successo.".'</div></div>';
  }
}else if($pass && $conf && $pass != $conf){
  echo '<div class="container mt-5"><div class="alert alert-warning" role="alert">'."Non è andata a buon fine.  Riprova".'</div></div>';
}

if ($first_name && $last_name){

  $query_update_profile = 'UPDATE user_profile SET first_name = ?, last_name = ?, indirizzo =?, tel = ? WHERE id_user = ?';
  if ($stmt = mysqli_prepare($link, $query_update_profile)) {
    mysqli_stmt_bind_param($stmt, "ssssi", $first_name, $last_name,$indirizzo, $tel, $id);
    mysqli_stmt_execute($stmt);
    echo '<div class="container mt-5"><div class="alert alert-warning" role="alert">'."La modifica dei dati personali è stata effettuata con successo.".'</div></div>';

  }
}
if ($stmt = mysqli_prepare($link, 'SELECT up.first_name, up.last_name, up.indirizzo, up.tel FROM user AS u JOIN user_profile AS up ON u.id = up.id_user WHERE u.id = ?')) {
  mysqli_stmt_bind_param($stmt, "i", $id);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $first_name, $last_name,$indirizzo, $tel);
  mysqli_stmt_fetch($stmt);
  mysqli_stmt_close($stmt);
}?>

<div class="container">
  <div class="row">
    <div class="col-md-6">
      <img src="./assets/img/miele.png" alt="Sweet Honey" class="img-fluid">
    </div>
    <div class="col-md-6" >
      <form active="/update_profile.php" method="POST">
        <header class="section-header" >
          <h1 class="mb-4">Aggiorna il tuo profilo</h1>
        </header>
        <div class="mb-3">
          <label for="firstname" class="form-label">Nome</label>
          <input type="text" id="firstname" class="form-control" name="firstname" value="<?php echo $first_name; ?>">
        </div>
        <div class="mb-3">
          <label for="lastname" class="form-label">Cognome</label>
          <input type="text" id="lastname" class="form-control" name="lastname" value="<?php echo $last_name; ?>">
        </div>
        <div class="mb-3">
          <label for="indirizzo" class="form-label">Indirizzo </label>
          <input id="indirizzo" type="text" class="form-control" name="indirizzo" value="<?php echo $indirizzo; ?>" >

        </div>
        <div class="mb-3">
          <label for="tel" class="form-label">Telefono</label>
          <input type="tel" id="tel" class="form-control" name="tel" value="<?php echo $tel; ?>">
        </div>
        <div class="mb-3">
          <label for="pass" class="form-label">Password</label>
          <input type="password" id="pass" class="form-control" name="pass">
        </div>
        <div class="mb-3">
          <label for="confirm" class="form-label">Conferma password</label>
          <input type="password" id="confirm" class="form-control" name="confirm">
        </div>
        <div class="d-grid gap-2 col-6 mx-auto"     >
          <input type="submit" name="submit" class="btn btn-lg button"  value="Aggiorna"   >
        </div>
      </form>
    </div>
  </div>
  <?php include 'footer.php'; ?>
