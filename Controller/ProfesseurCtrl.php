<?php
require '../Model/Professeur.php';
require '../connexion.php';
header('Access-Control-Allow-Origin:*');
header("Access-Control-Allow-Methods:POST");
header('Content-Type: application/json'); 

$body = file_get_contents('php://input');
$info = (array)json_decode($body);
// var_dump($info);
// var_dump($_POST);
$data = array();
$data = array_map('htmlentities', $data);

// var_dump($info);
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST'){

    //CREATE or SAVE PROF
    if($info['instruction']==1){
        $matricule = $info['matricule'];
        $name = $info['name'];
        try{
            $professeur = new Professeur();
            $saved = $professeur->save($matricule,$name,$conn);
            $response['error'] = false;
            $response['message'] = 'Professeur saved successfully';
        }catch (Exception $e){
            $response['error'] = true;
            $response['message'] = 'Please try later or existed matricule';
        }
    }

    //ReadAll PROF
    elseif($info['instruction']==2){
        try{
            $professeur = new Professeur();
            $result = $professeur->readAll($conn);
            return print $result;
        }catch (Exception $e){
            $response['error'] = true;
            $response['message'] = 'Please try later';
        }
    }

    //READ
    elseif ($info['instruction']==3) {
        $matricule = $info['matricule'];
       try{
          $professeur = new Professeur(); 
          $result = $professeur->read($matricule,$conn);
          return print ($result);

        }catch (Exception $e){
            $response['error'] = true;
            $response['message'] = 'Please try later';
        }
    }

    //Get by String
    elseif ($info['instruction']==4) {
        $chaine = $info['chaine'];
       try{
          $professeur = new Professeur(); 
          $result = $professeur->readByString($chaine,$conn);
          return print $result;

        }catch (Exception $e){
            $response['error'] = true;
            $response['message'] = 'Please try later';
            echo " error : ".$e;
        }
    }

    //UPDATE
    elseif ($info['instruction']==5) {
        $matricule = $info['matricule'];
        $name = $info['name'];
       try{
          $professeur = new Professeur(); 
          $professeur->update($matricule,$name,$conn);
          $response['error'] = false;
          $response['message'] = 'Professeur updated successfully';
        }catch (Exception $e){
            $response['error'] = true;
            $response['message'] = 'Please try later';
        }
    }

    //DELETE
    elseif ($info['instruction']==6) {
        $matricule = $info['matricule'];
       try{
          $professeur = new Professeur(); 
          $professeur->delete($matricule,$conn);
          $response['error'] = false;
          $response['message'] = 'Professeur deleted successfully';
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