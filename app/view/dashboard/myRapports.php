<?php
  use App\controller\RapportController;
  use App\controller\MedecinController;
  use App\controller\MedicamentController;

  if(!isset($_GET['page'])) {
    header('Location: ./?action=myRapports&page=1');
  }
?>

<!doctype html>
</div>
</nav>

<script type="text/javascript">
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>



<!-- HTML & PHP Code -->
<head>
</head>


<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">Gérer vos rapports</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
    </div>
  </div>

  <button type='button' class='btn btn-outline-primary float-right' data-bs-toggle='modal' data-bs-target='#createNewRapport'>Créer un nouveau rapport</button>
  
  <div class='float-end'>
      <button type='button' class='btn btn-outline-warning' data-bs-toggle='modal' data-bs-target='#editChooseDateModal'>Modifier un rapport existant</button>
  </div>

  <div class='p-2'></div>
  <div class="table-responsive">
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope='col'>Médecin</th>
          <th scope="col">Date</th>
          <th scope="col">Motif</th>
          <th scope="col">Bilan</th>
          <th scope='col'></th>
        </tr> 
      </thead>
      <tbody>
      <?php if(isset($_GET['date'])) { ?>
        <?php $rapports = RapportController::getRapportByDateAndID($_GET['date'], $_SESSION['id_VISITOR']); ?>
        <?php if(!empty($rapports)) { ?> 
          <?php foreach($rapports as $key => $val) { ?>
            <?php $medecin = MedecinController::getMedicByID($val->getIDMedecin()); ?>
            <tr>
                <td><?= $val->getID(); ?></td>
                <td><?= $medecin->getNom() . ' ' . $medecin->getPrenom(); ?></td>
                <td><?= $val->getDate(); ?></td>
                <td><?= $val->getBilan(); ?></td>
                <td><?= $val->getMotif(); ?></td>
                <td><a href='./?action=myRapports&page=<?= $_GET['page']; ?>&date=<?= $_GET['date']; ?>&editRapport=<?= $val->getID(); ?>'>Éditer</a></td>
            </tr>
          <?php } ?>
        <?php } else { ?>
          <div class='p-1'></div>
          <h5>Vous n'avez aucun rapport(s) à cette date.</h5>
          <div class='p-2'></div>
        <?php } ?>
      <?php } elseif(isset($_GET['medic'])) { ?>
        <?php $rapports = RapportController::getEveryRapportOfAMedic($_GET['medic'], $_SESSION['id_VISITOR']); ?>
        <?php foreach($rapports as $key => $val) { ?>
          <?php $medecin = MedecinController::getMedicByID($val->getIDMedecin()); ?>
          <tr>
              <td><?= $val->getID(); ?></td>
              <td><?= $medecin->getNom() . ' ' . $medecin->getPrenom(); ?></td>
              <td><?= $val->getDate(); ?></td>
              <td><?= $val->getBilan(); ?></td>
              <td><?= $val->getMotif(); ?></td>
              <td><a href='./?action=myRapports&page=<?= $_GET['page']; ?>&editRapport=<?= $val->getID(); ?>'>Éditer</a></td>
          </tr>
        <?php } ?>
      <?php } else { ?>
        <?php $rapports = RapportController::getEveryRapportFrom($_SESSION['id_VISITOR']); ?>
        <?php foreach($rapports as $key => $val) { ?>
          <?php $medecin = MedecinController::getMedicByID($val->getIDMedecin()); ?>
          <tr>
              <td><?= $val->getID(); ?></td>
              <td><?= $medecin->getNom() . ' ' . $medecin->getPrenom(); ?></td>
              <td><?= $val->getDate(); ?></td>
              <td><?= $val->getBilan(); ?></td>
              <td><?= $val->getMotif(); ?></td>
              <td><a href='./?action=myRapports&page=<?= $_GET['page']; ?>&editRapport=<?= $val->getID(); ?>'>Éditer</a></td>
          </tr>
        <?php } ?>
      <?php } ?>
      </tbody>
    </table>

    <nav aria-label="..." class='float-end'>
      <ul class="pagination">
        <li class="page-item <?= $_GET['page'] == 1 ? 'disabled' : ''; ?>">
          <a class="page-link" href="./?action=myRapports&page=<?= $_GET['page'] - 1; ?>">Précédent</a>
        </li>
        <?php for($i = 1; $i <= RapportController::$totalPages; $i++) { ?>
          <li class="page-item <?= $_GET['page'] == $i ? 'active' : ''; ?>"><a class="page-link" href="./?action=myRapports&page=<?= $i; ?>"><?= $i ?></a></li>
        <?php } ?>
        <li class="page-item <?= $_GET['page'] == RapportController::$totalPages ? 'disabled' : ''; ?>">
          <a class="page-link" href="./?action=myRapports&page=<?= $_GET['page'] + 1; ?>">Suivant</a>
        </li>
      </ul>
    </nav>
  </div>
</main>
<!-- HTML & PHP Code -->

<!-- Modal Create -->
<form action='#' method='POST'>  
  <div class="modal fade" id="createNewRapport" tabindex="-1" aria-labelledby="createNewRapport" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createNewRapport">Création d'un nouveau rapport</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <!-- Select Medics -->
          <div class="input-group  mb-3">
            <label class="input-group-text" for="inputGroupSelect01"><i class="bi bi-person fs-5"></i></label>
            <select name='rapport_Medic' class="form-select">
              <option selected disabled>Sélectionnez un médecin</option>
              <?php foreach(MedecinController::getEveryMedics() as $key => $val) { ?> 
                <option value="<?= $val->getID() ?>"><?= $val->getNom() . ' ' . $val->getPrenom(); ?></option>
              <?php } ?>
            </select>
          </div>

          <!-- Motif -->
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-clipboard fs-5"></i></span>
            <input name='rapport_Motif' type="text" class="form-control" placeholder="Motif" aria-label="Motif" required>
          </div>

          <!-- Bilan -->
          <div class="input-group  mb-3">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-journal-medical fs-5"></i></span>
            <input name='rapport_Bilan' type="text" class="form-control" placeholder="Bilan" aria-label="Bilan" required>
          </div>

          <!-- Date -->      
          <div class="input-group  date" data-date-format="dd-mm-yyyy">
            <span class="input-group-text" id="rapport_Calendar"><i class="bi bi-calendar fs-5"></i></span>
            <input name='rapport_Date' type="text" class="form-control" placeholder="Sélectionnez une date" required>
            <div class="input-group-addon"></div>
          </div>

          <div class='p-1'></div>
          <hr>
          <small class='text-danger'>L'ajout d'un échantillon est <strong>optionnel</strong>.</small>
          <div class='p-1'></div>

          <!-- Choose the meds -->
          <div class='row'>
            <div class='col-6'>
              <div class="input-group  mb-3">
                <label class="input-group-text" for="inputGroupSelect01"><i class="bi bi-bandaid fs-5"></i></label>
                <select name='rapport_Medication[]' class='form-select'>
                  <option selected disabled>Médicament...</option>
                  <?php foreach(MedicamentController::getEveryMedications() as $key => $val) { ?> 
                    <option value='<?= $val->getID() ?>'><?= $val->getNomCommercial(); ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>

            <!-- Quantity of meds -->
            <div class='col-6'>
              <div class="input-group ">
                <span class="input-group-text" id="basic-addon1"><i class="bi bi-cart-plus fs-5"></i></span>
                <input name='rapport_Quantity[]' type="text" onkeypress='return checkIfNumeric(event)' class="form-control" placeholder="Quantité" aria-label="Quantité" aria-describedby="basic-addon1">
                <script>
                  function checkIfNumeric(evt) { 
                      var ASCIICode = (evt.which) ? evt.which : evt.keyCode;
                      if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) {
                          return false; 
                      }
                      return true; 
                  }        
                </script>
              </div>
            </div>
          </div>

          <div id="rapport_newMedicationRow"></div>
          <button id="rapport_addMedicationRow" type="button" class="btn btn-outline-success">+ Ajouter un médicament</button>

          <script type="text/javascript">
            // Add Medication Row
            $("#rapport_addMedicationRow").click(function () {
                var html = '';
                html += "<div id='rapport_MedicationRow'>";
                html += "<div class='row'>";
                html += "<div class='col-6'>";
                html += "<div class='input-group mb-3'>";
                html += "<label class='input-group-text' for='inputGroupSelect01'><i class='bi bi-bandaid fs-5'></i></label>";
                html += "<select name='rapport_Medication[]' class='form-select'>";
                html += "<option selected disabled>Médicament...</option>";
                html += "<?php foreach(MedicamentController::getEveryMedications() as $key => $val) { ?>";
                html += "<option value='<?= $val->getID() ?>'><?= $val->getNomCommercial(); ?></option>";
                html += "<?php } ?>";
                html += "</select>";
                html += "</div>";
                html += "</div>";

                html += "<div class='col-6'>";
                html += "<div class='input-group mb-3'>";
                html += "<span class='input-group-text' id='groupIcon'><i class='bi bi-cart-plus fs-5'></i></span>";
                html += "<input name='rapport_Quantity[]' type='text' class='form-control' placeholder='Quantité' aria-label='Quantité' aria-describedby='groupIcon'>";
                html += "<button id='rapport_RemoveRow' type='button' class='btn btn-danger col-2'>-</button>";
                html += "</div>";
                html += "</div>";

                html += "</div>";
                html += "</div>";

                $('#rapport_newMedicationRow').append(html);
            });

            // Remove Medication
            $(document).on('click', '#rapport_RemoveRow', function () {
                $(this).closest('#rapport_MedicationRow').remove();
            });
          </script>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
          <button type="submit" class="btn btn-primary" name='submit'>Ajouter le rapport</button>
        </div>
      </div>
    </div>
  </div>
</form>


<!-- Modal Edit -->
<?php if(isset($_GET['editRapport'])) { ?>
  <script type="text/javascript">
      $(window).on('load', function() {
          $('#editModal').modal('show');
      });
  </script>

  <?php 
    $rapport = RapportController::getRapportByID($_GET['editRapport']); 
    $medic = MedecinController::getMedicByID($rapport->getIDMedecin());
  ?>

  <form action='#' method='POST'>  
    <div class="modal fade" id='editModal' tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Modification du rapport <strong>N°<?= $_GET['editRapport']; ?></strong></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          
          <div class="modal-body">
            <!-- Select Medics -->
            <div class="input-group  mb-3">
              <label class="input-group-text" for="inputGroupSelect01"><i class="bi bi-person fs-5"></i></label>
              <select name='rapport_Medic' class="form-select" disabled>
                <option selected><?= $medic->getNom() . ' ' . $medic->getPrenom(); ?></option>
              </select>
            </div>

            <!-- Motif -->
            <div class="input-group mb-3">
              <span class="input-group-text" id="basic-addon1"><i class="bi bi-clipboard fs-5"></i></span>
              <input name='rapport_Motif_edit' type="text" class="form-control" placeholder='Motif' value="<?= $rapport->getMotif(); ?>" aria-label="Motif" required>
            </div>

            <!-- Bilan -->
            <div class="input-group  mb-3">
              <span class="input-group-text" id="basic-addon1"><i class="bi bi-journal-medical fs-5"></i></span>
              <input name='rapport_Bilan_edit' type="text" class="form-control" placeholder='Bilan' value="<?= $rapport->getBilan(); ?>" aria-label="Bilan" required>
            </div>

            <!-- Date -->      
            <div class="input-group  date" data-date-format="dd-mm-yyyy">
              <span class="input-group-text" id="rapport_Calendar"><i class="bi bi-calendar fs-5"></i></span>
              <input name='rapport_Date' type="text" class="form-control" placeholder="<?= RapportController::dateToFrenchFormat($rapport->getDate()); ?>" disabled>
              <div class="input-group-addon"></div>
            </div>
          </div>

          <div class="modal-footer">
            <!-- <a href="" dismiss='modal' class='btn btn-outline-danger mr-auto'>Supprimer</a> -->
            <a href='./?action=myRapports&page=<?= $_GET['page']; ?>&delete=<?= $_GET['editRapport']; ?>'><button type='button' class='btn btn-outline-danger' data-bs-dismiss='modal'>Supprimer</button></a>
            <div class='px-5'></div>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            <button type="submit" class="btn btn-primary" name='submit'>Modifier le rapport</button>
          </div>
        </div>
      </div>
    </div>
  </form>
<?php } ?>


<!-- Modal Date Choosing -->
<form action='#' method='POST'>  
  <div class="modal fade" id='editChooseDateModal' tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Choix de la date du rapport</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        
        <div class="modal-body">
          <!-- Date -->      
          <div class="input-group date" data-date-format="dd-mm-yyyy">
            <span class="input-group-text" id="rapport_Calendar"><i class="bi bi-calendar fs-5"></i></span>
            <input name='rapport_EditDate' type="text" class="form-control" placeholder="Choisissez la date du rapport à modifier">
            <div class="input-group-addon"></div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
          <button type="submit" class="btn btn-primary" name='submit'>Valider</button>
        </div>
      </div>
    </div>
  </div>
</form>

<script src="https://cpwebassets.codepen.io/assets/common/stopExecutionOnTimeout-1b93190375e9ccc259df3a57c1abc0e64599724ae30d7ea4c6877eb615f89387.js"></script>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/js/bootstrap-datepicker.min.js'></script>
<script id="rendered-js">
  $('.input-group.date').datepicker({ format: "dd-mm-yyyy" });
</script>

</div>
</div>
</body>
</html>

