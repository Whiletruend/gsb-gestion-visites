<?php
    if(!isset($_SESSION)) { session_start(); }
    use App\controller\LoginController;
    use App\controller\VisiteurController;
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Heroes · Bootstrap v5.0</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/heroes/">

    <!-- Set theme color -->
    <meta name="theme-color" content="#3498db">

    <style>
        body { 
            background: url('resources/assets/pharmaceutical_1.JPG') no-repeat center center fixed; 
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
    </style>

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>    

  </head>
  <body>
    <main>        
        <div class="px-4 pt-5 my-3 text-center">
            <h1 class="display-4 fw-bold">Bienvenue sur GSB</h1>
            <div class="col-lg-6 mx-auto">
                <p class="lead mb-4">
                    Le laboratoire Galaxy Swiss Bourdin (<strong>GSB</strong>), issu de la fusion entre le géant américain <strong>Galaxy</strong> et le conglomérat européen
                    <strong>Swiss Bourdin</strong> vous propose désormais un service vous permettant de créer de nouveaux rapports de visites, de n'importe où.
                </p>
                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-5">
                    <button type="button" class="btn btn-primary btn-lg px-4 me-sm-3">Comment ça fonctionne ?</button>

                    <?php if(VisiteurController::isConnected()) { ?>
                      <a href='./?action=myRapports'><button type="button" class="btn btn-outline-secondary btn-lg px-4">Tableau de bord</button></a>
                    <?php } else { ?>
                      <a href='./?action=login'><button type="button" class="btn btn-outline-secondary btn-lg px-4">Se connecter</button></a>
                    <?php } ?>
                </div>
                </div>
                <div class="overflow-hidden" style="max-height: 41vh;">
                <div class="container">
                    <img src="resources/assets/dashboard_example.JPG" class="img-fluid border rounded-3 shadow-lg" alt="Example image" width="650" loading="lazy">
                </div>
            </div>
        </div>
    </main>   
  </body>
</html>
