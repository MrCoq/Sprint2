<?php
    include("autoload.php");

    Vue_Structure_Entete();

    if(isset($_SESSION["idUtilisateur"])) {
        Vue_Administration_Menu();
        $connexion = Creer_Connexion();
        if (isset($_REQUEST["boutonActiver"])) {
            $utilisateur = Utilisateur_Select_ParId($connexion, $_REQUEST["statusUtilisateurId"]);
            switch($utilisateur["statusUtilisateur"]) {
                case 0:
                    Utilisateur_Changer_Status_ParId($connexion, $utilisateur["idUtilisateur"], "1");
                    break;
                case 1:
                    Utilisateur_Changer_Status_ParId($connexion, $utilisateur["idUtilisateur"], "0");
                    break;
            }
            $listeUtilisateur = Utilisateur_Select($connexion);
            Vue_Gestion_Utilisateur_Liste($listeUtilisateur);

        } else if(isset($_REQUEST["Modifer"])) {
            $utilisateur = Utilisateur_Select_ParId($connexion, $_REQUEST["idUtilisateur"]);
            Vue_Gestion_Utilisateur_Formulaire(false, $utilisateur["idUtilisateur"], $utilisateur["login"], $utilisateur["niveauAutorisation"]);

        } else if(isset($_REQUEST["nouveau"])) {
            Vue_Gestion_Utilisateur_Formulaire(true);

        } else if(isset($_REQUEST["boutonSupprimer"])) {
            Utilisateur_Supprimer($connexion, $_REQUEST["idUtilisateur"]);
            $listeUtilisateur = Utilisateur_Select($connexion);
            Vue_Gestion_Utilisateur_Liste($listeUtilisateur);

        } else if (isset($_REQUEST["réinitialiserMDP"])) {
            //Réinitialiser MDP sur la fiche de l'utilisateur
            $utilisateur = Utilisateur_Select_ParId($connexion, $_REQUEST["idUtilisateur"]);
            Utilisateur_Modifier_motDePasse($connexion, $_REQUEST["idUtilisateur"], $utilisateur["login"]);
            $listeUtilisateur = Utilisateur_Select($connexion);
            Vue_Gestion_Utilisateur_Liste($listeUtilisateur);

        } else if(isset($_REQUEST["buttonCreer"])) {
            $utilisateurSelect = Utilisateur_Select_ParLogin($connexion, $_REQUEST["login"]);
            if(!$utilisateurSelect) {
                $idUtilisateur = Utilisateur_Creer($connexion, $_REQUEST["login"], $_REQUEST["niveauAutorisation"]);
                Utilisateur_Modifier_motDePasse($connexion, $idUtilisateur, $_REQUEST["login"]);

                $listeUtilisateur = Utilisateur_Select($connexion);
                Vue_Gestion_Utilisateur_Liste($listeUtilisateur);
            } else {
                Vue_Gestion_Utilisateur_Formulaire(true);
                echo "<p style='margin-left: auto; margin-right: auto; color: #ff0000'>Cet utilisateur existe déjà</p>";
            }

        } else if(isset($_REQUEST["mettreAJour"])) {
            Utilisateur_Modifier($connexion, $_REQUEST["idUtilisateur"], $_REQUEST["login"], $_REQUEST["niveauAutorisation"]);
            $listeUtilisateur = Utilisateur_Select($connexion);
            Vue_Gestion_Utilisateur_Liste($listeUtilisateur);

        }
        else {
            //situation par défaut :
            $listeUtilisateur = Utilisateur_Select($connexion);
            Vue_Gestion_Utilisateur_Liste($listeUtilisateur);
        }
    }
    else
    {
        //l'utilisateur n'est pas connecté, il n'aurait jamais du arriver ici !
        Vue_Connexion_Formulaire_connexion_administration();
    }
    Vue_Structure_BasDePage();