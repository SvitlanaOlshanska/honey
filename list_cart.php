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

$id = null;
$name = null;
$price = null;
$id_cart = null;

$lista_prodotti = [];

if ($stmt = mysqli_prepare($link, 'SELECT p.id, p.name, p.price, crt.id_cart FROM prodotti AS p JOIN (SELECT * FROM cart WHERE id_user = ?) AS crt ON crt.id_prodotto = p.id')) {
  mysqli_stmt_bind_param($stmt, "i", $user_id);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $id, $name,$price,$id_cart);
  while (mysqli_stmt_fetch($stmt)){
    $lista_prodotti[] = [$id, $name, $price,$id_cart];
  }
} ?>

<div class="container">
  <h1>Carrello</h1>

  <?php if($lista_prodotti) {
    $total_price = 0;
    ?>

    <div class="table-responsive">
      <table class="tbl-cart" cellpadding="20" cellspacing="1">
        <tbody>
          <tr>
            <th class ="th-table-right1">Nome prodotto</th>
            <th class = "th-table-right1">		   Prezzo</th>
            <th class = "th-table-center">		   Rimuovi</th>
          </tr>

          <?php foreach($lista_prodotti as $row){ ?>
            <tr>
              <td class="table-right1"> <?php echo $row[1]; ?> </td>
              <td class="table-right1"> <?php echo "€ ".$row[2]; ?></td>
              <td class="status text-center">
                <a class="btn btn-sm button" href="./remove_from_cart.php?id_cart=<?= $row[3] ?>">Rimuovi dal carrello</i></a>
              </td>
            </tr>
            <?php
            $total_price += $row[2];
          } ?>
          <tr>
            <td colspan="2" align="right">Total:</td>
            <td align="right" colspan="2"><strong><?php echo "€ ".number_format($total_price, 2); ?></strong></td>
            <td></td>
          </tr>
        </tbody>
      </table>
    </div>
  <?php } else { ?>
    <div class="alert alert-warning" role="alert">
      <h4>Il tuo carrello è vuoto</h4>
    </div>
  <?php } ?>
</div>
<?php include 'footer.php'; ?>
