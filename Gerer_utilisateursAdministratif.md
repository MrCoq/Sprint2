#Gerer_utilisateursAdministratifs

__=> Section de la page Php__

- Vérifie si un utilisateur est connecté, sinon la vue de connexion s'affiche

_Il y a de multiples boutons disponibles :_

- "activé/désactivé" permet de donner ou non l'autorisation au compte de se connecter
- "modifier" permet d'accéder à la vue de modification d'un utilisateur
- "nouveau" permet d'accéder à la vue de création d'un utilisateur
- "supprimer" permet de supprimer l'utilisateur sélectionné
- "réinitialiserMDP" permet de réinitialiser le mot de passe en appliquant, en mot de passe, le login de la personne
- "buttonCreer" permet de créer un utilisateur en définissant comme mot de passe de base le login
- "mettreAJour" permet d'actueliser les informations d'un utilisateur, comme le niveau d'autorisation ou le login


_Il y a 3 types d'utilisateur administratif_

- niveauAutorisation = 0  ->  Commercial
- niveauAutorisation = 1  ->  Entreprise
- niveauAutorisation = 2 ou plus  ->  Administrateur (Les accès s'adaptent selon la hauteur du niveau)
