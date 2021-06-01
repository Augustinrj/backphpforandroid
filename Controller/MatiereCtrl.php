<?php
require '../Model/Matiere.php';
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
        $designation = $info['designation'];
        $nbheure = $info['nbheure'];
        try{
            $matiere = new Matiere();
            $saved = $matiere->save($numat,$designation,$nbheure,$conn);
            $response['error'] = false;
            $response['message'] = 'Matiere saved successfully';
        }catch (Exception $e){
            $response['error'] = true;
            $response['message'] = 'Please try later or existed numat';
        }
    }

    //ReadAll PROF
    elseif($info['instruction']==2){
        try{
            $matiere = new Matiere();
            $result = $matiere->readAll($conn);
            return print $result;
        }catch (Exception $e){
            $response['error'] = true;
            $response['message'] = 'Please try later';
        }
    }

    //READ
    elseif ($info['instruction']==3) {
        $numat = $info['numat'];
       try{
          $matiere = new Matiere(); 
          $result = $matiere->read($numat,$conn);
          return print json_encode($result);

        }catch (Exception $e){
            $response['error'] = true;
            $response['message'] = 'Please try later';
        }
    }

    //Get by String
    elseif ($info['instruction']==4) {
        $chaine = $info['chaine'];
       try{
          $matiere = new Matiere(); 
          $result = $matiere->readByString($chaine,$conn);
          return print json_encode($result);

        }catch (Exception $e){
            $response['error'] = true;
            $response['message'] = 'Please try later';
            echo " error : ".$e;
        }
    }

    //UPDATE
    elseif ($info['instruction']==5) {
        $numat = $info['numat'];
        $designation = $info['designation'];
        $nbheure = $info['nbheure'];
       try{
          $matiere = new Matiere(); 
          $matiere->update($numat,$designation,$nbheure,$conn);
          $response['error'] = false;
          $response['message'] = 'matiere updated successfully';
        }catch (Exception $e){
            $response['error'] = true;
            $response['message'] = 'Please try later';
        }
    }

    //DELETE
    elseif ($info['instruction']==6) {
        $numat = $info['numat'];
       try{
          $matiere = new Matiere(); 
          $matiere->delete($numat,$conn);
          $response['error'] = false;
          $response['message'] = 'matiere deleted successfully';
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
    return print $json;