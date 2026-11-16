<?php include './../header_amm.php'; ?>
<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
if (!isset($_SESSION["user_id"])||($_SESSION["email"]!="admin@honey.com")){
	header("Location: ./../index.php");
	exit;
}
$user_id = $_SESSION["user_id"];

require "../connection.php";

$id = null;
$name = null;
$description = null;
$price=null;
$lista_prodotti = [];

if ($stmt = mysqli_prepare($link, 'SELECT distinct p.id, p.name, p.description, p.price FROM prodotti AS p LEFT JOIN (SELECT * FROM cart WHERE id_user = ?) AS crt ON crt.id_prodotto = p.id ')) {
	mysqli_stmt_bind_param($stmt, "i", $user_id);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt, $id, $name, $description,$price);
	while (mysqli_stmt_fetch($stmt)){
		$lista_prodotti[] = [$id,$name, $description, $price];
	}
}
?>
<div class="container">
	<form action="gestione_prodotti.php" method="post" class="reg_form">
		<div class="row">
			<div class="col-md-8">
				<h1>Lista  Prodotti</h1>
				<div class="table-responsive">
					<table class=table>
						<tr>
							<th class = "th-table-left2">Nome </th>
							<th class = "th-table-left3" > Descrizione prodotto</th>
							<th class = "th-table-right2">		   Prezzo</th>
							<th></th>
						</tr>
						<?php foreach($lista_prodotti as $row){ ?>
							<tr>
								<td><?= $row[1] ?></td>
								<td><?= $row[2] ?></td>
								<td class="table-center"><?php echo "€ ".$row[3]; ?></td>
								<td class="status text-center">
									<a class="btn btn-sm button" href="./rimuovi_prod.php?id=<?= $row[0] ?>">Rimuovi</button>
									</td>
								</tr>
							<?php } ?>
						</table>
					</div>
				</div>
				<div class="col-md-4 " >
					<header class="section-header">
						<h1 class="mb-4">Aggiungi prodotti</h1>
					</header>
					<div class="mb-3">
						<label for="name" class="form-label">Nome</label>
						<input type="text" id="name" name="name" class="form-control">
					</div>
					<div class="mb-3">
						<label for="description" class="form-label">Descrizione</label>
						<input type="text" id="description" name="description" class="form-control">
					</div>
					<div class="mb-3">
						<label for="price" class="form-label">Prezzo</label>
						<input type="text" id="price" name="price" class="form-control">
					</div>
					<div class="mb-3">
						<label for="image" class="form-label">Immagine</label>
						<input type="text" id="image" name="image" class="form-control">
					</div>
					<input type="submit" name="submit" value="Aggiungi" class="btn btn-lg button"> </div>
				</div>
			</div>
		</form>
	</div>

	<?php  $list_require_fild = ["name", "description", "price", "image"];
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
	$nome  = $_POST ["name"];
	$descrizione   = $_POST ["description"];
	$prezzo   = $_POST ["price"];
	$image   = $_POST ["image"];
	$stmt = mysqli_stmt_init($link);
	if (mysqli_stmt_prepare($stmt, 'INSERT INTO prodotti (`name`, `description`,`price`, `image`) VALUES (?,?,?,?)')) {
		mysqli_stmt_bind_param($stmt, "ssss", $nome,$descrizione, $prezzo, $image );
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		echo '<div class="container mt-5"><div class="alert alert-warning" role="alert">'."Complimenti , inserimento è stato effettuato con successo.".'</div></div>';
	}
	?>
	<?php include './../footer_amm.php'; ?>
