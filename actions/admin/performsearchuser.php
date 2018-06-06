<?php
session_start();
/**
 * Admin Only Allowed
 */
if($_SESSION['role'] !== "ADMIN") {
    header("Location: ../../views/error/noaccess.php");
}

include_once($_SERVER['DOCUMENT_ROOT'].'/'. explode("/", $_SERVER['PHP_SELF'])[1] .'/config.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/'. explode("/", $_SERVER['PHP_SELF'])[1] .'/services/UserService.php');

$userService = new UserService();

$searchQuery = $_POST["searchQuery"];
$roleId = $_POST["roleId"];

$usersByName = array();
$usersByEmail = array();
$usersByName =  $userService->getAllLikeNameAndRole($searchQuery, $roleId);
$usersByEmail = $userService->getAllLikeEmailAndRole($searchQuery, $roleId);
filterDuplicateEntries();
$results = mergeResults();
header('Content-Type: application/json');
echo json_encode($results);

function filterDuplicateEntries() {
    global $usersByName, $usersByEmail;
    for($i=0; $i<count($usersByName); $i++) {
        for($j=0; $j<count($usersByEmail); $j++) {
            if($usersByName[$i]->getEmail() == $usersByEmail[$j]->getEmail()) {
                unset($usersByEmail[$j]);
                $usersByEmail = array_values($usersByEmail);
                $j--;
            }
        }
    }
}

function mergeResults() {
    global $usersByName, $usersByEmail;
    $results = array_merge($usersByName, $usersByEmail);
    return $results;
}

?>