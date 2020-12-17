<?php

function Categorie_Select($connexionPDO)
{
    $requetePreparée = $connexionPDO->prepare('select * from `categorie` order by idCategorie');
    $reponse = $requetePreparée->execute(); //$reponse boolean sur l'état de la requête
    $tableauReponse = $requetePreparée->fetchAll(PDO::FETCH_ASSOC);
    return $tableauReponse;
}

function Categorie_Select_ParID($connexionPDO, $idCategorie) {
    $requetePreparée = $connexionPDO->prepare('select * from `categorie` where idCategorie = :paramIdCategorie');
    $requetePreparée->bindParam('paramIdCategorie', $idCategorie);
    $reponse = $requetePreparée->execute();
    $tableauReponse = $requetePreparée->fetch(PDO::FETCH_ASSOC);
    return $tableauReponse;
}

function Categorie_Creer($connexionPDO, $libelle)
{
    $requetePreparée = $connexionPDO->prepare('INSERT INTO `categorie` (`idCategorie`, `libelle`) VALUES (NULL, :paramlibelle)');
    $requetePreparée->bindParam('paramlibelle', $libelle);
    $reponse = $requetePreparée->execute(); //$reponse boolean sur l'état de la requête
    $idCategorie = $connexionPDO->lastInsertId();
    return $idCategorie;
}

function Categorie_Modifier($connexionPDO, $idCategorie, $libelle = "", $description)
{
    $requetePreparée = $connexionPDO->prepare(
        'UPDATE `categorie` 
        SET `idCategorie`= :paramIdCategorie,
        `libelle`= :paramLibelle,
        `description`= :paramDescription
        WHERE idCategorie = :paramIdCategorie');
    $requetePreparée->bindParam('paramIdCategorie', $idCategorie);
    $requetePreparée->bindParam('paramLibelle', $libelle);
    $requetePreparée->bindParam('paramDescription', $description);

    $reponse = $requetePreparée->execute(); //$reponse boolean sur l'état de la requête
    return $reponse;
}

function Categorie_Supprimer($connexionPDO, $idCategorie) {
    $requetePreparée = $connexionPDO->prepare('delete categorie.* from `categorie` where idCategorie = :paramIdCategorie');
    $requetePreparée->bindParam('paramIdCategorie', $idCategorie);
    $reponse = $requetePreparée->execute();
    return $reponse;
}

function Categorie_Activation($connexionPDO, $idCategorie, $status) {
    $requetePreparée = $connexionPDO->prepare('update categorie set statusCategorie = :paramStatusCategorie where idCategorie = :paramIdCategorie');
    $requetePreparée->bindParam('paramIdCategorie', $idCategorie);
    $requetePreparée->bindParam('paramStatusCategorie', $status);
    $reponse = $requetePreparée->execute();
    return $reponse;
}

function Produit_Select($connexionPDO)
{
    $requetePreparée = $connexionPDO->prepare('select * from `produit` order by idCategorie');
    $reponse = $requetePreparée->execute();
    $tableauReponse = $requetePreparée->fetchAll(PDO::FETCH_ASSOC);
    return $tableauReponse;
}

function Produit_Select_ParID($connexionPDO, $idProduit)
{
    $requetePreparée = $connexionPDO->prepare('select * from `produit` where idProduit = :paramIdProduit');
    $requetePreparée->bindParam('paramIdProduit', $idProduit);
    $reponse = $requetePreparée->execute();
    $tableauReponse = $requetePreparée->fetch(PDO::FETCH_ASSOC);
    return $tableauReponse;
}

//$idProduit, $nom, $description, $resume, $fichierImage, $prixVenteHT, $idCategorie, $idTVA
function Produit_Creer($connexionPDO, $nom, $description = null, $resume = null, $fichierImage = null, $prixVenteHT = 0, $idCategorie, $idTVA)
{
    $requetePreparée = $connexionPDO->prepare('INSERT INTO `produit` (`idProduit`, `nom`, `description`, `resume`, `fichierImage`, `prixVenteHT`, `idCategorie`, `idTVA`) 
                                                            VALUES (NULL, :paramnom, :paramdescription, :paramresume, :paramfichierImage, :paramprixVenteHT, :paramidCategorie, :paramidTVA)');
    $requetePreparée->bindParam('paramnom', $nom);
    $requetePreparée->bindParam('paramdescription', $description);
    $requetePreparée->bindParam('paramresume', $resume);
    $requetePreparée->bindParam('paramfichierImage', $fichierImage);
    $requetePreparée->bindParam('paramprixVenteHT', $prixVenteHT);
    $requetePreparée->bindParam('paramidCategorie', $idCategorie);
    $requetePreparée->bindParam('paramidTVA', $idTVA);
    $reponse = $requetePreparée->execute(); //$reponse boolean sur l'état de la requête
    $idProduit = $connexionPDO->lastInsertId();
    return $idProduit;
}

function Produit_Modifier($connexionPDO, $idProduit, $nom, $description, $resume, $fichierImage, $prixVenteHT, $idCategorie, $idTVA)
{
    $requetePreparée = $connexionPDO->prepare(
        'UPDATE `produit` 
        SET `idProduit`= :paramidProduit,
        `nom`= :paramnom,
        `description`= :paramdescription,
        `resume`= :paramresume,
        `fichierImage`= :paramfichierImage,
        `prixVenteHT`= :paramprixVenteHT,
        `idCategorie`= :paramidCategorie,
        `idTVA`= :paramidTVA,
        WHERE idProduit = :paramidProduit');
    $requetePreparée->bindParam('paramidProduit', $idProduit);
    $requetePreparée->bindParam('paramnom', $nom);
    $requetePreparée->bindParam('paramdescription', $description);
    $requetePreparée->bindParam('paramresume', $resume);
    $requetePreparée->bindParam('paramfichierImage', $fichierImage);
    $requetePreparée->bindParam('paramprixVenteHT', $prixVenteHT);
    $requetePreparée->bindParam('paramidCategorie', $idCategorie);
    $requetePreparée->bindParam('paramidTVA', $idTVA);

    $reponse = $requetePreparée->execute(); //$reponse boolean sur l'état de la requête
    return $reponse;
}

function Produit_Supprimer($connexionPDO, $idProduit) {
    $requetePreparée = $connexionPDO->prepare('delete produit.* from `produit` where idProduit = :paramIdProduit');
    $requetePreparée->bindParam('paramIdProduit', $idProduit);
    $reponse = $requetePreparée->execute();
    return $reponse;
}

function Produit_Activation($connexionPDO, $idProduit, $status) {
    $requetePreparée = $connexionPDO->prepare('update produit set statusProduit = :paramStatusProduit where idProduit = :paramIdProduit');
    $requetePreparée->bindParam('paramIdProduit', $idProduit);
    $requetePreparée->bindParam('paramStatusProduit', $status);
    $reponse = $requetePreparée->execute();
    return $reponse;
}

function Produit_Select_ParIdCategorie($connexionPDO, $idCategorie) {
    $requetePreparée = $connexionPDO->prepare('select produit.* from `produit`,`categorie` where categorie.idCategorie = produit.idCategorie and produit.idCategorie = :paramIdCategorie');
    $requetePreparée->bindParam('paramIdCategorie', $idCategorie);
    $reponse = $requetePreparée->execute(); 
    $tableauReponse = $requetePreparée->fetchAll(PDO::FETCH_ASSOC);
    return $tableauReponse;
}

function Produit_Supprimer_ParIdCategorie($connexionPDO, $idCategorie) {
    $requetePreparée = $connexionPDO->prepare('delete produit.* from `produit` where idCategorie = :paramIdCategorie');
    $requetePreparée->bindParam('paramIdCategorie', $idCategorie);
    $reponse = $requetePreparée->execute();
    return $reponse;
}
