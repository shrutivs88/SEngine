<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'].'/'. explode("/", $_SERVER['PHP_SELF'])[1] .'/config.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/'. explode("/", $_SERVER['PHP_SELF'])[1] .'/utility/DatabaseManager.php');
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
    //Client List ajax starts
    
        $(document).ready(function() {
            bde_fetch_List();
            $("#ajaxButton").click(function() {
                bde_fetch_List();
            });
        });
         var offset = 0;
        var limit = 4;
        var isUpdateOffsetPristine = true;
        var count =0;
         function bde_fetch_List(){
              count++;
            $("#ajaxButton").prop("disabled", "true");
            $.ajax({
                url: '<?php echo BASEURL; ?>actions/bdm/performfetchbdesforbdm.php',
                type: 'post',
                data: {
                    userid : "<?php echo $_SESSION['userId']; ?>",
                    limitVal: limit,
                        offsetVal: offset
                },
                success:function(response){
                //console.log(response);
                //return;
                bdeListBuilder = "";
                 if(response.length == 0 && isUpdateOffsetPristine == true)
                                    {
                                        $("#bdm-container").html("<h4 class='text-center'>No More BDE's' Are Available!</h4>");
                                        $("#ajaxButton").hide();
                                        return;
                                    } else if(response.length == 0 && isUpdateOffsetPristine == false) {
                                        $("#bdm-container").append("<h4 class='text-center'>No More BDE's Are Available!</h4>");
                                        $("#ajaxButton").hide();
                                        return;
                                    }
                        if(response.length == 0) 
                                    {
                                        $("#bde_fetch").html("<h4 class='text-center'>No More BDE's' Are Available!</h4>");
                                        return;
                                    } 
                    for(var i=0; i<response.length; i++) 
                    {
                        bdeListBuilder += "<tr>";
                        bdeListBuilder +=  "<td>"+ parseInt(count+i) +"</td>";
                        bdeListBuilder += "<td>" + response[i].name + "</td>";
                        bdeListBuilder += "<td>" + response[i].email + "</td>";
                        bdeListBuilder += "<td><a class='btn btn-primary btn-sm action-btn' title='Client Contacts' id='link' href='bdeclientlist.php?bdeid=" + response[i].empId + "'> <span class='glyphicon glyphicon-eye-open'></span> </a></td>";
                        bdeListBuilder += "</tr>";
                    }
                    $("#bde_fetch").append(bdeListBuilder);
                     offset += limit;
                     isUpdateOffsetPristine = false;  
                     count = count+limit-1;
                    
                     $("#ajaxButton").prop("disabled", "");
                }
            });
         }
         //Client List Ajax Ends here
       
        //Company List fetching using Ajax Start
       
        //Company List Ends
    </script>
    
   
    
</head>
<body>
    <?php include 'navbar.php';?>
    <div class="content-view">
        <div class="container-fluid">
            <!-- Admin Access Only -->
            <?php if ($_SESSION['role'] == "ADMIN") : ?>
                <div id="admin-container">
                    <h2 class="text-center">Admin</h2>
                </div>
            <?php endif; ?>
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
             
                     
                     <div class="row">
                        <div class="col-sm-3">
                            <?php include("sidemenu.php"); ?>
                        </div>
                        <div class="col-sm-9">
                        <h3 class="text-center" style="margin-top: 60px;">  BDE List  </h3>
                        <div id="bdm-container">
                        <table class="table table-striped table-bordered"> 
                        <thead id="head" width="100%">
                        <tr style="background-color: #c9e1c1;">  
                             <th> SI No.</th>            
                                    <th> Name </th>
                                    <th> Email Id </th>
                                    <th class="action-btn"> Action </th>   
                             </tr>
                        </thead> 
                        
                        <tbody id="bde_fetch">
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
   
</body>
</html>
