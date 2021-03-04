<?php

//header richiesto
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=UTF-8");

//inclusione del database e dei files object
include_once "../config/database.php";
include_once "../objects/universita.php";

//istanziamento degli oggetti database e universita
$database = new Database();
$db = $database->getConnection();

//inizializzazione di universita
$universita = new Universita($db);

//query universita
$stmt = $universita->read();
$num = $stmt->rowCount();

if($num > 0) {
    //array di universita
    $universita_arr = array();
    $universita_arr["records"] = array();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
    
        $universita_item = array(
            "ID_Uni" => $id,
            "Nome" => $nome,
            "Citta" => $citta
        );

        array_push($universita_arr["records"], $universita_item);
    }

    //Set response code - 200 OK
    http_response_code(200);

    //visualizza dati universita in formato JSON
    echo json_encode($universita_arr);
} else {
    //set responde code - 404 Not found
    http_response_code(404);

    //tell the user no universita found
    echo json_encode(array("message" => "Nessuna universita presente."));
};

?>