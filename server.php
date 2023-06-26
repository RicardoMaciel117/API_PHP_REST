<?php

//Define Allowed reosurces
$allowedResourceTypes = [
    'books',
    'authors',
    'genres'
];

//verify allowed resource
$resourceType = $_GET['resource_type'];

if( !in_array($resourceType, $allowedResourceTypes) ){
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
            
        }
        
        
        break;
    case 'POST':
        break;
    case 'PUT':
        break;
    case 'DELETE':
        break;
}

?>