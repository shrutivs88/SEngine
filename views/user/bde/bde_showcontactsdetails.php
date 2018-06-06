<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'].'/'. explode("/", $_SERVER['PHP_SELF'])[1] .'/config.php');
if(!isset($_SESSION["email"])) {
    header("Location:login.php");
}
 include_once($_SERVER['DOCUMENT_ROOT'].'/'. explode("/", $_SERVER['PHP_SELF'])[1] .'/utility/DatabaseManager.php');
$data = new DatabaseManager();
$conn = $data->getconnection();

$companyId = $_GET['companyId'];
//$comapnyName = $_GET['companyName'];

$companyNameSql = "select client_company_name from client_companies where client_company_id='$companyId' ";
$result = mysqli_query($conn,$companyNameSql);
while($row = mysqli_fetch_object($result)){
  // var_dump($row);
   //die;
    $client_company_name  = $row->client_company_name;
}   

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
    <script src="<?php echo BASEURL; ?>assets/js/bde/validation.js"></script>
    <script>
        var responseData = [];
        var countries=[];
        var states=[];
        var cities=[];
        var count =0;
        var offset = 0;
        var limit = 4;
        var isUpdateOffsetPristine = true; 
  
   $(document).ready(function() {
        preInitilizeLocationChainingEffectBeginByInitCountry();
        initStatesChainingEffect();
        initCitiesChainingEffect();
   });
    $(document).ready(function() {
        count++
        preInitilizeLocationChainingEffectBeginByInitCountry();
        initStatesChainingEffect();
        initCitiesChainingEffect();
        $.ajax({
            type: "Post",
            url: "<?php echo BASEURL; ?>actions/bde/performfetchclientcontacts.php",
            data: {
                companyId:<?php echo $_GET["companyId"] ?>
            },
            success:function(response) {
               //console.log(response);
               //return;
               jQuery.each( response, function( index, value ) {
                responseData.push(jQuery.extend(true, {}, value));
            });
                  if(response.length == 0 && isUpdateOffsetPristine == true) {
                $("#bde-list").html("<h4 class='text-center'>No Clients Are Available!</h4>");
                $("#ajaxButton").hide();
                return;
            } else if(response.length == 0 && isUpdateOffsetPristine == false) {
                $("#bde-list").append("<h4 class='text-center'>No More Clients Are Available!</h4>");
                $("#ajaxButton").hide();
                return;
            }
            var bdeListBuilder = "";
            if(response.length == 0) {
                $("#bde-list").html("<h4 class='text-center'>No Client Are Available!</h4>");
                return;
            }
                for(var i=0; i<response.length; i++) { 
                        var bdeListBuilder = "";
                        bdeListBuilder += "<tr>";
                        bdeListBuilder += "<td>"+ parseInt(count+i) +"</td>";
                        bdeListBuilder += "<td>" + response[i].firstName + "</td>";
                        bdeListBuilder += "<td>" + response[i].lastName + "</td>";
                        bdeListBuilder += "<td>" + response[i].email + "</td>";
                        bdeListBuilder += "<td>" + response[i].phone1 + "</td>";
                        bdeListBuilder += "<td>" + response[i].phone2 + "</td>";
                        bdeListBuilder += "<td>" + response[i].category + "</td>";
                        bdeListBuilder += "<td>" + response[i].designation + "</td>";
                        bdeListBuilder += "<td>" + response[i].address + "</td>";
                        var isCountrySet = false;
                        jQuery.each( countries, function( index, value ) {
                        if(value.country_id == response[i].country) {
                        bdeListBuilder += "<td>" + value.country_name + "</td>";
                        isCountrySet = true;
                        return;
                            }
                        });
                        if(!isCountrySet) {
                        bdeListBuilder += "<td>-</td>";
                        }
                        var isStateSet = false;
                        jQuery.each( states, function( index, value ) {
                        if(value.state_id == response[i].state) {
                        bdeListBuilder += "<td>" + value.state_name + "</td>";
                        isStateSet = true;
                        return;
                            }
                        });
                        if(!isStateSet) {
                        bdeListBuilder += "<td>-</td>";
                        }
                        var isCitySet = false;
                        jQuery.each( cities, function( index, value ) {
                        if(value.city_id == response[i].city) {
                        bdeListBuilder += "<td>" + value.city_name + "</td>";
                        isCitySet = true;
                        return;
                            }
                        });
                        if(!isCitySet) {
                        bdeListBuilder += "<td>-</td>";
                        }
                        bdeListBuilder += "<td>" + response[i].linkedIn + "</td>";
                        bdeListBuilder += "<td>" + response[i].facebook + "</td>";
                        bdeListBuilder += "<td>" + response[i].twitter + "</td>";
                        bdeListBuilder += "<td><button class='btn action-btn ' id='edit' title ='Edit Client' onclick='showEditClient(" + response[i].id+")'><span class='glyphicon glyphicon-edit'></span></button></td>";
                        bdeListBuilder += "</tr>";
                        $("#bde-list-table").append(bdeListBuilder);
                    } 
                    offset += limit;
                    count = count+limit-1;
                }
            });
        });

          //fetching country , state , city
    function preInitilizeLocationChainingEffectBeginByInitCountry() {
        /**Loading all countries */
        $.ajax({
            type: "post",
            url: "<?php echo BASEURL; ?>actions/bde/locationDetails.php",
            data: {
                locationType:"country-all"
            },
            success: function(response) {
                countries = response.data;
                //initStatesChainingEffect();
            }
        });
    }

    function initStatesChainingEffect() {
        $.ajax({
            type: "post",
            url: "<?php echo BASEURL; ?>actions/bde/locationDetails.php",
            data: {
                locationType:"state-all"
            },
            success: function(response) {
                states = response.data;
                //initCitiesChainingEffect();
            }
        });
    }


    function initCitiesChainingEffect() {
        $.ajax({
            type: "post",
            url: "<?php echo BASEURL; ?>actions/bde/locationDetails.php",
            data: {
                locationType:"city-all"
            },
            success: function(response) {
                cities = response.data;
            }
        });
    }  

       
    history.pushState(null, null, location.href);
    window.onpopstate = function () {
        history.go(1);
    };        

//Edit client from company details


     function showEditClient(clientId) {
        $("#myModal").modal();
        data = "";
        $.each(responseData, function( key, value ) {
          //  console.log(responseData);
           if(value.id == clientId) {
               data = value;
               setModalFields(data);
                return;
             }
        });
    }


    function setModalFields(data) {
        $("#clientId").val(data.id);
        $("#clientFirstName").val(data.firstName);
        $("#clientLastName").val(data.lastName);
        var emails = data.email;
        var emailsArray = emails.split("<br>");
        $("#clientEmail").val(emailsArray[0]);
        $("#clientEmail2").val(emailsArray[1]);
        $("#clientEmail3").val(emailsArray[2]);
        $("#clientPhone1").val(data.phone1);
        $("#clientPhone2").val(data.phone2);
        $("#clientCategory").val(data.category);
        $("#clientDesignation").val(data.designation);
        $("#clientAddress").val(data.address);
        $("#clientLinkedInId").val(data.linkedIn);
        $("#clientFacebookId").val(data.facebook);
        $("#clientTwitterId").val(data.twitter);
        $("#clientCompanyId").val(data.company);
        $("#clientDateTime").val(data.added);
        loadCountriesJsonAndSetCountry(data);
        
    }


    function loadCountriesJsonAndSetCountry(data) {
        $.ajax({
            type: "post",
            url: "<?php echo BASEURL; ?>actions/bde/locationDetails.php",
            data: {
                locationType:"country-all"
            },
            success: function(response) {
   
                var optionsCountry = "<option value=''>Select Country</option>";
                        for(var i=0; i<response.data.length; i++) {
                            optionsCountry += "<option value='" + response.data[i].country_id + "'>";
                            optionsCountry += response.data[i].country_name;
                            optionsCountry += "</option>";
                        }
                        $("#clientCountry").html(optionsCountry);
                        $("#clientCountry").val(data.country);
                        if(data.country== 0) {
                            $("#clientCountry").val("");
                        }
                        loadStatesJsonAndSetState(data);
            }
        });
    }

    function loadStatesJsonAndSetState(data) {
        $.ajax({
            type: "post",
            url: "<?php echo BASEURL; ?>actions/bde/locationDetails.php",
            data: {
                country_id: data.country,
                locationType: "state-all-by-country-id"
            },
            success: function(response) {
        
                var optionsStates = "<option value=''>Select State</option>";
                        for(var j=0; j<response.length; j++) {
                            optionsStates += "<option value='" + response[j].state_id + "'>";
                            optionsStates += response[j].state_name;
                            optionsStates += "</option>";
                        }
                        $("#clientState").html(optionsStates);
                        $("#clientState").val(data.state);
                        if(data.state== 0) {
                            $("#clientState").val("");
                        }
                        loadCitiesJsonAndSetCity(data);
            }
        });
    }

    function loadCitiesJsonAndSetCity(data) {
        $.ajax({
            type: "post",
            url: "<?php echo BASEURL; ?>actions/bde/locationDetails.php",
            data: {
                state_id: data.state,
                locationType: "city-all-by-state-id"
            },
            success: function(response) {
                var optionsCities = "<option value=''>Select City</option>";
                        for(var i=0; i<response.length; i++) {
                            optionsCities += "<option value='" + response[i].city_id + "'>";
                            optionsCities += response[i].city_name;
                            optionsCities += "</option>";
                        }
                        $("#clientCity").html(optionsCities);
                        $("#clientCity").val(data.city);
                        if(data.city == 0) {
                            $("#clientCity").val("");
                        }
            }
        });
    }
    /**".php",
    Backend call to save data */
    function updateClient(clientId) {
        //check
        if(validateUpdateClient()) {
            $("#myModal").modal('toggle');
            $.ajax({
                type: "post",
                url: '<?php echo BASEURL ?>actions/bde/performupdateclientcontact.php',
                data: {
                    clientId: $("#clientId").val(),
                    clientFirstName: $("#clientFirstName").val(),
                    clientLastName: $("#clientLastName").val(),
                    clientEmail: $("#clientEmail").val(),
                    clientEmail2: $("#clientEmail2").val(),
                    clientEmail3: $("#clientEmail3").val(),
                    clientPhone1: $("#clientPhone1").val(),
                    clientPhone2: $("#clientPhone2").val(),
                    clientCategory: $("#clientCategory").val(),
                    clientDesignation: $("#clientDesignation").val(),
                    clientAddress: $("#clientAddress").val(),
                    clientCountry: $("#clientCountry").val(),
                    clientState: $("#clientState").val(),
                    clientCity: $("#clientCity").val(),
                    clientLinkedInId: $("#clientLinkedInId").val(),
                    clientFacebookId: $("#clientFacebookId").val(),
                    clientTwitterId: $("#clientTwitterId").val(),
                    clientCompanyId: $("#clientCompanyId").val()
                    //clientDateTime: $("#clientDateTime").val()
                
                },
                success: function(response) {
                    window.location.reload();
                }
            });
        }
        
    }

    </script>
    <style>
           .input-error{
               color:red;
               color:red;
           }
           
           td{
               text-align:left !important;
           }
    </style>
</head>
<body>
    <?php include 'navbar.php';?>
    <div class="content-view">
        <div class="container-fluid">
        
            <!-- BDE Access Only -->
            <?php if ($_SESSION['role'] == "BDE") : ?>
                <div id="bde-container">
                    <h2 class="text-center"> Contacts List of "<?php echo $client_company_name; ?>"</h2>
                         <!--here the contact list will start showing-->
                       <a href="bde_companyclientlist.php"><button class="btn btn-primary" type="button"><span class="glyphicon glyphicon-chevron-left"></span>Go Back </button></a>
                       <br><br>
                       <?php
                            if(isset($_SESSION["serverMsg"])){
                             ?>
                               <p style="color:green;" font-size:20px; class="text-center" ><?php echo $_SESSION["serverMsg"]; ?></p> 
                               <?php
                                unset($_SESSION["serverMsg"]);
                            }
                            ?>
                         <div id="bde-list" class="col-sm-12">        
                            <div style="overflow-x:auto;">
                                <table class="table table-bordered text-center">
                                    <thead class="sta-app-horizontal-table-thead">
                                        <tr style="background-color: #c9e1c1;">
                                            <th>Sl No. </th>
                                            <th>First Name </th>
                                            <th>Last Name </th>
                                            <th>Email</th>
                                            <th>Phone no. 1</th>
                                            <th>Phone no. 2</th>
                                            <th>Category</th>
                                            <th>Designation</th>
                                            <th>Address </th>
                                            <th>Country</th>
                                            <th>State </th>
                                            <th>City </th>
                                            <th>LinkedIn Id </th>
                                            <th>Facebook Id </th>
                                            <th>Twitter Id </th>
                                            <th>Edit </th> 
                                        </tr>  
                                    </thead>
                                    <tbody  id="bde-list-table"></tbody>
                                </table> 
                            </div>     
                         </div>    
                </div>
            <?php endif; ?>
        </div> 
    </div>
    <?php include 'footer.php';?>
</body>
</html>

<!--MODAL TO EDIT THE CLIENT CONTACTS -->
<p  data-toggle="modal" data-target="#myModal"></p>

<div id="myModal" class="modal fade"  class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header  text-center" style="background-color: #55bcc9; color:#fff;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Client Details</h4>
      </div>
      <div class="modal-body" style="background-color: #e7efdd;">
           
      <!-- modal body starts here -->
      <!-- input fields starts here -->
                        <input type="hidden" name="clientId" id="clientId">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label>First Name: </label>
                                                </div>
                                                <div class="col-sm-8">
                                                <input id="clientFirstName" name="clientFirstName" type="text" class="form-control" placeholder="Enter Your First Name" onfocusout="validateClientFirstName()">
                                                <i id="clientFirstNameError" class="input-error"></i>            
                                                </div>
                                            </div>
                                        </div><!-- row end -->

                                        <div class="form-group">
                                            <div class="row">
                                                    <div class="col-sm-4">
                                                        <label>Last Name: </label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                    <input id="clientLastName" name="clientLastName" type="text" class="form-control" placeholder="Enter Your Last Name" onfocusout="validateClientLastName()">
                                                    <i id="clientLastNameError" class="input-error"></i>                   
                                                    </div>
                                                </div>
                                        </div><!-- row end -->

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label>Email id: </label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input id="clientEmail" name="clientEmail" type="text" class="form-control" placeholder="Enter Your email-id" onfocusout="validateClientEmail()" > 
                                                    <i id="clientEmailError" class="input-error"></i>  
                                                </div>
                                            </div>
                                        </div><!-- row end -->
                                        
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label>Email id 2: </label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input id="clientEmail2" name="clientEmail2" type="text" class="form-control" placeholder="Enter Your email-id" onfocusout="validateClientEmail2()" > 
                                                    <i id="clientEmailError2" class="input-error"></i>  
                                                </div>
                                            </div>
                                        </div><!-- row end -->
                                        
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label>Email id 3: </label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input id="clientEmail3" name="clientEmail3" type="text" class="form-control" placeholder="Enter Your email-id" onfocusout="validateClientEmail3()" > 
                                                    <i id="clientEmailError3" class="input-error"></i>  
                                                </div>
                                            </div>
                                        </div><!-- row end -->

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>Phone no. 1:</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <input id="clientPhone1" name="clientPhone1" type="text" class="form-control" placeholder="Please Enter Your Phone no.1" onfocusout="validateClientPhone1()">
                                                <i id="clientPhone1Error" class="input-error"></i>  
                                            </div>
                                        </div>
                                    </div><!-- row end -->
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>Phone no. 2: </label>
                                            </div>
                                            <div class="col-sm-8">
                                                <input id="clientPhone2" name="clientPhone2" type="text" class="form-control" placeholder="Please Enter Your Phone no.2" onfocusout="validateClientPhone2()">
                                                <i id="clientPhone2Error" class="input-error"></i>  
                                            </div>
                                        </div>
                                    </div>
                                    
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label>Category: </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <input  id="clientCategory" name="clientCategory"   class="form-control" onfocusout ="validateClientCategoty()">
                                            <i id="clientCategoryError" class="input-error"></i>  
                                        </div>
                                    </div>
                                </div><!-- row end -->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label>Designation: </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <input  id="clientDesignation" name="clientDesignation"  class="form-control" onfocusout="validateClientDesignation()">
                                            <i id="clientDesignationError" class="input-error"></i> 
                                    
                                        </div>
                                    </div>
                                </div><!-- row end -->
                                <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label>Address: </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" placeholder="Enter your address here" name="clientAddress" id="clientAddress" onfocusout ="validateClientAddress()"></textarea>
                                        <i class="input-error" id="clientAddressError"></i>
                                    </div>
                                </div>
                            </div><!-- row end -->

                             <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label>Country: </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <select id="clientCountry" name="clientCountry"  class="form-control" onfocusout="validateClientCountry()">
                                        <option value="">Select Country</option>
                                        </select>
                                        <i  class="input-error"id="clientCountryError"></i>
                                    </div>
                                </div>
                            </div><!-- row end -->
                            <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label>State: </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <select id="clientState" name="clientState"  class="form-control" onfocusout="validateClientState()">
                                                <option value="">Select States</option>
                                            </select>
                                            <i  class="input-error" id="clientStateError"></i>
                                        </div>
                                    </div>
                                </div><!-- row end -->
                           
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label>City: </label>
                                        </div>
                                        <div class="col-sm-8">
                                        <select id="clientCity" name="clientCity"  class="form-control" onfocusout="validateClientCity()">
                                                <option value="">Select City</option>
                                            </select>
                                            <i  class="input-error" id="clientCityError"></i>
                                        </div>
                                    </div>
                                </div><!-- row end -->
                                
                           
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>LinkedIn Id: </label>
                                </div>
                                <div class="col-sm-8">
                                    <input  id="clientLinkedInId"  name="clientLinkedInId" type="text"  class="form-control" placeholder="Please Provide Linkedin id">
                                      
                                </div>
                            </div>
                        </div><!-- row end -->            

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Facebook Id: </label>
                                </div>
                                <div class="col-sm-8">
                                    <input id="clientFacebookId" name="clientFacebookId" type="text" class="form-control" placeholder="Please Provide facebook id">
                                   
                                </div>
                            </div>
                        </div><!-- row end -->    

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Twitter Id: </label>
                                </div>
                                    <div class="col-sm-8">
                                        <input id="clientTwitterId" name="clientTwitterId" type="text"  class="form-control" placeholder="Please Provide twitter id">
                   
                                    </div>
                            </div>
                        </div><!-- row end -->

                    <div class="form-group">
                        <div class="row text-center">
                            <input type="button" value="Update"  class="btn btn-success"  style="border:none !important" onclick="updateClient()">
                            
                        </div>
                    </div><!-- row end -->
      <!-- input fields ends here -->
      <!-- modal body ends here -->
          
      </div>
      
    </div>

  </div>
</div>