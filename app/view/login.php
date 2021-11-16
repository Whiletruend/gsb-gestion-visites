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
            background: url('resources/assets/pharmaceutical_5.JPG') no-repeat center center fixed; 
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
  <body class='text-center'>
    <div class="px-4 pt-5 my-3 text-center">
  
        <div class="col-lg-4 mx-auto">
            <main class="form-signin">
                <form action='#' method='POST'>
                    <img class="mb-4" src="resources/assets/gsb_white_nolabel.png" alt="" width="120" height="80">

                    <?php if(isset($_GET['errLogin'])) { ?>
                      <div class="alert alert-danger alert-dismissible d-flex align-items-center fade show" id='gsb_errLogin' role='alert'>
                          <strong class="mx-2">Erreur !</strong> Identifiant ou Mot de passe incorrect.
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label='close'></button>
                      </div>

                      <script>
                        window.setTimeout(function() {
                            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                                $(this).remove(); 
                            });
                        }, 2000);
                      </script>
                    <?php } ?>

                    <h1 class="h3 mb-3 fw-normal fs-4">Connexion à votre <strong>compte client</strong></h1>

                    <div class="form-floating">
                      <input type="login" name='login_VISITEUR' class="form-control" id="floatingInput" placeholder="ADUBOIS" required>
                      <label for="floatingInput">Identifiant</label>
                    </div>

                    <div class='p-1'></div>

                    <div class="form-floating">
                      <input type="password" name='mdp_VISITEUR' class="form-control" id="floatingPassword" placeholder="Mot de passe" required>
                      <label for="floatingPassword">Mot de passe</label>
                    </div>

                    <div class="checkbox mb-3"></div>
                    
                    <button class="w-100 btn btn-lg btn-primary" type="submit">S'authentifier</button>
                    <p class="mt-5 mb-3 text-muted">&copy; 2021-2022 - Galaxy Swiss Bourdin</p>
                </form>
            </main>
        </div>
    </div>
  </body>
</html>
