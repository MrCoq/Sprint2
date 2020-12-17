<?php
function Vue_Administration_Menu()
{

    echo "
 


<nav id='menu'>
  <ul id='menu-closed'> 
  <li><a href='Gerer_Catalogue.php'>Gérer le Catalogue</a></li>
  <li><a href='Gerer_entreprisesPartenaires.php'>Entreprises partenaires</a></li>  
  <li><a href='Gerer_utilisateursAdministratif.php'>Utilisateurs administratifs</a></li>
   <li><a href='Gerer_monCompte.php'>Mon compte</a></li>
   
   
   </ul>
</nav> ";
}

function Vue_Administration_Gerer_Compte(){
    echo " 
    <H1>Gérer mon compte</H1>
    <table style='display: inline-block'>
        <tr>
            <td>
                <form style='display: contents; width:20%;' method='post'>
                    <input type='password' name='changerMDPActuel' required placeholder='Mot de passe actuel'><br>
                    <input type='password' name='changerMDPNouveau' required placeholder='Nouveau mot de passe'><br>
                    <input type='password' name='changerMDPConfirmation' required placeholder='Confirmer nouveau mot de passe'>
                    <button type='submit' name='changerMDPValider' >Changer mot de passe</button><br><br>
                </form>
            </td>
        </tr>
        <tr>
            <td>
                <form style='display: contents'>
                    <button type='submit' name='SeDeconnecter'>Se déconnecter </button>
                </form>
            </td>
        </tr>
        
    
    
    ";
}