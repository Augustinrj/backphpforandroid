<?php
require '../Model/Volumehoraire.php';
require '../connexion.php';
header('Access-Control-Allow-Origin:*');
header("Access-Control-Allow-Methods:POST");
header('Content-Type: application/json'); 

$body = file_get_contents('php://input');
$info = (array)json_decode($body);
$response = array();

if($_SERVER['REQUEST_METHOD']=='POST'){

    //CREATE or SAVE PROF
    if($info['instruction']==1){
        $numat = $info['numat'];
        $matricule = $info['matricule'];
        $tauxhoraire = $info['tauxhoraire'];
        try{
            $volumehoraire = new Volumehoraire();
            $saved = $volumehoraire->save($numat,$matricule,$tauxhoraire,$conn);
            $response['error'] = false;
            $response['message'] = 'volumehoraire saved successfully';
        }catch (Exception $e){
            $response['error'] = true;
            $response['message'] = 'Please try later or existed numat';
        }
    }

    //ReadAll PROF
    elseif($info['instruction']==2){
        try{
            $volumehoraire = new Volumehoraire();
            $result = $volumehoraire->readAll($conn);
            return print json_encode($result);
        }catch (Exception $e){
            $response['error'] = true;
            $response['message'] = 'Please try later';
        }
    }

    //READ
    elseif ($info['instruction']==3) {
        $numat = $info['numat'];
        $matricule = $info['matricule'];
       try{
          $volumehoraire = new Volumehoraire(); 
          $result = $volumehoraire->read($numat,$matricule,$conn);
          echo json_encode($result);

        }catch (Exception $e){
            $response['error'] = true;
            $response['message'] = 'Please try later';
        }
    }

    //Get by String
    elseif ($info['instruction']==4) {
        $chaine = $info['chaine'];
       try{
          $volumehoraire = new Volumehoraire(); 
          $result = $volumehoraire->readByString($chaine,$conn);
          return print json_encode($result);

        }catch (Exception $e){
            $response['error'] = true;
            $response['message'] = 'Please try later';
            echo " error : ".$e;
        }
    }

    //UPDATE
    elseif ($info['instruction']==5) {
        $id = $info['id'];
        $numat = $info['numat'];
        $matricule = $info['matricule'];
        $tauxhoraire = $info['tauxhoraire'];
       try{
          $volumehoraire = new Volumehoraire(); 
          $volumehoraire->update($numat,$matricule,$tauxhoraire,$id,$conn);
          $response['error'] = false;
          $response['message'] = 'volumehoraire updated successfully';
        }catch (Exception $e){
            $response['error'] = true;
            $response['message'] = 'Please try later';
        }
    }

    //DELETE
    elseif ($info['instruction']==6) {
        $numat = $info['numat'];
        $matricule = $info['matricule'];
       try{
          $volumehoraire = new volumehoraire(); 
          $volumehoraire->delete($numat,$matricule,$conn);
          $response['error'] = false;
          $response['message'] = 'volumehoraire deleted successfully';
        }catch (Exception $e){
            $response['error'] = true;
            $response['message'] = 'Please try later';
        }
    }

    else {
        $response['error'] = true;
        $response['message'] = "Invalid request";
    }
}

else {
        $response['error'] = true;
        $response['message'] = "Invalid request";
    }

    $json = html_entity_decode(json_encode($response));
    echo $json;