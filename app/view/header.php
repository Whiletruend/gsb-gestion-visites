<?php
    if(!isset($_SESSION)) { session_start(); }
    use App\controller\LoginController;
    use App\controller\VisiteurController;
?>

<head>
    <!-- Title -->
    <title>GSB - Gestion Visite</title>

    <!-- Adding libraries -->
    <link rel='stylesheet' href='resources/css/bootstrap.min.css'>
    <script src='resources/js/bootstrap.bundle.min.js'></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css'>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <meta name="theme-color" content="#3498db">
</head>


<body>
    <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href=".">
                <img src="resources/assets/gsb_blank.png" alt="" width="70" height="45">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href=".">Accueil</a>
                    </li>
                </ul>

                <?php if(VisiteurController::isConnected()) { ?>
                    <nav class="navbar navbar-expand-sm bg-light">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                <li class="nav-item dropdown dropstart">
                                    Connecté en tant que <strong><?= $_SESSION['fname_VISITOR'] . ' ' . $_SESSION['lname_VISITOR'] . ' (' . $_SESSION['login_VISITOR'] . ')'; ?></strong>
                                </a>
                            </li>
                        </ul>
                    </nav>
                <?php } ?>
            </div>
        </div>
    </nav>
</body>