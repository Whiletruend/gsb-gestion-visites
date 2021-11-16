<div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column nav nav-pills flex-sm-column flex-row mb-auto justify-content-between text-truncate">
        <div class='p-2'></div>
            <li class="nav-item">
            <a class="nav-link" href=".">
              <i class="bi bi-house-door fs-5"></i>
                Accueil
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= $this->activePage == 'myRapports' ? 'active' : '' ?>" href="./?action=myRapports&page=1">
              <i class="bi bi-clipboard fs-5"></i>
              Gérer vos rapports
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= $this->activePage == 'myMedics' ? 'active' : '' ?>" href="./?action=myMedics&page=1">
              <i class="bi bi-people fs-5"></i>
              Gérer les médecins
            </a>
          </li>
          <hr>
          <li class="nav-item">
            <a class="nav-link text-secondary <?= $this->activePage == 'myProfile' ? 'active text-white' : '' ?>" href="./?action=myProfile">
              <i class="bi bi-person fs-5"></i>
              Mon Profil
            </a>
          </li>
        <div class='p-2'></div>
        </ul>

 

