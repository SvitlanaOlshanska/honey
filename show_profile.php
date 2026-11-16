<?php include 'header.php'; ?>
<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}


if (!isset($_SESSION["user_id"])){
  header("Location: login.php");
  exit;
}

$id = $_SESSION["user_id"];
require "connection.php";

$email = null;
$first_name = null;
$last_name = null;
$indirizzo=null;
$tel = null;
if ($stmt = mysqli_prepare($link, 'SELECT u.email, up.first_name, up.last_name,up.indirizzo, up.tel FROM user AS u JOIN user_profile AS up ON u.id = up.id_user WHERE u.id = ?')) {
  mysqli_stmt_bind_param($stmt, "i", $id);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $email, $first_name, $last_name, $indirizzo, $tel);
  mysqli_stmt_fetch($stmt);
  mysqli_stmt_close($stmt);
}
?>
<div class="container">
  <div class="row">
    <div class="col-md-6">
      <img src="./assets/img/miele.png" alt="Sweet Honey" class="img-fluid">
    </div>

    <div class="col-md-4 cart-profile-image" >
      <header class="section-header"> <h1 class="mb-4">Profilo</h1> </header>
      <div class="card row-ul">

        <div class="card-body">
          <h5 class="card-title text-center"><?= $first_name . ' ' .$last_name; ?></h5>
        </div>
        <ul class="list-group list-group-flush ">
          <li class="list-group-item d-flex justify-content-between align-items-center "><i class="fas fa-at"></i><?= $email; ?></li>
          <li class="list-group-item d-flex justify-content-between align-items-center"><i class="fas fa-phone"></i> <?= $tel; ?></li>
          <li class="list-group-item d-flex justify-content-between align-items-center"><i class="fa fa-home"></i> <?= $indirizzo; ?></li>
        </ul>
        <div class="card-body text-center">
          <a href = "./update_profile.php" class="btn btn-link"> <i class="fas fa-user-edit card-link  "></i> <strong> Aggiorna il tuo profilo</strong></a>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include 'footer.php'; ?>
