<?php
    // Require
    namespace App\controller;
    include 'vendor/autoload.php';

    // Get action if valid else default
    if(isset($_GET['action'])) {
        $action = $_GET['action'];
    } else {
        $action = 'default';
    }

    // Start session if not started
    if(!isset($_SESSION)) { session_start(); }

    // Every action switch case
    switch($action) {
        case 'debug':
            print('dbug page. <br/>');
            if(isset($_GET['dbug'])) {
                print('dbug 2 show: ' . $_GET['dbug']);
            }
            break;
        
        case 'myProfile':
            if(VisiteurController::isConnected()) { 
                VisiteurController::getInstance()->render();
            } else {
                LoginController::getInstance()->render();
            }
            break;

        case 'myMedics':
            if(VisiteurController::isConnected()) { 
                MedecinController::getInstance()->render($action);
            } else {
                LoginController::getInstance()->render();
            }
            break;
            
        case 'myRapports':
            if(VisiteurController::isConnected()) { 
                RapportController::getInstance()->render($action);
            } else {
                LoginController::getInstance()->render();
            }
            break;

        case 'disconnect':
            LoginController::getInstance()->logout();
            break;

        case 'login':
            if(VisiteurController::isConnected()) { 
                HomeController::getInstance()->render();
            } else {
                LoginController::getInstance()->render();
            }
            break;
        
        default:
            if(VisiteurController::isConnected()) { 
                HomeController::getInstance()->render();
            } else {
                LoginController::getInstance()->render();
            }
            break;
    }
?>