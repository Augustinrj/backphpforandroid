<?php
require './connexion.php';
header("Access-Control-Allow-Origin:*");
header('Content-Type:application/json');

$data = array();
$data2 = array();
$data = array_map('htmlentities', $data);
// if (!empty($_GET)) {
// 	try {
// 		$stmt = $conn->prepare("SELECT * FROM `crud_react` WHERE id LIKE '%" . $_GET['value'] . "%' OR firstname LIKE '%" . $_GET['value'] . "%' OR lastname LIKE '%" . $_GET['value'] . "%' OR adresse LIKE '%" . $_GET['value'] . "%' OR pays LIKE '%" . $_GET['value'] . "%'");
// 		if ($_GET['value'] == '*') {
// 			$stmt = $conn->prepare("SELECT * FROM `crud_react`");
// 		}

// 	} catch (PDOException $e) {
// 		echo "Error: " . $e->getMessage();
// 	}
// } else {
// 	$stmt = $conn->prepare("SELECT * FROM `crud_react`");
// }
$stmt = $conn->prepare("SELECT * FROM professeurs");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$dataResult = $stmt->fetchAll();
$json = html_entity_decode(json_encode($dataResult));
$conn = null;
echo $json;
// echo $data2;