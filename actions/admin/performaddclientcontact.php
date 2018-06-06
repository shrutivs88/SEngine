<?php
session_start();
if(!isset($_SESSION["email"])) {
    header("Location:../login.php");
}

include_once($_SERVER['DOCUMENT_ROOT'].'/'. explode("/", $_SERVER['PHP_SELF'])[1] .'/config.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/'. explode("/", $_SERVER['PHP_SELF'])[1] .'/services/ClientService.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/'. explode("/", $_SERVER['PHP_SELF'])[1] .'/models/Contact.php');

$clientService = new ClientService();
$contact = new Contact();
setContactDetails();
saveContactDetails();

function setContactDetails() {
    global $contact;
    $email = array();
    $contact->setFirstName($_POST['contact-first-name']);
    $contact->setLastName($_POST['contact-last-name']);
    $Email = $_POST['contact-email'];
              array_push($email,$Email);
              if(isset($_POST["contact-email2"] )) {
                $Email2 = $_POST["contact-email2"];
                array_push($email,$Email2);
                if(isset($_POST["contact-email3"])) {
                $Email3 = $_POST["contact-email3"];
                array_push($email,$Email3);
              }
              $clientEmail = implode(',',$email);
              }            
    $contact->setEmail($clientEmail);
    $contact->setCategory($_POST['contact-category']);
    $contact->setDesignation($_POST['contact-designation']);
    //$contact->setMobile($_POST['contact-mobile']);
    $contact->setPhone1($_POST['contact-phone1']);
    $contact->setPhone2($_POST['contact-phone2']);
    $contact->setCountry($_POST['contact-country']);
    $contact->setState($_POST['contact-state']);
    $contact->setCity($_POST['contact-city']);
    $contact->setAddress($_POST['contact-address']);
    $contact->setLinkedIn($_POST['contact-linkedin']);
    $contact->setFacebook($_POST['contact-facebook']);
    $contact->setTwitter($_POST['contact-twitter']);
    $contact->setCompany($_POST['company-id']);
}

function saveContactDetails() {
    global $clientService, $contact;
    $contactValidityStatus = validateContactDetails();
    if($contactValidityStatus === true) {
          if($clientService->checkContactEmail($contact->getEmail())) {
            $company = $clientService->getCompanyById($_POST['company-id']);
            $contact->setAssocManager($company->getAssocManager());
            $contact->setAssocUser($company->getAssocUser());
            $clientService->saveContact($contact);
            $_SESSION['serverMsg'] = "Client Contact Saved Successfully!";
            header("Location:../../views/user/admin/showcompany.php?companyId=".$contact->getCompany());
            exit;
        } else {
            $_SESSION['serverMsg'] = ERR_CONTACT_EXISTS;
            header("Location:../../views/user/admin/addclientcontact.php?companyId=".$contact->getCompany());
            exit;
        }
    } else {
        $_SESSION['serverMsg'] = $contactValidityStatus;
        header("Location:../../views/user/admin/addclientcontact.php?companyId=".$contact->getCompany());
        exit;
    }
}

function validateContactDetails() {
    global $contact;
    if($contact->getFirstName() == "" || $contact->getLastName() == "" || $contact->getEmail() == "" || 
        $contact->getCategory() == "" || $contact->getDesignation() == "" || $contact->getPhone1() == "" || 
            $contact->getPhone2() == "" || $contact->getCity() == "" || $contact->getState() == "" || 
                $contact->getCountry() == "" || $contact->getAddress() == "")
                    {
                        return ERR_BLANK;
                    }
                    return true;
}

?>