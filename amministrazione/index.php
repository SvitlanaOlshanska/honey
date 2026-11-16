<?php include './../header_amm.php'; ?>

<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
if (!isset($_SESSION["user_id"])||($_SESSION["email"])!="admin@honey.com"){
  header("Location: ../index.php");
  exit;
}
?>

<div class="container">
  <section class="section">
    <header class="section-header">
      <!-- text-uppercase tutte lettere maiuscole ,  mb-5 - margin-bottom  -->
      <h3 class="text-uppercase mb-5 table-center table-color">  Ciao <?php echo $first_name; ?> , sei nell'area amministrativa. Scegli l'operazione che desideri effettuare</h3>
    </header>
    <!-- appriamo la riga    -->
    <div class="row">
      <div class="col-md-4"> <!-- appriamo le colonne (4 / 12)    -->
        <div class="card h-100 row-img">
          <img src="../assets/img/images.jpg" width="200" height="120">
          <div class="card-body ">
            <h5 class="card-title table-left1">Gestione Prodotti</h5>
            <p>Qui puoi aggiungere e rimuovere i prodotti in vendita</p>
            <div class="mt-6">
              <div class="row">
                <a class="btn btn-lg button" href="./gestione_prodotti.php"> Accedi</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card h-100 row-img">
          <img src="../assets/img/utenti.jpg" alt="" width="200" height="120">
          <div class="card-body">
            <h5 class="card-title table-left1">Gestione Utenti</h5>
            <p>Qui puoi visualizzare e rimuovere gli utenti registrati</p>
            <div class="mt-6">
              <div class="row">
                <a class="btn btn-lg button"   href="./gestione_utenti.php" > Accedi</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card h-100 row-img">
          <img src="../assets/img/newsletter.jpg" alt="" width="200" height="120">
          <div class="card-body">
            <h5 class="card-title table-left1">Gestione Newsletter</h5>
            <p>Qui puoi inviare newsletter agli utenti sottoscritti</p>
            <div class="mt-6">
              <div class="row">
                <a class="btn btn-lg button" > Accedi</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php include './../footer_amm.php'; ?>
