<?php

class AssoController {
    public static function getAssos() {
        // Appel au Modèle Asso
        $assos = Asso::findAll(); // Chargement depuis la BDD
        
        // Affichage de la Vue Assos
        Renderer::render("vue/assos.php", [
            "assos" => $assos
        ]);
    }
    
    public static function getAsso() {
        if (!isset($_GET['id'])) {
            header("Location: index.php");
            die;
        }
        
        $asso = Asso::findById($_GET['id']);
        
        if (!$asso) {
            header("Location: index.php");
            die;
        }
        
        Renderer::render("vue/asso.php", [
            "asso" => $asso
        ]);
    }
    
    public static function getFormulaire() {
        //Créer l'objet
        $asso = new Asso();
        
        if (isset($_POST['submit'])) {
            //Charger dans l'objet
            $asso->loadFromPost();
            //Vérifier la conformité des données POST
            if ($asso->checkPost()) {
                //Enregistrer
                $asso->save();
                
                header("Location: index.php?page=assos");
                die;
            }
        }
        
        //require_once "vue/formulaire_lieu.php";
        Renderer::render("vue/formulaire_asso.php", [
            "asso" => $asso
        ]);
    }
}