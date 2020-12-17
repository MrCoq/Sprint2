#Documentation : Gerer_monCompte

*=> Affichage de la page :*

- Vérifie si l'utilisateur est bien connecté sinon la page de connexion lui est renvoyée
- Affiche par défaut, lorsque l'utilisateur est connecté, la Vue_Structure_Entete, Vue_Administration_Menu et Vue_Administration_Gerer_Compte.
- Vérifie si le bouton Se déconnecté est appuié et donc la session est coupée et la page de connexion de l'administration est envoyée.
- Vérifie si le bouton Changer de mot de passe est appuié en appelant la fonction Changer_MDP_Confirmation et afficher les vues par défaut.


*=> Fonction Changer_MDP_Confirmation() :*

* Récupère les mots de passe dans chanque input, puis vérifie si le mot de passe actuel correspond à celui de la BDD
* Vérifie si le mot de passe de confirmation est le même que le nouveau
* Vérifie si le nouveau mot de passe ne correspond pas au même déjà enregistré dans la BDD

> En cas de problème dans l'une de ces conditions, un message apparait selon l'erreur actuelle
