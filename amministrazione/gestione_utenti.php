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
$nome = null;
$cognome = null;
$indirizzo = null;
$tel = null;
$email = null;
$lista_utenti = [];

if ($stmt = mysqli_prepare($link, 'SELECT distinct up.id_user, up.first_name, up.last_name, up.indirizzo, up.tel, u.email FROM user_profile AS up JOIN user AS u  ON up.id_user = u.id LEFT JOIN (SELECT * FROM cart WHERE id_user = ?) AS crt ON crt.id_user = u.id ')) {
	mysqli_stmt_bind_param($stmt, "i", $user_id);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt, $id, $nome, $cognome,$indirizzo,$tel, $email );
	while (mysqli_stmt_fetch($stmt)){
		$lista_utenti[] = [$id,$nome, $cognome, $indirizzo,$tel, $email];
	}
}
?>

<div class="container">
	<form action="gestione_utenti.php" method="post" class="reg_form">
		<div class="row">
			<div class="col-md-8">
				<h1>Lista  Utenti</h1>
				<div class="table-responsive">
					<table class=table>
						<tr>
							<th>Nome</th>
							<th>Cognome</th>
							<th>Indirizzo</th>
							<th>Telefono</th>
							<th>Email</th>
							<th></th>
						</tr>
						<?php foreach($lista_utenti as $row){ ?>
							<tr>
								<td><?= $row[1] ?></td>
								<td><?= $row[2] ?></td>
								<td><?= $row[3] ?></td>
								<td><?= $row[4] ?></td>
								<td><?= $row[5] ?></td>
								<td class="status text-center">
									<a class="btn btn-sm button" href="./rimuovi_utenti.php?id=<?= $row[0] ?>">Rimuovi</button>
									</td>
								</tr>
							<?php } ?>
						</table>
					</div>
				</div>
			</form>
		</div>
		<?php include './../footer_amm.php'; ?>
