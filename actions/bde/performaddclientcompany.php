<?php
session_start();
/*include_once($_SERVER['DOCUMENT_ROOT'].'/'. explode("/", $_SERVER['PHP_SELF'])[1] .'/utility/DatabaseManager.php');
  $data = new DatabaseManager();
  $conn = $data->getconnection();
  $userId = $_SESSION["userId"];
*/
include_once($_SERVER['DOCUMENT_ROOT'].'/'. explode("/", $_SERVER['PHP_SELF'])[1] .'/config.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/'. explode("/", $_SERVER['PHP_SELF'])[1] .'/services/ClientService.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/'. explode("/", $_SERVER['PHP_SELF'])[1] .'/services/LocationService.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/'. explode("/", $_SERVER['PHP_SELF'])[1] .'/models/Company.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/'. explode("/", $_SERVER['PHP_SELF'])[1] .'/models/Contact.php');

$locationService = new LocationService();
$clientService = new ClientService();
$company = new Company();
$contact = new Contact();

  $companyName = $_POST['companyName'];
  $companyWebsite =$_POST['companyWebsite'];
  $companyEmail=$_POST['companyEmail'];
  $companyPhone=$_POST['companyPhone'];
  $companyLinkedIn=$_POST['companyLinkedIn'];
  $companyAddress =$_POST['companyAddress'];
  

// check company details validation
if($companyName == "" || $companyWebsite =="" || $companyEmail == "" || $companyPhone == "" ||  $companyLinkedIn == "" || $companyAddress == "" )
{
  $_SESSION['server-msg']= "<p class='text-center' style='color:red;'>One or more fields are blank, fill all fields and even client details</p>";
  header('HTTP/1.0 404 Not Found');
  header('Content-Type: application/json; charset=UTF-8');
  die(json_encode(array('message' => 'ERROR', 'code' => 1337)));
}

//if this check fails echo company website already added
//Company unique query 
setCompanyDetails();                                                                   


function setCompanyDetails() {
  global $company;
  $company->setName($_POST['companyName']);
  $companyWebsite = $_POST['companyWebsite'];
  $company->setWebsite(trim($companyWebsite,""));
  $company->setAddress($_POST['companyAddress']);
  $company->setPhone($_POST['companyPhone']);
  $company->setEmail($_POST['companyEmail']);
  $company->setLinkedIn($_POST['companyLinkedIn']);
  
}
if(isset($_POST['clientDetails'])){
   if(isset($_POST['clientDetails'])) {
  
     // echo "<h3> One or more fields are not filled </h3>";
         $clientDetails= $_POST['clientDetails'];
        
         $errors = [];
         $email = array();
            foreach($clientDetails as $client) {
              //get all values
              $clientFirstName = $client["clientFirstName"];
              $clientLastName = $client["clientLastName"];
              $Email = $client["clientEmail"];
              array_push($email,$Email);
              if(isset($client["clientEmail2"])) {
                $Email2 = $client["clientEmail2"];
                array_push($email,$Email2);
              }
              if(isset($client["clientEmail3"])) {
                $Email3 = $client["clientEmail3"];
                array_push($email,$Email3);
              }
              $clientEmail = implode(',',$email);    
           //   $clientMobile = $client["clientMobile"];
              $clientPhone1 = $client["clientPhone1"];
              $clientPhone2 = $client["clientPhone2"];
              $clientCategory = $client["clientCategory"];
              $clientDesignation = $client["clientDesignation"];
              $clientAddress = $client["clientAddress"];
              $clientCountry = $client["clientCountry"];
              $clientState = $client["clientState"];
              $clientCity = $client["clientCity"];
              $clientLinkedInid = $client["clientLinkedInid"];
              $clientFacebookid = $client["clientFacebookid"];
              $clientTwitterid = $client["clientTwitterid"];
                             
              //setting the value of clients
              $contact->setFirstName($clientFirstName);
              $contact->setLastName($clientLastName);
              $contact->setEmail($clientEmail);
             // $contact->setMobile($clientMobile);
              $contact->setPhone1($clientPhone1);
              $contact->setPhone2($clientPhone2);
              $contact->setCategory($clientCategory);
              $contact->setDesignation($clientDesignation);
              $contact->setAddress($clientAddress);
              $contact->setCountry($clientCountry);
              $contact->setState($clientState);
              $contact->setCity($clientCity);
              $contact->setLinkedIn($clientLinkedInid);
              $contact->setFacebook($clientFacebookid);
              $contact->setTwitter($clientTwitterid);
              $addclientwithcompany = $clientService->addclientwithcompany($company,$contact); 
              $email = array(); 
  }
 
  $_SESSION["serverMsg"] = "<p class='text-center' style='color:green;'>Client Added Successfully!</p>";

}

}
?>