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
include_once($_SERVER['DOCUMENT_ROOT'].'/'. explode("/", $_SERVER['PHP_SELF'])[1] .'/models/Contact.php');
$clientService = new ClientService();
$contact = new Contact();
$originalEmail = $_POST["contact-original-email"];
setContactDetails();
saveContactDetails();

function setContactDetails() {
    global $contact;
    $contact->setId($_POST['contact-id']);
    $contact->setFirstName($_POST['contact-first-name']);
    $contact->setLastName($_POST['contact-last-name']); 
    $Email = $_POST['contact-email'];
    $Email2 = $_POST['contact-email2'];
    $Email3 = $_POST['contact-email3'];
     if((($Email2 == null)||($Email2 == "") ||($Email2 == undefined)) && (($Email3 == null)||($Email3 == "") ||($Email3 == undefined))){
          
          $clientEmail = $_POST['contact-email'];   
      }else{
          $email = array();
         array_push($email,$Email,$Email2);
         if($Email3 != ""){
              array_push($email,$Email3);
         }
         
          $clientEmail = implode(",",$email);
      }
    $contact->setEmail($clientEmail);
    $contact->setCategory($_POST['contact-category']);
    $contact->setDesignation($_POST['contact-designation']);
    $contact->setPhone1($_POST['contact-phone1']);
    $contact->setPhone2($_POST['contact-phone2']);
    $contact->setCountry($_POST['contact-country']);
    $contact->setState($_POST['contact-state']);
    $contact->setCity($_POST['contact-city']);
    $contact->setAddress($_POST['contact-address']);
    $contact->setLinkedIn($_POST['contact-linkedin']);
    $contact->setFacebook($_POST['contact-facebook']);
    $contact->setTwitter($_POST['contact-twitter']);
}

function saveContactDetails() {
    global $clientService, $contact, $originalEmail;
    $contactValidityStatus = validateContactDetails();
    if($contactValidityStatus === true) {
        if($clientService->checkContactEmailAllowSelf($contact->getEmail(), $originalEmail)) {
            $clientService->updateContact($contact);
            $_SESSION['serverMsg'] = "Client Contact Updated Successfully!";
            header("Location:../../views/user/admin/clientcontactlist.php");
            exit;
        } else {
            $_SESSION['serverMsg'] = ERR_CONTACT_EXISTS;
            header("Location:../../views/user/admin/showcontact.php?contactId=".$contact->getId());
            exit;
        }
    } else {
        $_SESSION['serverMsg'] = $contactValidityStatus;
        header("Location:../../views/user/admin/showcontact.php?contactId=".$contact->getId());
        exit;
    }
}
/* || $contact->getLinkedIn() == "" || $contact->getFacebook() == "" || 
                    $contact->getTwitter() == ""*/
function validateContactDetails() {
    global $contact;
    if($contact->getFirstName() == "" || $contact->getLastName() == "" || $contact->getEmail() == "" || 
        $contact->getCategory() == "" || $contact->getDesignation() == "" || $contact->getPhone1() == "" || 
            $contact->getPhone2() == ""|| $contact->getCity() == "" || $contact->getState() == "" || $contact->getCountry() == "" || 
                $contact->getAddress() == "" ) {
                        return ERR_BLANK;
                    }
                    return true;
}

?>