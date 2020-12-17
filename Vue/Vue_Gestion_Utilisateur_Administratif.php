<?php

    function Vue_Gestion_Utilisateur_Liste($listeUtilisateur)
    {

        $connexion = Creer_Connexion();
        $utilisateurActuel = Utilisateur_Select_ParId($connexion, $_SESSION["idUtilisateur"]);

        echo '
<H1>Liste des utilisateurs administratif</H1>
    <table style="display: inline-block;">
    ';

        if($utilisateurActuel["niveauAutorisation"] != 0) {
            echo '
         <tr>
            <td colspan="3" style="text-align: center">
                <form style=\'display: contents\'>
                        <button type=\'submit\' onmouseover=\"this.style.background=\'#FFFF99\';this.style.color=\'#FF0000\';\"
                     onmouseout=\"this.style.background=\'\';this.style.color=\'\';\" name=\'nouveau\'> Nouvel utilisateur ? </button>
                </form>
            </td>
        </tr>';
        }


        echo '
        <tr>
            <th>login</th>
            <th>niveauAutorisation</th>
        </tr>';

        $i = 0;
        while ($i < count($listeUtilisateur)) {
            $iemeUtilisateur = $listeUtilisateur[$i];

            echo "
           
            
        <tr >
            <td>$iemeUtilisateur[login]</td>
            <td>$iemeUtilisateur[niveauAutorisation]</td>
            <td>
                <form style='display: contents'>
                    <input type='hidden' value='$iemeUtilisateur[idUtilisateur]' name='idUtilisateur'>
                    <button type='submit' onmouseover=\"this.style.background='#FFFF99';this.style.color='#FF0000';\"
                     onmouseout=\"this.style.background='';this.style.color='';\" name='Modifer'> Modifier </button>
                </form>
            </td>
            <td>
            ";

            $statusAffichage = "";
            switch ($iemeUtilisateur["statusUtilisateur"]) {
                case 0:
                    $statusAffichage = "Désactiver";
                    break;
                case 1:
                    $statusAffichage = "Activer";
                    break;
            }

            if($utilisateurActuel["niveauAutorisation"] > $iemeUtilisateur["niveauAutorisation"]) {
                echo "
                <form style='display: contents'>
                    <input type='hidden' value='$iemeUtilisateur[idUtilisateur]' name='statusUtilisateurId'>
                    <button type='submit' name='boutonActiver'> $statusAffichage </button>
                </form>
                <form style='display: contents'>
                    <input type='hidden' value='$iemeUtilisateur[idUtilisateur]' name='idUtilisateur'>
                    <button type='submit' name='boutonSupprimer'>Supprimer</button>
                </form>";
            }


            echo "
            </td>
        </tr>
        
         ";

            $i++;
        }
        echo "</table>";

    }

    function Vue_Gestion_Utilisateur_Formulaire($modeCreation = true, $idUtilisateur = "", $login = "", $niveauAutorisation = 0)
    {
        if ($modeCreation)
            echo "<H1>Création d'un nouveau utilisateur</H1>";
        else
            echo "<H1>Edition d'un utilisateur</H1>";

        echo "
        <table style='display: inline-block'> 
            <form>
                <input type='hidden' name='idUtilisateur' value='$idUtilisateur'>
                
                <tr>
                    <td>
                        <label>Id Utilisateur : </label>
                    </td>
                    <td>
                        <label>$idUtilisateur</label>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <label>Login : </label>
                    </td>
                    <td>
                        <input type='text' autofocus required name='login' value='$login'>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Niveau d'autorisation : </label>
                    </td>
                    <td>
                    ";

        $connexion = Creer_Connexion();
        $utilisateurActuel = Utilisateur_Select_ParId($connexion, $_SESSION["idUtilisateur"]);

        if($utilisateurActuel["niveauAutorisation"] >= 2) {
            echo "<input type='number' required name='niveauAutorisation' value='$niveauAutorisation'>";
        } else {
            echo "<label name='niveauAutorisation'>$niveauAutorisation</label>
                  <input type='hidden' name='niveauAutorisation' value='$niveauAutorisation'>";
        }

        echo "</td></tr>";

                if ($modeCreation) {
                    echo " 
                        
                    <td colspan='2' style='text-align: center'>
                        <button type='submit' name='buttonCreer'>Créer cet utilisateur</button>";
                } else {
                    echo "<td>
                        <button type='submit' name='réinitialiserMDP'>Réinitialiser le mot de passe</button>
                    </td>
                    <td>
                        <button type='submit' name='mettreAJour'>Mettre à jour</button>";

                }

                echo "</td>
                </tr>
        
            </form>
        </table>
        
        ";
    };
