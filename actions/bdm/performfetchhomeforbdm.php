<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'].'/'. explode("/", $_SERVER['PHP_SELF'])[1] .'/config.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/'. explode("/", $_SERVER['PHP_SELF'])[1] .'/services/ClientService.php');
  
$clientService = new ClientService();
$user_Id = $_POST['userid'];
$BdeAndClientCount = $clientService->getCountOfBDEsAndClientCountacts($user_Id);  
         
  header('Content-Type: application/json');
  echo json_encode($BdeAndClientCount);   
?>