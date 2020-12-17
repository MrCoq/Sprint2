<?php
    include("autoload.php");

    if(isset($_SESSION["idUtilisateur"])) {
        //Si l'utilisateur est connecté

        if(isset($_REQUEST["changerMDPValider"])) {
            //Il a cliqué sur changer Mot de passe.
            Vue_Structure_Entete();
            Vue_Administration_Menu();
            Vue_Administration_Gerer_Compte();
            Changer_MDP_Confirmation();
        }
        elseif(isset($_REQUEST["SeDeconnecter"]))
        {
            //L'utilisateur a cliqué sur "se déconnecter"
            session_destroy();
            unset($_SESSION["idUtilisateur"]);
            Vue_Structure_Entete();
            Vue_Connexion_Formulaire_connexion_administration();
        }
        else {
            //Cas par défaut: affichage du menu des actions.
            Vue_Structure_Entete();
            Vue_Administration_Menu();
            Vue_Administration_Gerer_Compte();
        }
    }
    else
    {
        //On renvoie l'utilisateur à la page de connexion. Il n'aurait jamais du arriver ici !
        Vue_Structure_Entete();
        Vue_Connexion_Formulaire_connexion_administration();
    }

    Vue_Structure_BasDePage();


    function Changer_MDP_Confirmation() {
        if(isset($_REQUEST["changerMDPValider"])) {

            echo "<tr><td style='text-align: center'>";

            $connexion = Creer_Connexion();
            $utilisateur = Utilisateur_Select_ParId($connexion, $_SESSION["idUtilisateur"]);

            $mdpBDD = $utilisateur["motDePasse"];
            $mdpAncien = $_REQUEST["changerMDPActuel"];
            $mdpNouveau = $_REQUEST["changerMDPNouveau"];
            $couleur = "ff0000";

            if(!password_verify($mdpAncien, $mdpBDD)) {
                $message = "Mauvais mot de passe actuel";
            } else if($mdpNouveau != $_REQUEST["changerMDPConfirmation"]) {
                $message = "Erreur de confirmation du mot de passe";
            } else if($mdpNouveau == $mdpAncien) {
                $message = "Erreur des entrées de mot de passe";
            } else {
                Utilisateur_Modifier_motDePasse($connexion, $_SESSION["idUtilisateur"], $mdpNouveau);
                $message = "Mot de passe changé avec succès";
                $couleur = "#00790d";
            }
            echo "<p style='color:" . $couleur . ";'> " . $message . " </p>";
            echo "</td></tr>";
        }
        echo "</table>";
    }
