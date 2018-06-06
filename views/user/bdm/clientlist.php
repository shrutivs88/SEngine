<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'].'/'. explode("/", $_SERVER['PHP_SELF'])[1] .'/config.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/'. explode("/", $_SERVER['PHP_SELF'])[1] .'/utility/DatabaseManager.php');
$data = new DatabaseManager();
$conn = $data->getConnection();
if(!isset($_SESSION["email"])) {
    header("Location:login.php");
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
   
    <script>
    history.pushState(null, null, location.href);
    window.onpopstate = function () {
        history.go(1);
    };
    //Client List ajax starts
    
         $(document).ready(function() {
            client_fetch_List();
             $("#ajaxButton").click(function() {
                client_fetch_List();
            });
            
        });
        var offset = 0;
        var limit = 4;
        var isUpdateOffsetPristine = true;
        var count =0;
         function client_fetch_List(){
             count++;
            $("#ajaxButton").prop("disabled", "true");
            $.ajax({
                url: '<?php echo BASEURL; ?>actions/bdm/performfetchclientlistforbdm.php',
                type: 'post',
                data: {
                    userid : "<?php echo $_SESSION['userId']; ?>",
                   // limitVal: limit,
                    offsetVal: offset
                },
                success:function(response){
                //console.log(response);
                //return;
                clientListBuilder = ""; 
                if(response.length == 0 && isUpdateOffsetPristine == true)
                        {
                            $("#bdm-container").html("<h4 class='text-center'>No Client Contacts Are Available!</h4>");
                            $("#ajaxButton").hide();
                            return;
                        } else if(response.length == 0 && isUpdateOffsetPristine == false) {
                            $("#bdm-container").append("<h4 class='text-center'>No More Client Contacts Are Available!</h4>");
                            $("#ajaxButton").hide();
                            return;
                        }
                if(response.length == 0) 
                            {
                                $("#client_fetch").html("<h4 class='text-center'>No Companies Are Available!</h4>");
                                return;
                            } 
                    for(var i=0; i<response.length; i++) 
                    {
                        clientListBuilder += "<tr>";
                         clientListBuilder +=  "<td>"+ parseInt(count+i) +"</td>";
                        clientListBuilder += "<td>" + response[i].firstName + "</td>";
                        clientListBuilder += "<td>" + response[i].lastName + "</td>";
                        clientListBuilder += "<td>" + response[i].email + "</td>";
                        clientListBuilder += "<td>" + response[i].phone1 +" <br> "+ response[i].phone2 + "</td>";
                        clientListBuilder += "<td>" + response[i].designation + "</td>";
                        //clientListBuilder += "<td>" + response[i].client_contact_mobile + "</td>";
                        //clientListBuilder += "<td>" + response[i].city_id + "</td>";
                        //clientListBuilder += "<td>" + response[i].state_id + "</td>";
                        //clientListBuilder += "<td>" + response[i].country_id + "</td>";
                        //clientListBuilder += "<td>" + response[i].client_contact_address + "</td>";
                        //clientListBuilder += "<td>" + response[i].client_contact_linkedin + "</td>";
                        //clientListBuilder += "<td>" + response[i].client_contact_facebook + "</td>";
                        //clientListBuilder += "<td>" + response[i].client_contact_twitter + "</td>";
                        //clientListBuilder += "<td>" + response[i].client_contact_added + "</td>";
                        clientListBuilder += "<td align='center'><button type='button' id='link' class='btn btn-primary btn-sm action-btn' title='Client Details''  onclick='showClientContact(" + response[i].id + ")' ><span class='glyphicon glyphicon-user'></span></button></td>";                              
                       // clientListBuilder += "<td align='center'><button type='button' class='btn btn-success btn-sm action-btn' title='Company List''  onclick='showClientCompany(" + response[i].client_company_id + ")' ><span class='glyphicon glyphicon-home'></span></button></td>";
                        
                        if((response[i].status=="Send Proposal")||(response[i].status=="New")) 
                        {
                            clientListBuilder += "<td><a href='email_send.php?id=" + response[i].id + "'><p style='color:green;'> Send Proposal </p></a></td>";                          
                        }
                        else
                        {
                            clientListBuilder += "<td><p style='color:red;'> Mail Sent </p></td>"; 
                        } 
                
                        clientListBuilder += "</tr>";
                        
                    }
                    
                     offset += limit;
                     isUpdateOffsetPristine = false;  
                     count = count+limit-1;
                     $("#client_fetch").append(clientListBuilder);
                     $("#ajaxButton").prop("disabled", ""); 
                }
            });
         }
         //Client List Ajax Ends here
       
        //Company List fetching using Ajax Start
    var CompanyBuilder = "";
          var ajaxCount = 0;
        function showClientCompany(companyId) 
        { 
            ajaxCount++;
             $('#companyBtn').attr("disabled", true);
             //$("#myModalClient").modal('toggle');
             CompanyBuilder="";
             
                 $.ajax({
                type: "post",
                url:"<?php echo BASEURL; ?>actions/bdm/performfetchcompany.php",
                data: {
                    companyId:companyId  
                },
                success: function(response)
                {
                    //console.log(response);
                    //return; 
              
                    CompanyBuilder +="<div id='companyDetails'><br><table class='table table-bordered' ><caption style='color:green';> Company Details </caption>";
                    CompanyBuilder +="<tr><td> <label> Company Name </label> </td><td>"+ response.name+" </td></tr>";
                    CompanyBuilder +="<tr><td> <label> Company Email </label> </td><td>" +response.email+" </td></tr>";
                    CompanyBuilder +="<tr><td> <label> Company Phone </label> </td><td>" +response.phone+" </td></tr>";
                    CompanyBuilder +="<tr><td> <label> Company Website </label> </td><td>"+response.website +"</td></tr>";
                    CompanyBuilder +="<tr><td> <label> Company Address </label> </td><td>"+response.address+" </td></tr>";
                    CompanyBuilder +="<tr><td> <label> Company LinkedIn </label> </td><td>"+response.linkedin+" </td></tr></table><div>";
                    $("#showCompany").append(CompanyBuilder);
                    $("#companyshowBtn").remove();
                }
                 
             }); 
             
            
             
        }
        //Company List Ends
    

    function showClientContact(clientId) 
        { 
            $("#companyDetails").remove();
             $("#myModalClient").modal('toggle');
             $.ajax({
                type: "post",
                url:"<?php echo BASEURL; ?>actions/bdm/performfetchclientcontact.php",
                data: {
                    clientId:clientId  
                },
                success: function(clientresult)
                {
              
                    $("#clientfname").html(clientresult.firstName);
                    $("#clientlname").html(clientresult.lastName);
                    $("#clientEmail").html(clientresult.email);
                    $("#clientCategory").html(clientresult.category);
                    $("#clientDesignation").html(clientresult.designation);
                    $("#clientMobile").html(clientresult.phone1 +" , "+ clientresult.phone2);
                    $("#clientCity").html(clientresult.city);
                    $("#clientState").html(clientresult.state);
                    $("#clientCountry").html(clientresult.country);
                    $("#clientAddress").html(clientresult.address);
                    $("#clientLinkedInId").html(clientresult.linkedIn);
                    $("#clientFacebookId").html(clientresult.facebook);
                    $("#clientTwitterId").html(clientresult.twitter);
                    $("#clientAdded").html(clientresult.added);
                    $("#clientCompanyId").html(clientresult.company);
                    $("#clientStatus").html(clientresult.status);
                    $("#showCompany").html("<td align='center' id='companyshowBtn'><button type='button' class='btn btn-primary btn-sm action-btn' id='companyBtn' title='Company Details' onclick='showClientCompany(" + clientresult.company + ")' >Company Details</button></td>");
                    //$('#companyBtn').attr("disabled", false);
                    
                   
                }
             });
        }
        
        //Company List Ends
    </script>
    
  
</head>
<body>
    <?php include 'navbar.php';?>
    <div class="content-view">
        <div class="container-fluid">
            <!-- Admin Access Only -->
           
            <!-- BDM Access Only -->
            <?php if ($_SESSION['role'] == "BDM") : ?>
             <?php
                  if(isset($_SESSION['successmsg']))
                  {
                       $successmsg =  $_SESSION['successmsg'] ;
                       echo "<div class='alert alert-success text-center'>" .$successmsg."</div>";
                       unset( $_SESSION['successmsg']);
                  
                  }
                 ?>
             <?php
                  if(isset($_SESSION['userId']))
                  {
                    $user_Id= $_SESSION['userId'];
                  }
             ?>
           
             <!-- Display Client List -->
             <?php  
             $bdmsql="select user_name from users where user_id='$user_Id'";
                  $bdmresult=mysqli_query($conn,$bdmsql);
                  $bdmrow=mysqli_fetch_object($bdmresult);
                  $bdmname=$bdmrow->user_name;
             ?>
             
             
             <div class="row">
                <div class="col-sm-3">
                    <?php include("sidemenu.php"); ?>
                </div>
                 <div class="col-sm-9">
                 <h3 class="text-center" style="margin-top: 60px;"> Client Contact List of BDM : "<?php echo $bdmname; ?>"  </h3>
                     <div id="bdm-container" style="overflow-x:auto;">
                    <table class="table table-striped table-bordered"> 
                        <thead id="head" width="100%">
                        <tr style="background-color: #c9e1c1;">  
                        <th> Sl No. </th>            
                           <th> First Name </th>
                            <th> Last Name </th>
                            <th> Email Id </th>
                            <th> Mobile </th>
                            <th> Designation </th>
                            <th> Action </th>
                            <th> Status </th>    
                        </tr>
                        </thead> 
                        
                        <tbody id="client_fetch">
                        </tbody>  
                        
                    </table>
                   <div class="text-center" style="margin-top: 10px;">
                    <input type="button" class="btn btn-load" value="Click Here" id="ajaxButton"/>
                    </div>
                </div>
                 
                </div>
             </div>
               
               
            <?php endif; ?>
            <!-- BDE Access Only -->
            <?php if ($_SESSION['role'] == "BDE") : ?>
                <div id="bde-container">
                    <h2 class="text-center">BDE</h2>
                </div>
            <?php endif; ?>
        </div> 
    </div>
    <?php include 'footer.php';?>
    
    <!-- Modal for Company Details-->
     <!--<div id="myModalCompany" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">-->

        <!-- Modal content-->
       <!-- <div class="modal-content">
             <div class="modal-header bg-primary">
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title text-center">Company Details</h4>
             </div>
             <div class="modal-body">
             <table class="table table-bordered"> 
                  <tr>
                    <td> <label> Company Name </label> </td>
                    <td id="companyName"> </td>  
                  </tr>
                  <tr>
                    <td> <label> Company Email </label> </td>
                    <td id="companyEmail"> </td>  
                  </tr>
                  <tr>
                    <td> <label> Company Phone </label> </td>
                    <td id="companyPhone"> </td>  
                  </tr>
                  <tr>
                    <td> <label> Company Website </label> </td>
                    <td id="companyWebsite"> </td>  
                  </tr>
                  <tr>
                    <td> <label> Company Address </label> </td>
                    <td id="companyAddress"> </td>  
                  </tr>
                  <tr>
                    <td> <label> Company LinkedIn </label> </td>
                    <td id="companyLinkedIn"> </td>  
                  </tr>
                  
                </table>
                
             </div>
             <div class="modal-footer" id="footer">
                 <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
             </div>
        </div>
        </div>
    </div> -->

    <!-- Modal for Client Details-->
    <div id="myModalClient" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
             <div class="modal-header" style="background-color: #55bcc9; color:#fff;">
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title text-center">Client Details</h4>
             </div>
             <div class="modal-body" style="background-color: #e7efdd;">
            
             <table class="table table-bordered"> 
                  <tr>
                    <td> <label> Client First Name </label> </td>
                    <td id="clientfname"> </td>  
                  </tr>
                  <tr>
                    <td> <label> Client Last Name </label> </td>
                    <td id="clientlname"> </td>  
                  </tr>
                  <tr>
                    <td> <label> Client Email </label> </td>
                    <td id="clientEmail"> </td>  
                  </tr>
                  <tr>
                    <td> <label> Category </label> </td>
                    <td id="clientCategory"> </td>  
                  </tr>
                  <tr>
                    <td> <label> Designation </label> </td>
                    <td id="clientDesignation"> </td>  
                  </tr>
                  <tr>
                    <td> <label> Mobile </label> </td>
                    <td id="clientMobile"> </td>  
                  </tr>
                  <tr>
                    <td> <label> City </label> </td>
                    <td id="clientCity"> </td>  
                  </tr>
                  <tr>
                    <td> <label> State </label> </td>
                    <td id="clientState"> </td>  
                  </tr>
                  <tr>
                    <td> <label> Country </label> </td>
                    <td id="clientCountry"> </td>  
                  </tr>
                  <tr>
                    <td> <label> Address </label> </td>
                    <td id="clientAddress"> </td>  
                  </tr>
                  <tr>
                    <td> <label> LinkedIn Id </label> </td>
                    <td id="clientLinkedInId"> </td>  
                  </tr>
                  <tr>
                    <td> <label> Facebook Id </label> </td>
                    <td id="clientFacebookId"> </td>  
                  </tr>
                  <tr>
                    <td> <label> Twitter Id </label> </td>
                    <td id="clientTwitterId"> </td>  
                  </tr>
                  <tr>
                    <td> <label> Client Added </label> </td>
                    <td id="clientAdded"> </td>  
                  </tr>
                  <tr>
                    <td> <label> Company Id </label> </td>
                    <td id="clientCompanyId"> </td>  
                  </tr>
                  <tr>
                    <td> <label> Status </label> </td>
                    <td id="clientStatus"> </td>  
                  </tr>

             </table>
              <div id="showCompany">
                    
                  </div>
          
              </div>  
             <div class="modal-footer" id="footer" style="background-color: #93b0ab;text-align:center;">
                 <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
             </div>
        </div>
        </div>
    </div> 
</body>
</html>