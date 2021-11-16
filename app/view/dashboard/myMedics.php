<?php
  use App\controller\MedecinController;

  if(!isset($_GET['page'])) {
    header('Location: ./?action=myMedics&page=1');
  }
?>

<!doctype html>
</div>
</nav>



<!-- HTML & PHP Code -->
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">Gérer vos médecins</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
    </div>
  </div>

  <form action='#' method='POST'>
    <div class='row'>
      <div class='col-10'>
        <input name='medic_Search' type="text" class="form-control" placeholder="Rechecher un médecin..." aria-label="Rechercher un médecin..." required>
      </div>
      
      <div class='col-2'>
        <button class='btn btn-outline-primary px-4' type='submit'><i class="bi bi-search"></i> Rechercher</button>
      </div>
    </div>
  </form>

  <div class='p-2'></div>

  <div class="row">
    <?php if(isset($_GET['search'])) { ?>
      <?php $medics = MedecinController::getMedicsByInfos($_GET['search']); ?>
      <?php foreach($medics as $key => $val) { ?>
        <div class="col-sm-6 mb-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title"><strong><?= $val->getNom() . ' ' . $val->getPrenom(); ?></strong></h5>
              <hr>
              <p class="card-text">Adresse: <span class='text-secondary'><strong><?= $val->getAdresse() ?></strong></span></p>
              <p class="card-text">Numéro de téléphone: <a href='tel:<?= $val->getTel(); ?>' class='text-primary'><strong><?= chunk_split($val->getTel(), 2, ' '); ?></strong></a></p>
              <?php $specialiteComplementaire = $val->getSpecialiteComplementaire(); ?>
              <?php if(empty($specialiteComplementaire)) { ?>
                <p class="card-text">Specialité complémentaire: <span class='text-secondary'><strong>Aucune</strong></span></p>
              <?php } else { ?>
                <p class="card-text">Specialité complémentaire: <span title='Cliquez pour appeler le médecin' class='text-secondary'><strong><?= $val->getSpecialiteComplementaire() ?></strong></span></p>
              <?php } ?>
              <p class="card-text">Département: <span class='text-secondary'>N°<strong><?= $val->getDepartement() ?></strong></span></p>
              <hr/>
              <a href="./?action=myMedics&page=<?= $_GET['page']; ?>&search=<?= $_GET['search']; ?>&editMedic=<?= $val->getID(); ?>" class="btn btn-outline-warning">Modifier les infos</a>
              <div class='float-end'>
                <a href="./?action=myRapports&page=1&medic=<?= $val->getID(); ?>" class="btn btn-primary">Voir les rapports</a>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
    <?php } else { ?>
      <?php $medics = MedecinController::getEveryMedics(); ?>
      <?php foreach($medics as $key => $val) { ?>
        <div class="col-sm-6 mb-3">
        <div class="card">
            <div class="card-body">
              <h5 class="card-title"><strong><?= $val->getNom() . ' ' . $val->getPrenom(); ?></strong></h5>
              <hr>
              <p class="card-text">Adresse: <span class='text-secondary'><strong><?= $val->getAdresse() ?></strong></span></p>
              <p class="card-text">Numéro de téléphone: <a href='tel:<?= $val->getTel(); ?>' class='text-primary'><strong><?= chunk_split($val->getTel(), 2, ' '); ?></strong></a></p>
              <?php $specialiteComplementaire = $val->getSpecialiteComplementaire(); ?>
              <?php if(empty($specialiteComplementaire)) { ?>
                <p class="card-text">Specialité complémentaire: <span class='text-secondary'><strong>Aucune</strong></span></p>
              <?php } else { ?>
                <p class="card-text">Specialité complémentaire: <span title='Cliquez pour appeler le médecin' class='text-secondary'><strong><?= $val->getSpecialiteComplementaire() ?></strong></span></p>
              <?php } ?>
              <p class="card-text">Département: <span class='text-secondary'>N°<strong><?= $val->getDepartement() ?></strong></span></p>
              <hr/>
              <a href="./?action=myMedics&page=<?= $_GET['page']; ?>&editMedic=<?= $val->getID(); ?>" class="btn btn-outline-warning">Modifier les infos</a>
              <div class='float-end'>
                <a href="./?action=myRapports&page=1&medic=<?= $val->getID(); ?>" class="btn btn-primary">Voir les rapports</a>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
    <?php } ?>
  </div>

  <nav aria-label="..." class='float-end'>
    <ul class="pagination">
      <li class="page-item <?= $_GET['page'] == 1 ? 'disabled' : ''; ?>">
        <a class="page-link" href="./?action=myMedics&page=<?= $_GET['page'] - 1; ?>">Précédent</a>
      </li>
      <?php for($i = 1; $i <= MedecinController::$totalPages; $i++) { ?>
        <li class="page-item <?= $_GET['page'] == $i ? 'active' : ''; ?>"><a class="page-link" href="./?action=myMedics&page=<?= $i; ?>"><?= $i ?></a></li>
      <?php } ?>
      <li class="page-item <?= $_GET['page'] == MedecinController::$totalPages ? 'disabled' : ''; ?>">
        <a class="page-link" href="./?action=myMedics&page=<?= $_GET['page'] + 1; ?>">Suivant</a>
      </li>
    </ul>
  </nav>
</main>
<!-- HTML & PHP Code -->

<!-- Modal Edit -->
<?php if(isset($_GET['editMedic'])) { ?>
  <script type="text/javascript">
      $(window).on('load', function() {
          $('#editModal').modal('show');
      });
  </script>

  <?php 
    $medic = MedecinController::getMedicByID($_GET['editMedic']);
  ?>

  <form action='#' method='POST'>  
    <div class="modal fade" id='editModal' tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Modification du médecin <strong><?= $medic->getNom() . ' ' . $medic->getPrenom(); ?></strong></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          
          <div class="modal-body">
            <!-- Nom -->
            <div class='row'>
              <div class='col-6'>
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="bi bi-card-heading fs-5"></i></span>
                  <input name='medic_LNameEdit' type="text" class="form-control" placeholder='Nom' value="<?= $medic->getNom(); ?>" aria-label="Nom" required>
                </div>
              </div>

              <!-- Prénom -->
              <div class='col-6'>
                <div class="input-group  mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="bi bi-card-text fs-5"></i></span>
                  <input name='medic_FNameEdit' type="text" class="form-control" placeholder='Prénom' value="<?= $medic->getPrenom(); ?>" aria-label="Prénom" required>
                </div>
              </div>
            </div>

            <!-- Adresse -->
            <div class='row'>
              <div class='col-6'>
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="bi bi-house fs-5"></i></span>
                  <input name='medic_AdressEdit' type="text" class="form-control" placeholder='Adresse' value="<?= $medic->getAdresse(); ?>" aria-label="Adresse" required>
                </div>
              </div>

              <!-- Téléphone -->
              <div class='col-6'>
                <div class="input-group  mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="bi bi-telephone fs-5"></i></span>
                  <input name='medic_PhoneEdit' type="text" class="form-control" placeholder='Téléphone' maxlength="10" value="<?= $medic->getTel(); ?>" aria-label="Téléphone" required>
                </div>
              </div>
            </div>

            <!-- Specialité Complémentaire -->
            <div class='row'>
              <div class='col-6'>
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="bi bi-journal-medical fs-5"></i></span>
                  <input name='medic_SpeComEdit' type="text" class="form-control" placeholder='Spécialité Complémentaire' value="<?= $medic->getSpecialiteComplementaire(); ?>" aria-label="Spécialité Complémentaire">
                </div>
              </div>

              <!-- Département -->
              <div class='col-6'>
                <div class="input-group  mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="bi bi-pencil-square fs-5"></i></span>
                  <input name='medic_DepartEdit' type="text" class="form-control" placeholder='Département' value="<?= $medic->getDepartement(); ?>" aria-label="Département" required>
                </div>
              </div>
            </div>
          </div>

          <div class="modal-footer">
            <!-- <a href="" dismiss='modal' class='btn btn-outline-danger mr-auto'>Supprimer</a> -->
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            <button type="submit" class="btn btn-primary" name='submit'>Modifier les informations</button>
          </div>
        </div>
      </div>
    </div>
  </form>
<?php } ?>



</div>
</div>
</body>
</html>

