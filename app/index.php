<?php 
header_remove();
header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
header('Content-Type: application/json');

include 'autoload.php';
include 'routes.php';

