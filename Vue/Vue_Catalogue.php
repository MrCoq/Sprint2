<?php
function Vue_Catalogue_Public($categorieList)
{

    echo "

    <html>
        <head>
           <meta charset='utf-8'>
            <!-- importer le fichier de style -->
            <link rel='stylesheet' href='public\style.css' media='screen' type='text/css' />
        </head>
        <body>
 


<nav id='menu'><ul id='menu-closed'>";

    for($i = 0; $i<sizeof($categorieList); $i++) {
        $actuel = $categorieList[$i];

        echo "<li><form style='display: contents'><button style='' type='submit'name='buttonClique'>$actuel[libelle]</a><input type='hidden' name='idCategorie' value='$actuel[idCategorie]'></form></li>";

    }

echo "
   
   </ul>
</nav> ";
}


function Vue_Catalogue_Produits($produitList, $libelle) {

    echo "<div style='text-align: center'>
            <H1>Liste des articles : $libelle</H1>";

    for($i = 0; $i<sizeof($produitList); $i++) {
        $actuel = $produitList[$i];

        echo "
        <form style='display: contents;'>
            <button onclick='submit();' name='buttonProduit' width='25%' style='margin: 20px'>
                 <table style='padding: 20px; display: inline-block; height: 300px;'>
                    <tr>
                        <td style='vertical-align: top;width : 250px'>
                            <b>Article : </b> $actuel[nom] <br>
                        </td><td rowspan='4'>  <br><img style='width:110px;' src='/sprint2/public/image/$actuel[fichierImage]'></td>
                    <tr>   
                        <td style='vertical-align: top;width : 250px'>
                            <b>Référence : </b>$actuel[idProduit]<br>
                        </td>
                    </tr>
                    <tr>
                        <td style='vertical-align: top;width : 250px'><b>Prix : </b> $actuel[prixVenteHT] € HT</td>
                    </tr>
                    <tr>
                        <td style='vertical-align: top;width : 250px'><b>Description :</b>$actuel[description]</td>
                    </tr> 
                </table>
            </button>
            <input type='hidden' name='idProduit' value='$actuel[idProduit]'>
            <input type='hidden' name='idCategorie' value='$actuel[idCategorie]'>
        </form>";
    }

    echo "</div>";
}

function Vue_Produit($connexion, $produit) {

    $actuel = Produit_Select_ParID($connexion, $produit);
    $categorie = Categorie_Select_ParID($connexion, $actuel["idCategorie"]);

    echo "<form style='background: transparent; padding: 1px; border: none; display: block; width: 40%;  margin: auto; margin-top: 12%'>
            <button onclick='submit();' width='50%'
                    onmouseover=\"this.style.background='#FFFF99';this.style.color='#FF0000';\"
                     onmouseout=\"this.style.background='';this.style.color='';\"
                     style='margin: 20px;' name='buttonClique'>
             <table style='padding: 20px;    display: inline-block;' >
                <tr>
                    <td style='vertical-align: top;width : 400px'>
                        <b>Article : </b>
                        $actuel[nom] <br>
                    </td><td rowspan='6'>  <br><img style='width:220px;' src='/sprint2/public/image/$actuel[fichierImage]'></td>
                </tr>
                <tr>   
                    <td style='vertical-align: top;width : 400px'>
                        <b>Categorie : </b>
                        $categorie[libelle]<br>
                    </td>
                </tr>
                <tr>   
                    <td style='vertical-align: top;width : 400px'>
                        <b>Code référence : </b>
                        $actuel[idProduit]<br>
                    </td>
                </tr>
                <tr>
                    <td style='vertical-align: top;width : 400px'><b>Prix : </b>$actuel[prixVenteHT] € HT
            
                    </td>
                </tr>
                <tr>
                    <td style='vertical-align: top;width : 400px'><b>Résumé :</b> $actuel[resume]
            
                    </td>
                </tr> 
                <tr>
                    <td style='vertical-align: top;width : 400px'><b>Description :</b> $actuel[description] 
            
                    </td>
                </tr>
            </table>
            </button>
             <input type='hidden' name='idCategorie' value='$actuel[idCategorie]'>
           </form>";

}
