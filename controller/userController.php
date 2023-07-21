<?php

class UserController {
    public static function getSubscribe() {
        $user = new User();
        
        if (isset($_POST['subscribe'])) {
            $user->loadFromPost();
            if ($user->checkPost() && ($user->getPassword() === $_POST['pwd2'])) {
                $findUserByLogin = User::getFromLogin($user->getLogin());
                
                if (!$findUserByLogin) {
                    // On n'a pas trouvé d'autre utilisateur avec le même login, on peut sauver
                    $user->save();
                    
                    header("Location: index.php?page=login");
                    die;
                }
            }
        }
        
        Renderer::render("vue/subscribe.phtml", [
            "user" => $user
        ]);
    }
    
    public static function getLogin() {
        $user = new User();
        
        if (isset($_POST['signin'])) {
            $user = User::getFromLogin($_POST['login']);
            
            if ($user) {
                if ($user->checkPassword($_POST['pwd1'])) {
                    $_SESSION['ID'] = $user->getId();
                    $_SESSION['admin'] = $user->getAdmin();
                    
                    // Redirection
                    if (isset($_SESSION['redirect'])) {
                        header("Location: index.php?page=".$_SESSION['redirect']);
                        unset($_SESSION['redirect']);
                        die;
                    }
                    header("Location: index.php?page=assos");
                    die;
                }
            }
        }
        
        Renderer::render("vue/login.phtml", [
            "user" => $user
        ]);
    }
    
    public static function getDisconnect() {
        $_SESSION['ID'] = null;
        unset($_SESSION['ID']);
        session_destroy();
        
        Renderer::render("vue/disconnect.phtml");
    }
}