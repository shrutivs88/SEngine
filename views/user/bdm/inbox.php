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
         
         $(document).ready(function() {
            inbox_fetch_list();
         });
     
         function inbox_fetch_list(){
             //alert();
            $.ajax({
                url: '<?php echo BASEURL; ?>actions/bdm/performfetchinboxlistofmail.php',  
                type: 'post',
                data: {
                    userid : "<?php echo $_SESSION['userId']; ?>"
                },
                success:function(response){
                //console.log(response);
                //return;
                    $("#inbox").append(response); 
                }
            });
         }
</script>
   <style>
   #inbox tr:nth-child(odd){
       background-color:#f4decb;
       
   }
   #inbox tr:nth-child(even){
        background-color:#f8eee7;
   }
   </style>
</head>
<body>
   
    <?php include 'navbar.php';?>
    <div class="content-view">
        <div class="container-fluid">
            <!-- Admin Access Only -->
            <?php if ($_SESSION['role'] == "ADMIN") : ?>
                <div id="admin-container">
                    <h2 class="text-center" >Admin</h2>
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
             <div class="row">
                <div class="col-sm-3">
                    <?php include("sidemenu.php"); ?>
                </div>
                <div class="col-sm-9">
                     <h2 class="text-center" style="margin-top: 60px;margin-bottom: 20px;">  Inbox <span class="glyphicon glyphicon-envelope"></span> </h2>
                     <div id="bdm-container" style="overflow-y:auto;">
                    <table class="table table-bordered">
                        <thead id="head">
                            <tr style="background-color: #c9e1c1;">
                                <th>Date</th>
                                <th>From</th>
                                <th>Message</th>
                                <th>Attachment</th>
                            </tr>
                        </thead>
                        <tbody id="inbox">
                    </tbody>
                    </table>
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
    
    <?php include 'footer.php';?>

</body>
</html>