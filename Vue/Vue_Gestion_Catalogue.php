<?php

function Vue_Gestion_Categorie_Liste($listeCategorie)
{

    echo "<H1>Liste des catégories</H1>

    <table style='display: inline-block;'>

    <tr>
        <td colspan='3' style='text-align: center'><form style='display: contents'>
 
                        <button type='submit' name='nouvelleCategorie'>Créer une nouvelle catégorie</button>
            </form>
        </td>
    </tr>

    <tr>
            <th>idCategorie</th>
            <th>libelle</th>
    </tr>
    ";

    for($i = 0; $i<sizeof($listeCategorie); $i++) {
        $actuelle = $listeCategorie[$i];

        echo "
        <tr>
            <td>$actuelle[idCategorie]</td>
            <td>$actuelle[libelle]</td>
            <td>
                <form style='display: contents'>
                    <button type='submit' name='buttonModifierCategorie'> Modifier </button>
                    <input type='hidden' name='idCategorie' value='$actuelle[idCategorie]'>
                </form>
            </td>
            <td>
                <form style='display: contents'>
                    <!--<button type='submit' name='buttonSupprimerCategorie'> Supprimer </button>-->
                    <input type='hidden' name='idCategorie' value='$actuelle[idCategorie]'>
                </form>
            </td>
            <td>
                <form style='display: contents'>
                    <button type='submit' name='buttonListerProduit'> Produits associés </button>
                    <input type='hidden' name='idCategorie' value='$actuelle[idCategorie]'>
                </form>
            </td>
            
        </tr>";

    }

    echo "</table>";
}

function Vue_Gestion_Catalogue_Formulaire($modeCreation = true, $idCategorie = "", $libelle = "") {
    if ($modeCreation)
        echo "<H1>Création d'une nouvelle catégorie</H1>";
    else
        echo "<H1>Edition d'une catégorie</H1>";

    echo "
        <table style='display: inline-block'> 
            <form>
                <input type='hidden' name='idCategorie' value='$idCategorie'>

                <tr>
                    <td>
                        <label>Id de la catégorie : </label>
                    </td>
                    <td>
                        $idCategorie
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Nom de la catégorie : </label>
                    </td>
                    <td>
                        <input type='text' required placeholder='Nom de la catégorie' name='libelle' value='$libelle'>
                    </td>
                </tr>
        </tr>
        ";

    if ($modeCreation) {
        echo " 
            <td colspan='2' style='text-align: center'>
                <button type='submit' name='buttonCreerCategorie'>Créer cette catégorie</button>";
                
    } else {
        echo "
            <td>
                <button type='submit' name='mettreAJourCategorie'>Mettre à jour</button>";
    }

    echo "      </td>
            </tr>
        </form>
    </table>";
}



function Vue_Gestion_Produit_Liste($listeProduit, $idCategorie)
{

    echo "<H1>Liste des produits de la catégorie</H1>


    <table style='display: inline-block;'>
    
    
    <tr>
        <td colspan='3' style='text-align: center'><form style='display: contents'>
                        <button type='submit' name='nouveauProduit'>Ajouter un nouveau produit</button>
                        <input type='hidden' name='idCategorie' value='$idCategorie'>
            </form>
        </td>
 
    </tr>
    

    <tr>
            <th>idProduit</th>
            <th>nom</th>
            <th>prixVenteHT</th>
            <th>idTVA</th>
    </tr>
    ";

    for($i = 0; $i<sizeof($listeProduit); $i++) {
        $actuelle = $listeProduit[$i];

        echo "
        <tr>
            <td>$actuelle[idProduit]</td>
            <td>$actuelle[nom]</td>
            <td>$actuelle[prixVenteHT]</td>
            <td>$actuelle[idTVA]</td>
            <td>
                <form style='display: contents'>
                    <button type='submit' name='modifierProduit'> Modifier </button>
                    <input type='hidden' name='idProduit' value='$actuelle[idProduit]'>
                </form>
            </td>
            <td>
                <form style='display: contents'>
                    <!--<button type='submit' name='buttonSupprimerProduit'> Supprimer </button>-->
                    <input type='hidden' name='idProduit' value='$actuelle[idProduit]'>
                    <input type='hidden' name='idCategorie' value='$actuelle[idCategorie]'>
                </form>
            </td>
            
        </tr>";
    }

    echo "</table>";
}

function Vue_Gestion_Produit_Formulaire($modeCreation = true, $idCategorie="", $idProduit="", $nom="", $description="", $resume="", $prixVenteHT="", $idTVA=0, $fichierImage="") {
    $categorie = Categorie_Select_ParID(Creer_Connexion(), $idCategorie);

    if ($modeCreation)
        echo "<H1>Ajout d'un nouveau produit : $categorie[libelle]</H1>";
    else
        echo "<H1>Edition d'un produit : $categorie[libelle]</H1>";

    echo "
        <table style='display: inline-block'> 
            <form>
                <input type='hidden' name='idProduit' value='$idProduit'>
                <tr>
                    <td>
                        <label>Id du produit : </label>
                    </td>
                    <td>
                        $idProduit
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Id de la catégorie : </label>
                    </td>
                    <td>
                        <input type='text' required placeholder='Id de catégorie existant' name='idCategorie' value='$idCategorie'>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Nom du produit : </label>
                    </td>
                    <td>
                        <input type='text' required placeholder='Nom du produit' name='nom' value='$nom'>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Description du produit : </label>
                    </td>
                    <td>
                        <input type='text' placeholder='Description du produit' name='description' value='$description'>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <label>Résumé du produit : </label>
                    </td>
                    <td>
                        <input type='text' placeholder='Résumé du produit' name='resume' value='$resume'>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Prix du produit : </label>
                    </td>
                    <td>
                        <input type='number' required name='prixVenteHT' value='$prixVenteHT'>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>IdTVA du produit : </label>
                    </td>
                    <td>
                        <input type='number' required name='idTVA' value='$idTVA'>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Url de l'image du produit : </label>
                    </td>
                    <td>
                        <input type='text' name='fichierImage' value='$fichierImage'>
                    </td>
                </tr>
        </tr>
        ";

    if ($modeCreation) {
        echo " 
            <td colspan='2' style='text-align: center'>
                <button type='submit' name='buttonCreerProduit'>Créer ce produit</button>";
                
    } else {
        echo "
            <td>
                <button type='submit' name='mettreAJourProduit'>Mettre à jour</button>";
    }

    echo "      </td>
            </tr>
        </form>
    </table>";
}