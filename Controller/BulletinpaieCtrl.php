<?php
require '../connexion.php';
header('Access-Control-Allow-Origin:*');
header("Access-Control-Allow-Methods:POST");
header('Content-Type: application/json'); 

$body = file_get_contents('php://input');
$info = (array)json_decode($body);
$response = array();

if($_SERVER['REQUEST_METHOD']=='POST'){

    //CREATE or SAVE PROF
    if($info['instruction']==7){
        $matricule = $info['matricule'];
        $stmt = $conn->prepare("SELECT designation,tauxhoraire,nbheure FROM matieres,professeurs,volumehoraires WHERE volumehoraires.matricule = professeurs.matricule AND volumehoraires.numat = matieres.numat AND professeurs.matricule=:matricule");
        $stmt->bindParam(":matricule", $matricule);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $data = $stmt->fetchAll();
        foreach ($data as $row) {
            $response[] = array('designation'=>$row['designation'],'tauxhoraire'=>$row['tauxhoraire'],
            'nbheure'=>$row['nbheure'],'montant'=>$row['tauxhoraire']*$row['nbheure']);
        }
        return print json_encode($response);
    }
}

//HEURE COMPLEMENTAIRE
    if($info['instruction']==8){
        $matricule = $info['matricule'];
        $stmt = $conn->prepare("SELECT designation,tauxhoraire,nbheure FROM matieres,professeurs,volumehoraires WHERE volumehoraires.matricule = professeurs.matricule AND volumehoraires.numat = matieres.numat AND professeurs.matricule=:matricule");
        $stmt->bindParam(":matricule", $matricule);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $data = $stmt->fetchAll();
        $montant = 0;
        foreach ($data as $row) {
            // $response[] = array('designation'=>$row['designation'],'tauxhoraire'=>$row['tauxhoraire'],
            // 'nbheure'=>$row['nbheure'],'montant'=>$row['tauxhoraire']*$row['nbheure']);
            $montant += $row['tauxhoraire']*$row['nbheure'];
        }
        $response = array('matricule'=>$matricule,'montant'=>$montant);
        return print json_encode($response);
    }