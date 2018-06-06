<?php
session_start();
/**
 * Admin Only Allowed
 */
if($_SESSION['role'] !== "ADMIN") {
    header("Location: ../../error/noaccess.php");
}

include_once($_SERVER['DOCUMENT_ROOT'].'/'. explode("/", $_SERVER['PHP_SELF'])[1] .'/config.php');
$companyId = $_GET['companyId'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sales Team Application</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASEURL; ?>assets/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASEURL; ?>assets/css/styles.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASEURL; ?>assets/font-awesome-4.7.0/css/font-awesome.min.css" />
    <link href='https://fonts.googleapis.com/css?family=Arizonia' rel='stylesheet'>
     <link href='https://fonts.googleapis.com/css?family=Amita' rel='stylesheet'>
    <script src="<?php echo BASEURL; ?>assets/js/jquery.min.js"></script>
    <script src="<?php echo BASEURL; ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo BASEURL; ?>assets/js/admin/addClientContactValidation.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript"></script>
     <style>
    .imp{
        
        font-size: 7px;
        color:red;
    }
    </style>
</head>
<body>
    <?php include 'navbar.php';?>
    <div class="content-view">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3">
                    <?php include("sidemenu.php"); ?>
                </div>
                <div class="col-sm-9">
                    <h2 class="text-center list-heading" id="client-company-heading"></h2>
                    <div class="server-message" id="server-message">
                        <?php
                            if(isset($_SESSION["serverMsg"])) {
                                echo "<p class='text-center'>" . $_SESSION["serverMsg"] . "</p>";
                                unset($_SESSION['serverMsg']);
                            }
                        ?>
                    </div>
                    <div class="row">
                        <div class="col-sm-offset-1 col-sm-10">
                            <form id="addContactForm" class="form-horizontal" action="<?php echo BASEURL; ?>actions/admin/performaddclientcontact.php" method="post">
                               <h5 class="text-center" style="color:brown">Fields which are marked as <span class="glyphicon glyphicon-asterisk imp"></span> is required</h5>
                               <br>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div id="contact-first-name-div" class="form-group form-group-mod">
                                            <label class="control-label col-sm-4">First Name<span class="glyphicon glyphicon-asterisk imp"></span></label>
                                            <div class="col-sm-8">
                                                <input name="contact-first-name"  type="text" placeholder="Enter First Name" class="form-control" onfocusout="validateContactFirstName()">
                                                <p></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div id="contact-last-name-div" class="form-group form-group-mod">
                                            <label class="control-label col-sm-4">Last Name<span class="glyphicon glyphicon-asterisk imp"></span></label>
                                            <div class="col-sm-8">
                                                <input name="contact-last-name" type="text" placeholder="Enter Last Name" class="form-control" onfocusout="validateContactLastName()">
                                                <p></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div id="contact-email-div" class="form-group form-group-mod">
                                            <label class="control-label col-sm-4">E-Mail<span class="glyphicon glyphicon-asterisk imp"></span></label>
                                            <div class="col-sm-8">
                                                <input name="contact-email" type="text" placeholder="Enter E-Mail Address" class="form-control" onfocusout="validateClientEmails1()">
                                                <p></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div id="contact-email2-div" class="form-group form-group-mod">
                                            <label class="control-label col-sm-4">E-Mail2</label>
                                            <div class="col-sm-8">
                                                <input name="contact-email2" type="text" placeholder="Please Enter Second Email" class="form-control" onfocusout="validateClientEmails2()">
                                                <p></p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div id="contact-email3-div" class="form-group form-group-mod">
                                            <label class="control-label col-sm-4">E-Mail3</label>
                                            <div class="col-sm-8">
                                                <input name="contact-email3" type="text" placeholder="Please Enter Third Email" class="form-control" onfocusout="validateClientEmails3()">
                                                <p></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div id="contact-category-div" class="form-group form-group-mod">
                                            <label class="control-label col-sm-4">Category<span class="glyphicon glyphicon-asterisk imp"></span></label>
                                            <div class="col-sm-8">
                                                <input name="contact-category" type="text" placeholder="Enter Category" class="form-control" onfocusout="validateContactCategory()">
                                                <p></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div id="contact-designation-div" class="form-group form-group-mod">
                                            <label class="control-label col-sm-4">Designation<span class="glyphicon glyphicon-asterisk imp"></span></label>
                                            <div class="col-sm-8">
                                                <input name="contact-designation" type="text" placeholder="Enter Designation" class="form-control" onfocusout="validateContactDesignation()">
                                                <p></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div id="contact-phone1-div" class="form-group form-group-mod">
                                            <label class="control-label col-sm-4">Phone No.1<span class="glyphicon glyphicon-asterisk imp"></span></label>
                                            <div class="col-sm-8">
                                                <input name="contact-phone1" type="text" placeholder="Please Enter Phone Number one" class="form-control" onfocusout="validateContactPhone1()">
                                                <p></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div id="contact-phone2-div" class="form-group form-group-mod">
                                            <label class="control-label col-sm-4">Phone No.2<span class="glyphicon glyphicon-asterisk imp"></span></label>
                                            <div class="col-sm-8">
                                                <input name="contact-phone2" type="text" placeholder="Please Enter Phone Number two" class="form-control" onfocusout="validateContactPhone2()">
                                                <p></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                       <div id="contact-linkedin-div" class="form-group form-group-mod">
                                            <label class="control-label col-sm-4">LinkedIn</label>
                                            <div class="col-sm-8">
                                                <input name="contact-linkedin" type="text" placeholder="Enter LinkedIn" class="form-control" onfocusout="validateContactLinkedIn()">
                                                <p></p>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                                <div class="row">
                                   <div class="col-sm-6">
                                       <div id="contact-country-div" class="form-group form-group-mod">
                                            <label class="control-label col-sm-4">Country<span class="glyphicon glyphicon-asterisk imp"></span></label>
                                            <div class="col-sm-8">
                                                <select name="contact-country" class="form-control" onfocusout="validateContactCountry()">
                                                    <option value="">Select Country</option>
                                                </select>
                                                <p></p>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-sm-6">
                                        <div id="contact-twitter-div" class="form-group form-group-mod">
                                            <label class="control-label col-sm-4">Twitter</label>
                                            <div class="col-sm-8">
                                                <input name="contact-twitter" type="text" placeholder="Enter Twitter" class="form-control" onfocusout="validateContactTwitter()">
                                                <p></p>
                                            </div>
                                        </div>    
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                       <div id="contact-state-div" class="form-group form-group-mod">
                                            <label class="control-label col-sm-4">State<span class="glyphicon glyphicon-asterisk imp"></span></label>
                                            <div class="col-sm-8">
                                                <select name="contact-state" class="form-control" onfocusout="validateContactState()">
                                                    <option value="">Select State</option>
                                                </select>
                                                <p></p>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-sm-6">
                                        <div id="contact-facebook-div" class="form-group form-group-mod">
                                            <label class="control-label col-sm-4">Facebook</label>
                                            <div class="col-sm-8">
                                                <input name="contact-facebook" type="text" placeholder="Enter Facebook" class="form-control" onfocusout="validateContactFacebook()">
                                                <p></p>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div id="contact-city-div" class="form-group form-group-mod">
                                            <label class="control-label col-sm-4">City<span class="glyphicon glyphicon-asterisk imp"></span></label>
                                            <div class="col-sm-8">
                                                <select name="contact-city" class="form-control" onfocusout="validateContactCity()">
                                                    <option value="">Select City</option>
                                                </select>
                                                <p></p>
                                            </div>
                                        </div>  
                                    </div>
                                    <div class="col-sm-6">
                                        <div id="contact-address-div" class="form-group form-group-mod">
                                            <label class="control-label col-sm-4">Address<span class="glyphicon glyphicon-asterisk imp"></span></label>
                                            <div class="col-sm-8">
                                                <textarea name="contact-address" placeholder="Enter Address" class="form-control" style="resize: none;" onfocusout="validateContactAddress()"></textarea>
                                                <p></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="company-id" value="<?php echo $companyId; ?>">
                                <div class="row text-center form-group-mod">
                                    <button id="contactSuccessBtn" type="button" class="btn btn-primary form-btn btn-identical-dimension" onclick="saveContactForm()">Save</button>
                                    <button id="contactFailBtn" type="button" class="btn btn-danger form-btn btn-identical-dimension" onclick="addContactFormReset()">Reset</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.php';?>
    <script>
        $(document).ready(function() {
            loadCompany(<?php echo $companyId; ?>);
            loadCountriesIntoContactForm();
            $("#contact-country-div select").change(function() {
                var stateOptionsBuilder = "<option value=''>Select State</option>";
                var cityOptionsBuilder = "<option value=''>Select City</option>";
                if($("#contact-country-div select").val() !== "") {    
                    loadStatesForCountry($("#contact-country-div select").val());
                    $("#contact-city-div select").html(cityOptionsBuilder);
                    return;
                }
                $("#contact-state-div select").html(stateOptionsBuilder);
                $("#contact-city-div select").html(cityOptionsBuilder);
                    
            });
            $("#contact-state-div select").change(function() {
                var cityOptionsBuilder = "<option value=''>Select City</option>";
                if($("#contact-state-div select").val() !== "") {
                    loadCitiesForState($("#contact-state-div select").val());
                    return;
                }
                $("#contact-city-div select").html(cityOptionsBuilder);
                    
            });
        });

        function loadCompany(companyId) {
            $.ajax({
                type: "POST",
                url: "<?php echo BASEURL ?>actions/admin/performfetchcompany.php",
                data: {
                    companyId: companyId 
                },
                success: function(companyResponse) {
                    $("#client-company-heading").text('Add Client For Company "' + companyResponse.name + '"');
                }
            });
        }

        function validateContactFields() {
            validateContactFirstName();
            validateContactLastName();
            validateClientEmails1();
            validateClientEmails2();
            validateClientEmails3();
            validateContactCategory();
            validateContactDesignation();
           // validateContactMobile();
            validateContactPhone1();
            validateContactPhone2();
            validateContactCountry();
            validateContactState();
            validateContactCity();
            validateContactLinkedIn();
            validateContactFacebook();
            validateContactTwitter();
            validateContactAddress();
            if(contactFirstNameErrFlag == false && contactLastNameErrFlag == false && contactEmailErrFlag == false && 
                contactCategoryErrFlag == false && contactDesignationErrFlag == false && contactPhone1ErrFlag == false &&
                    contactPhone2ErrFlag == false && contactCountryErrFlag == false && contactStateErrFlag == false && contactCityErrFlag == false && 
                        contactLinkedInErrFlag == false && contactFacebookErrFlag == false && contactTwitterErrFlag == false &&
                            contactAddressErrFlag == false) {
                                return true;
                            }else{
                                return false;      
                            }
                                
        }

        function saveContactForm() {
            if(validateContactFields()) {
                //console.log($("#addContactForm").attr('href'));
                $("#addContactForm").submit();
            }
        }

        function loadCountriesIntoContactForm() {
            $.ajax({
                type: "POST",
                url: "<?php echo BASEURL ?>actions/admin/performfetchlocation.php",
                data: {
                    locationType: "country"
                },
                success: function(response) {
                    if(response.length == 0) {
                        return;
                    }
                    var optionsBuilder = "<option value=''>Select Country</option>";
                    for(var i=0; i<response.length; i++) {
                        optionsBuilder += "<option value='" + response[i].id + "'>";
                        optionsBuilder += response[i].name;
                        optionsBuilder += "</option>";
                    }
                    $("#contact-country-div select").html(optionsBuilder);
                }
            });
        }
        
        function loadStatesForCountry(countryId) {
            $.ajax({
                type: "POST",
                url: "<?php echo BASEURL ?>actions/admin/performfetchlocation.php",
                data: {
                    locationType: "state",
                    countryId: countryId
                },
                success: function(response) {
                    var optionsBuilder = "<option value=''>Select State</option>";
                    if(response.length == 0) {
                        $("#contact-state-div select").html(optionsBuilder);
                        return;
                    }
                    for(var i=0; i<response.length; i++) {
                        optionsBuilder += "<option value='" + response[i].id + "'>";
                        optionsBuilder += response[i].name;
                        optionsBuilder += "</option>";
                    }
                    $("#contact-state-div select").html(optionsBuilder);
                }
            });
        }

        function loadCitiesForState(stateId) {
            $.ajax({
                type: "POST",
                url: "<?php echo BASEURL ?>actions/admin/performfetchlocation.php",
                data: {
                    locationType: "city",
                    stateId: stateId
                },
                success: function(response) {
                    var optionsBuilder = "<option value=''>Select City</option>";
                    if(response.length == 0) {
                        $("#contact-city-div select").html(optionsBuilder);
                        return;
                    }
                    for(var i=0; i<response.length; i++) {
                        optionsBuilder += "<option value='" + response[i].id + "'>";
                        optionsBuilder += response[i].name;
                        optionsBuilder += "</option>";
                    }
                    $("#contact-city-div select").html(optionsBuilder);
                }
            });
        }

    </script>
</body>
</html>
