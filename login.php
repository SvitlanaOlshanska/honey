<?php include 'header.php'; ?>

<?php
$email  = null;
$pass   = null;
if (isset($_POST["email"]) && isset($_POST["pass"])){
  $email = $_POST["email"];
  $pass = $_POST["pass"];
}

if ($email && $pass) {
  require "connection.php";
  
  

  $pass_db = null;
  $user_id = null;

  if ($stmt = mysqli_prepare($link, 'SELECT id, pass FROM user WHERE email = ?')) {
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $user_id, $pass_db);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    if( password_verify($pass, $pass_db )){
      $_SESSION["user_id"] = $user_id;
	   $_SESSION["email"] = $email;
      header("Location: index.php");
      exit;
    }
  }
}?>

<section class="section">
  <div class="container">
    <form action="login.php" method="post" class="reg_form">
      <div class="row">
        <div class="col-md-6">
          <img src="./assets/img/miele.png" alt="Sweet Honey" class="img-fluid">
        </div>
        <div class="col-md-6">
          <header class="section-header">
            <h1 class="mb-4">Accedi</h1>
          </header>
          <?php if ($email && $pass) { ?>
            <?php if($pass_db != $pass) { ?>
              <div class="alert alert-danger" role="alert">
                <p>password o email errati</p>
              </div>
            <?php } ?>
          <?php } else { ?>
            <div class="alert alert-warning" role="alert">
              <p> Inserisci email e password</p>
            </div>
          <?php } ?>

          <div class="mb-4">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control">
          </div>
          <div class="mb-4">
            <label for="pass" class="form-label">Password</label>
            <input type="password" id="pass" name="pass" class="form-control">
          </div>
          <div class="d-grid gap-2 col-6 mx-auto"  >
            <input type="submit" name="submit" value="Accedi" class="btn btn-lg button">
          </div>
        </div>
      </div>
    </form>
  </div>
</section>
<?php include 'footer.php'; ?>
