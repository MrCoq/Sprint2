<?php
include("autoload.php");

/**
 * Ce contrôleur est dédié à la gestion des entreprises partenaires.
 * Toutes les pages de cette user story renvoie sur ce contrôleur.
 * Le tri entre les actions est fait sur l'existence des boutons submit. Deux boutons ne doivent pas avoir le même nom ! ;)
 */
Vue_Structure_Entete();

if(isset($_SESSION["idUtilisateur"])) {
    Vue_Administration_Menu();
    $connexion = Creer_Connexion();


    if (isset($_REQUEST["buttonListerProduit"])) {
        $produitList = Produit_Select_ParIdCategorie($connexion, $_REQUEST["idCategorie"]);
        Vue_Gestion_Produit_Liste_ParCategorie($produitList, $_REQUEST["idCategorie"]);

    } else if(isset($_REQUEST["nouveauProduit"])) {
        Vue_Gestion_Produit_Formulaire(true, $_REQUEST["idCategorie"]);

    } else if(isset($_REQUEST["buttonCreerProduit"])) {
        Produit_Creer($connexion, $_REQUEST["nom"], $_REQUEST["description"], $_REQUEST["resume"], $_REQUEST["fichierImage"], $_REQUEST["prixVenteHT"], $_REQUEST["idCategorie"], $_REQUEST["idTVA"]);

        $produitList = Produit_Select_ParIdCategorie($connexion, $_REQUEST["idCategorie"]);
        Vue_Gestion_Produit_Liste_ParCategorie($produitList, $_REQUEST["idCategorie"]);

    } else if(isset($_REQUEST["modifierProduit"])) {
        $produit = Produit_Select_ParID($connexion, $_REQUEST["idProduit"]);

        Vue_Gestion_Produit_Formulaire(false, $produit["idCategorie"], $produit["idProduit"], $produit["nom"], $produit["description"], $produit["resume"], $produit["prixVenteHT"], $produit["idTVA"], $produit["fichierImage"]);

    } else if(isset($_REQUEST["mettreAJourProduit"])) {
        Produit_Modifier($connexion, $_REQUEST["idProduit"], $_REQUEST["nom"], $_REQUEST["description"], $_REQUEST["resume"], $_REQUEST["fichierImage"], $_REQUEST["prixVenteHT"], $_REQUEST["idCategorie"], $_REQUEST["idTVA"]);

        $produitList = Produit_Select_ParIdCategorie($connexion, $_REQUEST["idCategorie"]);
        Vue_Gestion_Produit_Liste_ParCategorie($produitList, $_REQUEST["idCategorie"]);

    } else if(isset($_REQUEST["buttonSupprimerProduit"])) {

        Produit_Supprimer($connexion, $_REQUEST["idProduit"]);
        $produitList = Produit_Select_ParIdCategorie($connexion, $_REQUEST["idCategorie"]);
        Vue_Gestion_Produit_Liste_ParCategorie($produitList, $_REQUEST["idCategorie"]);
    }

    else if(isset($_REQUEST["buttonActiverProduit"])) {
        $produit = Produit_Select_ParID($connexion, $_REQUEST["idProduit"]);
        switch($produit["statusProduit"]) {
            case 0:
                Produit_Activation($connexion, $produit["idProduit"], 1);
                break;
            case 1:
                Produit_Activation($connexion, $produit["idProduit"], 0);
                break;
        }
        $produitList = Produit_Select_ParIdCategorie($connexion, $produit["idCategorie"]);
        Vue_Gestion_Produit_Liste_ParCategorie($produitList, $produit["idCategorie"]);
    }

    else if (isset($_REQUEST["nouvelleCategorie"])) {
        Vue_Gestion_Catalogue_Formulaire(true);

    } else if(isset($_REQUEST["buttonCreerCategorie"])) {
        Categorie_Creer($connexion, $_REQUEST["libelle"]);

        $categorieList = Categorie_Select($connexion);
        Vue_Gestion_Categorie_Liste($categorieList);
    } else if(isset($_REQUEST["buttonModifierCategorie"])) {
        $categorie = Categorie_Select_ParID($connexion, $_REQUEST["idCategorie"]);
        Vue_Gestion_Catalogue_Formulaire(false, $categorie["idCategorie"], $categorie["libelle"], $categorie["description"]);

    } else if(isset($_REQUEST["mettreAJourCategorie"])) {

        Categorie_Modifier($connexion, $_REQUEST["idCategorie"], $_REQUEST["libelle"], $_REQUEST["description"]);

        $categorieList = Categorie_Select($connexion);
        Vue_Gestion_Categorie_Liste($categorieList);
    } else if(isset($_REQUEST["buttonSupprimerCategorie"])) {
        Produit_Supprimer_ParIdCategorie($connexion, $_REQUEST["idCategorie"]);
        Categorie_Supprimer($connexion, $_REQUEST["idCategorie"]);

        $categorieList = Categorie_Select($connexion);
        Vue_Gestion_Categorie_Liste($categorieList);
    }

    else if(isset($_REQUEST["buttonActiverCategorie"])) {

        $categorie = Categorie_Select_ParID($connexion, $_REQUEST["idCategorie"]);
        switch($categorie["statusCategorie"]) {
            case 0:
                Categorie_Activation($connexion, $categorie["idCategorie"], 1);
                break;
            case 1:
                Categorie_Activation($connexion, $categorie["idCategorie"], 0);
                break;
        }

        $categorieList = Categorie_Select($connexion);
        Vue_Gestion_Categorie_Liste($categorieList);

    }

    else {
        $categorieList = Categorie_Select($connexion);
        Vue_Gestion_Categorie_Liste($categorieList);
    }

} else {
    //l'utilisateur n'est pas connecté, il n'aurait jamais du arriver ici !
    Vue_Connexion_Formulaire_connexion_administration();
}
Vue_Structure_BasDePage();
