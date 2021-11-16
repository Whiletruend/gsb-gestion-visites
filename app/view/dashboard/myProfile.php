<?php
  use App\controller\RapportController;
?>

<!doctype html>
</div>
</nav>



<!-- HTML & PHP Code -->
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">Gérer votre profil</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
    </div>
  </div>

  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Informations relatives à votre compte.</h5>
      <p class="card-text text-muted">Voici un récapitulatif des informations relatives à votre compte utilisateur.</p>
      <hr>
      <div class='row'>
        <h6>Nom et Prénom: <strong><?= $_SESSION['fname_VISITOR'] . ' ' . $_SESSION['lname_VISITOR']; ?></strong></h6>
        <div class='p-1'></div>
        <h6>Adresse: <strong><?= $_SESSION['address_VISITOR']; ?></strong></h6>
        <div class='p-1'></div>
        <h6>Ville + Code Postal: <strong><?= $_SESSION['city_VISITOR'] . ' ' . $_SESSION['cp_VISITOR']; ?></strong></h6>
        <div class='p-1'></div>
        <h6>Date d'embauche: <strong><?= RapportController::dateToFrenchFormat($_SESSION['de_VISITOR']); ?></strong></h6>
      </div>
    </div>
  </div>
  <div class='p-2'> </div>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Section de sécurité</h5>
      <p class="card-text text-muted">Changez facilement votre mot de passe depuis cette section.</p>
      <hr>
      <div class='row mx-auto'>
        <input type='password' class='form-control' placeholder='Mot de passe actuel'>
        <div class='p-2'></div>
        <input type='password' class='form-control' placeholder='Nouveau mot de passe'>
        <div class='p-2'></div>
      </div>
      <div class='p-2'></div>
      <div class='float-end'>
        <button class='btn btn-primary'>Valider les changements</button> 
      </div>
    </div>
  </div>
</main>
<!-- HTML & PHP Code -->



</div>
</div>
</body>
</html>

