<?php
require '../connexion.php';
class Volumehoraire
{
    /* $numat;
    $matricule,$tauxhoraire;*/
    
    function save($numat,$matricule,$tauxhoraire,$conn){ //CREATE 
        $stmt = $conn->prepare("INSERT INTO volumehoraires (numat,matricule,tauxhoraire) VALUES (:numat,:matricule,:tauxhoraire)");
        $stmt->bindParam(':numat',$numat);
        $stmt->bindParam(':matricule',$matricule);
        $stmt->bindParam(':tauxhoraire',$tauxhoraire);
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    function readAll($conn){
        $stmt = $conn->prepare("SELECT * FROM volumehoraires");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $dataResult = $stmt->fetchAll();
    }

    function read($numat,$matricule,$conn){
        $stmt = $conn->prepare("SELECT * FROM volumehoraires WHERE numat=:numat AND matricule=:matricule");
        $stmt->bindParam(":numat", $numat);
        $stmt->bindParam(":matricule", $matricule);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $dataResult = $stmt->fetchAll();
    }

    function readByString($chaine,$conn){
        $stmt = $conn->prepare("SELECT * FROM volumehoraires WHERE numat LIKE '%".$chaine."%' OR matricule LIKE '%".$chaine."%'");
        $stmt->bindParam(":chaine", $chaine);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $dataResult = $stmt->fetchAll();
    }

    function update($numat,$matricule,$tauxhoraire,$id,$conn){
        $stmt = $conn->prepare("UPDATE volumehoraires SET matricule=:matricule,tauxhoraire=:tauxhoraire,numat=:numat  WHERE id=:id");
        $stmt->bindParam(":matricule", $matricule);
        $stmt->bindParam(":numat", $numat);
        $stmt->bindParam(":tauxhoraire",$tauxhoraire);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }

    function delete($numat,$matricule,$conn){
        $stmt = $conn->prepare("DELETE FROM volumehoraires WHERE numat=:numat AND matricule=:matricule");
        $stmt->bindParam(":numat",$numat);
        $stmt->bindParam(":matricule",$matricule);
        $stmt->execute();
    }

}


