<?php
include("autoload.php");

$connexion = Creer_Connexion();
$categorieList = Categorie_Select($connexion);

Vue_Structure_Entete(true);
Vue_Catalogue_Public($categorieList);
Vue_Structure_BasDePage();

if(isset($_REQUEST["buttonClique"]) && isset($_REQUEST["idCategorie"])) {
    $categorie = Categorie_Select_ParID($connexion, $_REQUEST["idCategorie"]);
    $produitList = Produit_Select_ParIdCategorie($connexion, $categorie["idCategorie"]);
    Vue_Catalogue_Produits($produitList, $categorie["libelle"]);
} else if(isset($_REQUEST["buttonProduit"])) {

    Vue_Produit($connexion, $_REQUEST["idProduit"]);

}