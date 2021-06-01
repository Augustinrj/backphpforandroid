<?php
require '../connexion.php';
header('Content-Type: application/json'); 
class Professeur
{
    /* $matricule;
    public $name;*/
    
    function save($matricule,$name,$conn){ //CREATE 
        $stmt = $conn->prepare("INSERT INTO professeurs (matricule,name) VALUES (:matricule,:name)");
        $stmt->bindParam(':matricule',$matricule);
        $stmt->bindParam(':name',$name);
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    function readAll($conn){
        $stmt = $conn->prepare("SELECT * FROM professeurs");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return json_encode($stmt->fetchAll());
    }

    function read($matricule,$conn){
        $stmt = $conn->prepare("SELECT * FROM professeurs WHERE matricule=:matricule");
        $stmt->bindParam(":matricule", $matricule);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return json_encode($stmt->fetchAll());
    }

    function readByString($chaine,$conn){
        $stmt = $conn->prepare("SELECT * FROM professeurs WHERE matricule LIKE '%".$chaine."%' OR name LIKE '%".$chaine."%'");
        $stmt->bindParam(":chaine", $chaine);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return json_encode($stmt->fetchAll());
    }

    function update($matricule,$name,$conn){
        $stmt = $conn->prepare("UPDATE professeurs SET name=:name WHERE matricule=:matricule");
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":matricule", $matricule);
        $stmt->execute();
    }

    function delete($matricule,$conn){
        $stmt = $conn->prepare("DELETE FROM professeurs WHERE matricule=:matricule");
        $stmt->bindParam(":matricule",$matricule);
        $stmt->execute();
    }

}


