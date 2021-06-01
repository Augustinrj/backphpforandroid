<?php
require '../connexion.php';
class Matiere
{
    /* $numat;
    $designation,$nbheure;*/
    
    function save($numat,$designation,$nbheure,$conn){ //CREATE 
        $stmt = $conn->prepare("INSERT INTO matieres (numat,designation,nbheure) VALUES (:numat,:designation,:nbheure)");
        $stmt->bindParam(':numat',$numat);
        $stmt->bindParam(':designation',$designation);
        $stmt->bindParam(':nbheure',$nbheure);
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    function readAll($conn){
        $stmt = $conn->prepare("SELECT * FROM matieres");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return json_encode($stmt->fetchAll());
    }

    function read($numat,$conn){
        $stmt = $conn->prepare("SELECT * FROM matieres WHERE numat=:numat");
        $stmt->bindParam(":numat", $numat);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $dataResult = $stmt->fetchAll();
    }

    function readByString($chaine,$conn){
        $stmt = $conn->prepare("SELECT * FROM matieres WHERE numat LIKE '%".$chaine."%' OR designation LIKE '%".$chaine."%'");
        $stmt->bindParam(":chaine", $chaine);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $dataResult = $stmt->fetchAll();
    }

    function update($numat,$designation,$nbheure,$conn){
        $stmt = $conn->prepare("UPDATE matieres SET designation=:designation,nbheure=:nbheure WHERE numat=:numat");
        $stmt->bindParam(":designation", $designation);
        $stmt->bindParam(":numat", $numat);
        $stmt->bindParam(":nbheure",$nbheure);
        $stmt->execute();
    }

    function delete($numat,$conn){
        $stmt = $conn->prepare("DELETE FROM matieres WHERE numat=:numat");
        $stmt->bindParam(":numat",$numat);
        $stmt->execute();
    }

}


