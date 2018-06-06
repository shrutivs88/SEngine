<?php
session_start();
/**
 * Admin Only Allowed
 */
if($_SESSION['role'] !== "ADMIN") {
    header("Location: ../../views/error/noaccess.php");
}

include_once($_SERVER['DOCUMENT_ROOT'].'/'. explode("/", $_SERVER['PHP_SELF'])[1] .'/config.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/'. explode("/", $_SERVER['PHP_SELF'])[1] .'/services/ClientService.php');

$clientService = new ClientService();

$searchQuery = $_POST["searchQuery"];
$contactsByFirstName = array();
$contactsByLastName = array();
$contactsByEmail = array();
$contactsByFirstName = $clientService->getAllContactsLikeFirstName($searchQuery);
$contactsByLastName = $clientService->getAllContactsLikeLastName($searchQuery);
$contactsByEmail = $clientService->getAllContactsLikeEmail($searchQuery);
filterDuplicateEntries();
$results = mergeResults();
header('Content-Type: application/json');
echo json_encode($results);

function filterDuplicateEntries() {
    global $contactsByFirstName, $contactsByLastName, $contactsByEmail;
    for($i=0; $i<count($contactsByEmail); $i++) {
        for($j=0; $j<count($contactsByFirstName); $j++) {
            if($contactsByEmail[$i]->getEmail() == $contactsByFirstName[$j]->getEmail()) {
                unset($contactsByFirstName[$j]);
                $contactsByFirstName = array_values($contactsByFirstName);
                $j--;
            }
        }
        for($k=0; $k<count($contactsByLastName); $k++) {
            if($contactsByEmail[$i]->getEmail() == $contactsByLastName[$k]->getEmail()) {
                unset($contactsByLastName[$k]);
                $contactsByLastName = array_values($contactsByLastName);
                $k--;
            }
        }
    }
}

function mergeResults() {
    global $contactsByFirstName, $contactsByLastName, $contactsByEmail;
    $results = array_merge($contactsByFirstName, $contactsByLastName, $contactsByEmail);
    return $results;
}