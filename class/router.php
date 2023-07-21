<?php

class Router {
    // Le rôle du routeur est d'appeler la bonne méthode du bon contrôleur
    public static function route(): void {
        if (isset($_GET['page'])) {
            if ($_GET['page'] == "formulaire_asso") {
                if (isset($_SESSION['ID'])) {
                    AssoController::getFormulaire();
                } else {
                    $_SESSION['redirect'] = $_GET['page'];
                    header("Location: index.php?page=login");
                    die;
                }
            }
            if ($_GET['page'] == "assos") {
                AssoController::getAssos();
            }
            if ($_GET['page'] == "asso") {
                AssoController::getAsso();
            }
            if ($_GET['page'] == "login") {
                if (!isset($_SESSION['ID'])) {
                    UserController::getLogin();
                } else {
                    header("Location: index.php?page=assos");
                    die;
                }
            }
            if ($_GET['page'] == "subscribe") {
                if (!isset($_SESSION['ID'])) {
                    UserController::getSubscribe();
                } else {
                    header("Location: index.php?page=assos");
                    die;
                }
            }
            if ($_GET['page'] == "disconnect") {
                UserController::getDisconnect();
            }
        } else {
            // Défaut
             AssoController::getAssos();
        }
    }
}