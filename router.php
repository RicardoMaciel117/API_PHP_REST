<?php

/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//46:05
//*/

$matches = [];

if (preg_match('/\/([^\/]+)\/([^\/]+)/', $_SERVER["REQUEST_URI"], $matches)) {
    
    $_GET['resource_type'] = $matches[1]; $_GET['resource_id'] = $matches[2];
    error_log(print_r($matches, 1));
    require 'server.php';
}
else if (preg_match('/\/([^\/]+)\/?/', $_SERVER["REQUEST_URI"], $matches) ) {
    $_GET['resource_type'] = $matches[1];
    error_log( print_r($matches, 1) );
    require 'server.php';
}
else {
    error_log('No matches');
    http_response_code( 404 );
}

?>