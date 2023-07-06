<?php
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/
header('Access-Control-Allow-Origin: *');
/*
if (!array_key_exists('HTTP_X_TOKEN', $_SERVER)){
    die;
}


$url = 'http://localhost:8001';

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, ["X-Token: {$SERVER['HTTP_X_TOKEN']}"]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$ret = curl_exec($ch);

if($ret === 'true'){
    die;
}
*/
//Define Allowed reosurces
$allowedResourceTypes = [
    'books',
    'authors',
    'genres'
];

//verify allowed resource
$resourceType = $_GET['resource_type'];

if( !in_array($resourceType, $allowedResourceTypes) ){
    http_response_code(400);
    die;
}

$books = [
    1 => [
        "id_book" => 1,
        "title" => "Lo que el viento se llevo",
        "id_author" => 3
    ],
    2 => [
        "id_book" => 2,
        "title" => "La Illiada",
        "id_author" => 6
    ],
    3 => [
        "id_book" => 9,
        "title" => "La Odisea",
        "id_author" => 9
    ]
];

header( 'Content-Type: application/json' );

$resourceId = array_key_exists('resource_id', $_GET) ? $_GET['resource_id'] : '';


//Render response
switch( strtoupper($_SERVER['REQUEST_METHOD']) ){
    case 'GET':
        
        if( empty($resourceId) ){
            echo json_encode($books);
        }
        else{
            
            if(array_key_exists($resourceId, $books)){
                echo json_encode($books[ $resourceId ]);
            }
            else{
                http_response_code(404);
            }
            
        }
        break;
    case 'POST':
        $json = file_get_contents('php://input');
        
        $books[] = json_decode( $json, true );
        //echo array_keys( $books )[ count($books) - 1 ];
        
        echo json_encode( $books ).PHP_EOL;
        
        break;
    case 'PUT':
        
        //Validar que el recurso buscado exista
        if( !empty($resourceId) && array_key_exists($resourceId, $books) ){
            $json = file_get_contents('php://input');
            $books[ $resourceId ] = json_decode( $json, true );
            
            echo json_encode( $books );
        }
        break;
    case 'DELETE':
        
        if( !empty($resourceId) && array_key_exists($resourceId, $books) ){
            unset( $books[$resourceId] );
        }
        
        echo json_encode( $books );
        
        break;
}



/*
* Metodo de autenticación por hashes

if(!array_key_exists('HTTP_X_HASH', $_SERVER) || !array_key_exists('HTTP_X_TIMESTAMP', $_SERVER) || !array_key_exists('HTTP_X_UID', $_SERVER)){
    die;
}

list( $hash, $uid, $timestamp ) = [$_SERVER['HTTP_X_HASH'], $_SERVER['HTTP_X_UID'], $_SERVER['HTTP_X_TIMESTAMP']];

$secret = 'Nose lo cuente a nandie pap';

$newHash = sha1( $uid.$timestamp.$secret );

*
*/



?>