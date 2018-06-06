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
$companiesByName = array();
$companiesByWebsite = array();
$companiesByName =  $clientService->getAllCompaniesLikeName($searchQuery);
$companiesByWebsite = $clientService->getAllCompaniesLikeWebsite($searchQuery);
filterDuplicateEntries();
$results = mergeResults();
header('Content-Type: application/json');
echo json_encode($results);

function filterDuplicateEntries() {
    global $companiesByName, $companiesByWebsite;
    for($i=0; $i<count($companiesByName); $i++) {
        for($j=0; $j<count($companiesByWebsite); $j++) {
            if($companiesByName[$i]->getEmail() == $companiesByWebsite[$j]->getEmail()) {
                unset($companiesByWebsite[$j]);
                $companiesByWebsite = array_values($companiesByWebsite);
                $j--;
            }
        }
    }
}

function mergeResults() {
    global $companiesByName, $companiesByWebsite;
    $results = array_merge($companiesByName, $companiesByWebsite);
    return $results;
}