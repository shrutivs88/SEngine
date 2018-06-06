<?php
session_start();
if($_SESSION['role'] !== "BDM") {
    header("Location: ../../error/noaccess.php");
}
include_once($_SERVER['DOCUMENT_ROOT'].'/'. explode("/", $_SERVER['PHP_SELF'])[1] .'/config.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/'. explode("/", $_SERVER['PHP_SELF'])[1] .'/utility/DatabaseManager.php');
//include '../../utility/DatabaseManager.php';
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
    
    $(document).ready(function(){
            companyList();
            $("#ajaxButton").click(function() {
                companyList();
            });  
        });  //end of the Scriptfunction         
        
        var offset = 0;
        var limit = 4;
        var isUpdateOffsetPristine = true;
        var count =0;
            
        //displaying client Company List when edit btn is used 
        function companyList()
        {
            count++;
            $("#ajaxButton").prop("disabled", "true");
            $.ajax({
                    type: "Post",
                    url: "<?php echo BASEURL;?>actions/bdm/performfetchcompanylist.php",
                    data: { 
                        limitVal: limit,
                        offsetVal: offset
                            },
                    success: function(response){
                        var companyBdeListBuilder = "";
                        if(response.length == 0 && isUpdateOffsetPristine == true)
                                    {
                                        $("#bdm-container").html("<h4 class='text-center'>No Companies Are Available!</h4>");
                                        $("#ajaxButton").hide();
                                        return;
                                    } else if(response.length == 0 && isUpdateOffsetPristine == false) {
                                        $("#bdm-container").append("<h4 class='text-center'>No More Companies Are Available!</h4>");
                                        $("#ajaxButton").hide();
                                        return;
                                    }
                        if(response.length == 0) 
                                    {
                                        $("#company_fetch").html("<h4 class='text-center'>No Companies Are Available!</h4>");
                                        return;
                                    }   
                    for(var i=0; i<response.length; i++) { 
                        var bdeListBuilder = "";
                                    bdeListBuilder += "<tr>";
                                    bdeListBuilder += "<td>"+ parseInt(count+i) +"</td>";
                                    bdeListBuilder += "<td>" + response[i].name + "</td>";
                                    bdeListBuilder += "<td>" + response[i].website + "</td>";
                                    bdeListBuilder += "<td>" + response[i].email + "</td>";
                                    bdeListBuilder += "<td>" + response[i].phone + "</td>";
                                   // bdeListBuilder += "<td>" + response[i].linkedin + "</td>";
                                    bdeListBuilder += "<td>" + response[i].address + "</td>";
                                    bdeListBuilder += "<td><button class='btn btn-primary action-btn' title='Contact Details' onclick='showContacts(" + response[i].id + ")'><span class='glyphicon glyphicon-pawn'></span></button></td>'";
                                    bdeListBuilder += "</tr>";
                                    $("#company_fetch").append(bdeListBuilder);
                                    }
                                   
                                    offset += limit;
                                    isUpdateOffsetPristine = false;  
                                    count = count+limit-1;
                                    $("#ajaxButton").prop("disabled", "");  

                            }//end of the response function
                    });
        }//end of the function  
        function showContacts(client_company_id){
        window.location = 'showContactsDetails.php?companyId=' + client_company_id;
    }   
        //Company List Ends
    </script>
    
    <style>
        
     
    </style>
    
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
                    <h3 class="text-center" style="margin-top: 60px;"> Client Company List</h3>
                    <div id="bdm-container" style="overflow-x:auto;">
                    <table class="table table-striped table-bordered"> 
                        <thead id="head" width="100%">
                        <tr style="background-color: #c9e1c1;">              
                        <th> Sl No. </th>    
                        <th>Company Name</th>
                        <th>Company Website</th>
                        <th>Company Email</th>
                        <th>Company Phone</th>
                       <!-- <th>Company LinkedIn</th>-->
                        <th>Company Address</th>
                        <th> Contacts </th>    
                        </tr>
                        </thead> 
                        
                        <tbody id="company_fetch">
                        </tbody>  
                        
                    </table>
                </div>
               
                <div class="text-center" style="margin-top: 10px;">
                    <input type="button" class="btn btn-load" value="Click Here" id="ajaxButton"/>
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
    <div id="myModalCompany" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
             <div class="modal-header bg-primary">
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title text-center" >Company Details</h4>
             </div>
             <div class="modal-body">
                 <div class="form-group">
                     <div class="row">
                         <div class="col-sm-4">Company Name</div>
                         <div class="col-sm-8"><input type="text" id="companyName" class="form-control" readonly></div>
                     </div>
                 </div>
      
                 <div class="form-group">
                    <div class="row">
                         <div class="col-sm-4">Company Email</div>
                         <div class="col-sm-8"><input type="text" id="companyEmail" class="form-control" readonly></div>
                    </div>
                 </div>
      
                 <div class="form-group">
                    <div class="row">
                         <div class="col-sm-4">Company Phone</div>
                         <div class="col-sm-8"><input type="text" id="companyPhone" class="form-control" readonly></div>
                    </div>
                 </div>
      
                 <div class="form-group">
                     <div class="row">
                        <div class="col-sm-4">Company Website</div>
                        <div class="col-sm-8"><input type="text" id="companyWebsite" class="form-control" readonly></div>
                     </div>
                 </div>
      
                 <div class="form-group">
                     <div class="row">
                         <div class="col-sm-4">Company Address</div>
                          <div class="col-sm-8"><input type="text" id="companyAddress" class="form-control" readonly></div>
                      </div>
                 </div>
      
                 <div class="form-group">
                     <div class="row">
                        <div class="col-sm-4">Company Linkdin</div>
                        <div class="col-sm-8"><input type="text" id="companyLinkedIn" class="form-control" readonly></div>
                     </div>
                 </div>
             </div>
             <div class="modal-footer" id="footer">
                 <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
             </div>
        </div>
        </div>
    </div> 
</body>
</html>