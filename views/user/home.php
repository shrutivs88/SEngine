<?php
session_start();
if(!isset($_SESSION["email"])) {
    header("Location:../login.php");
}

include_once($_SERVER['DOCUMENT_ROOT'].'/'. explode("/", $_SERVER['PHP_SELF'])[1] .'/config.php');
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
            client_bde_count_fetch();
            client_fetch();
            
        });
     
         function client_bde_count_fetch(){
            $.ajax({
                url: '<?php echo BASEURL; ?>actions/bdm/performfetchhomeforbdm.php',
                type: 'post',
                data: {
                    userid : "<?php echo $_SESSION['userId']; ?>"
                },
                success:function(response){
                //console.log(response);
                //return;
                
                   $("#count_client").append(response[0]);
                   $("#count_bde").append(response[1]);
                }
            });
         }
         
         function client_fetch(){
             $.ajax({
                   url:'<?php echo BASEURL; ?>actions/bde/performfetchhomeforclientandcompany.php',
                   type:'post',
                   data:{
                     userid : "<?php echo $_SESSION['userId']; ?>"
                   },
                   success:function(response){
                           // console.log(response) ;
                           $("#counts_clients").append(response[0]);
                           $("#count_company").append(response[1]);
                             
                       
                   }
             });
         }
          
        
    </script>
    <style>
        #bde_count{
            min-height:220px;
            background-color: rgba(253,185,75,0.8);
            border: 3px solid rgba(253,185,75,0.8);
            padding: 20px;
            border-radius:5px;
            
        }
        #bde_count h3,#client_count h3{
            color:#fff !important;
            text-shadow: none;
            margin: 0px;
            padding: 0px;
        }
        #bde_count p,#client_count p{
            color:#fff !important;
            font-size:70px;
            padding: 0px;
        }
        #bde_count p{
            margin-top: 35px;
        }
       
        #bde{
            text-decoration:none;
        }
        #client{
            text-decoration:none;
        }
        
        #client_count{
            min-height:220px;
            background-color: rgba(238,87,68,0.8);
            border: 3px solid rgba(238,87,68,0.8);
            padding: 20px;
            border-radius:5px;
        }
        #company_count{
            min-height:220px;
            background-color: rgba(253,185,75,0.8);
            border: 3px solid rgba(253,185,75,0.8);
            padding: 20px;
            border-radius:5px;
        }
        
        #company_count p{
            margin-top: 60px;
        }
        
        #clients_counts{
            min-height:220px;
            background-color: rgba(238,87,68,0.8);
            border: 3px solid rgba(238,87,68,0.8);
            padding: 20px;
            border-radius:5px;
        }
       
        #company_count h3, #clients_counts h3{
            color:#fff !important;
            text-shadow: none;
            margin: 0px;
            padding: 0px;
        }
        #company_count p,#clients_counts p{
            color:#fff !important;
            font-size:70px;
            padding: 0px;
        }
        #clients_counts p{
            margin-top: 33px !important;
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
                    <div class="server-message" id="server-message">
                        <?php
                            if(isset($_SESSION["serverMsg"])) {
                                echo "<p class='text-center'>" . $_SESSION["serverMsg"] . "</p>";
                                unset($_SESSION['serverMsg']);
                            }
                        ?>
                    </div>
                    <!-- Admin Access Only -->
                    <?php if ($_SESSION['role'] == "ADMIN") : ?>
                        <div id="admin-container">
                        <div class="panel panel-default">
                            <div class="panel-heading">Tracking</div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <a class="home-item-wrapper-link" href="admin/bdmlist.php">
                                            <div class="home-item home-boxone">
                                                <div class="home-item-name">
                                                    <h3>BDM Count</h3>
                                                </div>
                                                <div class="home-item-value">
                                                    <h1 id="bdm-count"></h1>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-sm-3">
                                        <a class="home-item-wrapper-link" href="admin/bdelist.php">
                                            <div class="home-item home-boxtwo">
                                                <div class="home-item-name">
                                                    <h3>BDE Count</h3>
                                                </div>
                                                <div class="home-item-value">
                                                    <h1 id="bde-count"></h1>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-sm-3">
                                        <a class="home-item-wrapper-link" href="admin/clientcompanylist.php">
                                            <div class="home-item home-boxthree">
                                                <div class="home-item-name">
                                                    <h3>Client Companies Count</h3>
                                                </div>
                                                <div class="home-item-value">
                                                    <h1 id="client-companies-count"></h1>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-sm-3">
                                        <a class="home-item-wrapper-link" href="admin/clientcontactlist.php">
                                            <div class="home-item home-boxfour">
                                                <div class="home-item-name">
                                                    <h3>Client Contacts Count</h3>
                                                </div>
                                                <div class="home-item-value">
                                                    <h1 id="client-contacts-count"></h1>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    <?php endif; ?>
                    <!-- BDM Access Only -->
                    <?php if ($_SESSION['role'] == "BDM") : ?>
                        <div id="bdm-container">
                            <h2 class="text-center"> TRACKING </h2>
                            <div class="row">
                                <div class="col-sm-3"></div>
                                
                                    <div class="col-sm-3">
                                     <a class="home-item-wrapper-link" href="bdm/bdelist.php">
                                      <div class="home-item home-boxfour" id="bde_count">
                                                <div class="home-item-name">
                                                    <h3>BDE Count</h3>
                                                </div>
                                                <div class="home-item-value">
                                                    <h1 id="count_bde"></h1>
                                                </div>
                                      </div>
                                       
                                       </a>
                                    </div>
                                 
                                 
                                
                                    <div class="col-sm-3" >
                                     <a  class="home-item-wrapper-link" href="bdm/clientlist.php">
                                        <div class="home-item home-boxfour" id="clients_counts">
                                                <div class="home-item-name">
                                                    <h3>Client Contacts Count</h3>
                                                </div>
                                                <div class="home-item-value">
                                                    <h1 id="count_client"></h1>
                                                </div>
                                      </div>
                                      
                                     </a>
                                    </div>
                                 
                                 <div class="col-sm-3"></div>
                            </div>
                        </div>
                     
                    <?php endif; ?>
                    <!-- BDE Access Only -->
                    <?php if ($_SESSION['role'] == "BDE") : ?>
                        <div id="bde-container" class="role-container">
                           <!-- <h2 class="text-center">Welcome BDE</h2>    -->
                                   <h2 class="text-center"> TRACKING </h2> 
                                    <div class="row">
                                          <div class="col-sm-2"></div>
                                 <a  href="bde/bde_companyclientlist.php">
                                    <div class="col-sm-3" id="company_count">
                                       <div>
                                            <h3 class="text-center">Company List Count</h3>
                                            <p class="text-center" id="count_company"> </p>
                                       </div>  
                                    </div>
                                 </a>
                                 <div class="col-sm-1"></div>
                                 <a  href="bde/bde_clientlist.php">
                                    <div class="col-sm-3" id="clients_counts">
                                        <div>
                                            <h3 class="text-center">Client Contacts Count</h3>
                                            <p class="text-center" id="counts_clients"> </p>
                                        </div>
                                    </div>
                                 </a>
                                 <div class="col-sm-1"></div>
                            </div>
                                    </div>   
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div> 
    </div>
    <?php include 'footer.php';?>
    <script>
        $(document).ready(function() {
            loadHomePageData();
        });

        function loadHomePageData() {
            $.ajax({
                type: "GET",
                url: "<?php echo BASEURL ?>actions/admin/performfetchhomedata.php",
                success: function(response) {
                    $("#bdm-count").html(response.bdmsCount);
                    $("#bde-count").html(response.bdesCount);
                    $("#client-companies-count").html(response.clientCompaniesCount);
                    $("#client-contacts-count").html(response.clientContactsCount);
                    //console.log(response);
                }
            });
        }
    </script>
</body>
</html>