<?php include 'header.php'; ?>
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

if(!isset($_GET["question"])){
  header("Location: login.php");
  exit;
}

$question = "%".$_GET["question"]."%";
$questionText = $_GET["question"];


$id = null;
$name = null;
$description = null;
$price = null;
$image = null;
$lista_prodotti = [];

if ($stmt = mysqli_prepare($link, 'SELECT  distinct p.id ,p.name, p.description,p.price, p.image FROM prodotti AS p LEFT JOIN (SELECT * FROM cart WHERE id_user = ?) AS crt ON crt.id_prodotto = p.id WHERE (p.name LIKE ? )')) {
  mysqli_stmt_bind_param($stmt, "is", $user_id, $question);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $id, $name,$description, $price, $image);
  while (mysqli_stmt_fetch($stmt)){
    $lista_prodotti[] = [$id,$name, $description, $price,$image];
  }
}?>

<div class="container">
  <h1>Cerca</h1>
  <div class="row mb-5">
    <div class="col-md-8 offset-md-2">
      <form action="./search.php" method="get">
        <div class="input-group">
          <input type="text" name="question" class="form-control" placeholder="Cerca prodotto " value="<?= $questionText ?>">
          <input type="submit" class="btn button" value="Cerca">
        </div>
      </form>
    </div>
  </div>
  <div class="table-responsive">
    <div class="table-responsive">
      <table class="tbl-cart" cellpadding="20" cellspacing="1">
        <tbody>
          <tr>
            <th class = "th-table-left1">Nome prodotto</th>
            <th class = "table-left table-color" > Descrizione prodotto</th>
            <th class = "th-table-right">		   Prezzo</th>
            <th class = "th-table-center">		   Acquista</th>
          </tr>

          <?php foreach($lista_prodotti as $row){ ?>
            <tr>
              <td class="table-center"> <?php echo $row[1]; ?>
                <img src="<?php echo $row[4]; ?>" class="cart-item-image product-image row-img img" />
              </td>
              <td class="table-left"> <?php echo $row[2]; ?></td>
              <td class="table-right"><?php echo "€ ".$row[3]; ?></td>
              <td class="status text-center">
                <a class="btn btn-lg button " href="./add_cart.php?id=<?= $row[0] ?>">Acquista</a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <?php include 'footer.php'; ?>
