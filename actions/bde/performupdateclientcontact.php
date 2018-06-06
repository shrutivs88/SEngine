<?php
session_start();

include_once($_SERVER['DOCUMENT_ROOT'].'/'. explode("/", $_SERVER['PHP_SELF'])[1] .'/config.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/'. explode("/", $_SERVER['PHP_SELF'])[1] .'/services/ClientService.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/'. explode("/", $_SERVER['PHP_SELF'])[1] .'/models/Contact.php');

$clientService = new ClientService();
$contact = new Contact();
$clientId = $_POST['clientId'];

setContactDetails();

function setContactDetails(){
    global $contact;
    $contact->setId($_POST['clientId']);
    $contact->setFirstName($_POST['clientFirstName']);
    $contact->setLastName($_POST['clientLastName']);
    $Email = $_POST['clientEmail'];
    $Email2 = $_POST['clientEmail2'];
    $Email3 = $_POST['clientEmail3'];
    

     if((($Email2 == null)||($Email2 == "") ||($Email2 == undefined)) && (($Email3 == null)||($Email3 == "") ||($Email3 == undefined))){
          
          $clientEmail = $_POST['clientEmail'];   
      }else{
          $email = array();
         array_push($email,$Email,$Email2);
         if($Email3 != ""){
              array_push($email,$Email3);
         }
         
          $clientEmail = implode(",",$email);
      }
    $contact->setEmail($clientEmail);
    $contact->setCategory($_POST['clientCategory']);
    $contact->setDesignation($_POST['clientDesignation']);
    $contact->setPhone1($_POST['clientPhone1']);
    $contact->setPhone2($_POST['clientPhone2']);
    $contact->setCountry($_POST['clientCountry']);
    $contact->setState($_POST['clientState']);
    $contact->setCity($_POST['clientCity']);
    $contact->setAddress($_POST['clientAddress']);
    $contact->setLinkedIn($_POST['clientLinkedInId']);
    $contact->setFacebook($_POST['clientFacebookId']);
    $contact->setTwitter($_POST['clientTwitterId']);

}

$updateOfContacts = $clientService->updateContactsByContactId($clientId,$contact);
 
if($updateOfContacts==true)
{
 $_SESSION['serverMsg'] = "Client Details updated successfuly";
 
}else{

 $_SESSION['serverMsg'] = "<p class='text-center' style='color:red; font-size:18px;'> No Edit is done</p>";
}

header('Content-Type: application/json');
echo json_encode($updateOfContacts);

?>

