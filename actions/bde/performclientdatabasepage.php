<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'].'/'. explode("/", $_SERVER['PHP_SELF'])[1] .'/services/ClientService.php');

$clientService = new ClientService();
$contact = new Contact();
$userId = $_SESSION["userId"];
$offset = $_POST['offsetVal'];
$fetchclient = $clientService->fetchclientdata($userId,$offset);
       
//var_dump($fetchclient);
//die;
header('Content-Type: application/json');
echo json_encode($fetchclient);

 
?>
