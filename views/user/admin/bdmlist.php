<?php
session_start();
/**
 * Admin Only Allowed
 */
if($_SESSION['role'] !== "ADMIN") {
    header("Location: ../../error/noaccess.php");
}

include_once($_SERVER['DOCUMENT_ROOT'].'/'. explode("/", $_SERVER['PHP_SELF'])[1] .'/config.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/'. explode("/", $_SERVER['PHP_SELF'])[1] .'/services/RoleService.php');

$roleService = new RoleService();
$role = $roleService->getByRoleName("BDM");

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
                    <h2 class="add-bdm text-center">B.D.M List</h2>
                    <div class="server-message" id="server-message">
                        <?php
                            if(isset($_SESSION["serverMsg"])) {
                                echo "<p class='text-center'>" . $_SESSION["serverMsg"] . "</p>";
                                unset($_SESSION['serverMsg']);
                            }
                        ?>
                    </div>
                    <div class="list-search-box">
                        <div class="row">
                            <div class="input-group">
                                <input type="text" id="search-box" name="search-box" class="form-control" placeholder="Search By Name Or Email Address">
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="button" onclick="search()">
                                        <i class="glyphicon glyphicon-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="bdm-div">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr style="background-color: #c9e1c1;">
                                    <th>Full Name</th>
                                    <th>E-Mail Address</th>
                                    <th>Password</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="bdm-list"></tbody>
                        </table>
                    </div>
                    <div id="bdm-msg-div"></div>
                    <div class="text-center">
                        <button id="load-more-btn" class="btn btn-load text-center" onclick="loadByLimit()">Load More</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.php';?>
    <script>
        var updateOffset = 0;
        var isUpdateOffsetPristine = true;

        $(document).ready(function() {
            loadByLimit();
        });

        function loadByLimit() {
            $("#load-more-btn").prop('disabled', true);
            $.ajax({
                type: "POST",
                url: "<?php echo BASEURL ?>actions/admin/performfetchbdmlist.php",
                data: {
                    offset: updateOffset,
                    roleId: <?php echo $role->getId(); ?>
                },
                success: function(response) {
                    if(response.length == 0 && isUpdateOffsetPristine == true) {
                        $("#bdm-msg-div").html("<h4 class='text-center'>No BDMs Are Available!</h4>");
                        $("#load-more-btn").hide();
                        return;
                    } else if(response.length == 0 && isUpdateOffsetPristine == false) {
                        $("#bdm-msg-div").html("<h4 class='text-center'>No More BDMs Are Available!</h4>");
                        $("#load-more-btn").hide();
                        return;
                    }
                    var bdmListBuilder = "";
                    if(response.length == 0) {
                        $("#bdm-msg-div").html("<h4 class='text-center'>No BDMs Are Available!</h4>");
                        return;
                    }
                    for(var i=0; i<response.length; i++) {
                        bdmListBuilder += "<tr>";
                        bdmListBuilder += "<td>" + response[i].name + "</td>";
                        bdmListBuilder += "<td>" + response[i].email + "</td>";
                        bdmListBuilder += "<td>" + response[i].password + "</td>";
                        bdmListBuilder += "<td><button title='Show BDEs' class='btn btn-default action-btn' onclick='showBDEs(" + response[i].id + ")'><span class='glyphicon glyphicon-pawn'></span></button><button title='Edit' class='btn btn-default action-btn' onclick='editBdm(" + response[i].id + ")'><span class='glyphicon glyphicon-edit'></span></button><button title='Delete' class='btn btn-default action-btn' onclick='deleteBdm(" + response[i].id + "," + response[i].empId + ")'><span class='glyphicon glyphicon-trash'></span></button></td>";
                        bdmListBuilder += "</tr>";
                    }
                    $("#bdm-list").append(bdmListBuilder);
                    updateOffset += <?php echo BDM_LIST_LIMIT; ?>;
                    isUpdateOffsetPristine = false;
                    $("#load-more-btn").prop('disabled', false);
                }
            });
        }

        function editBdm(userId) {
            window.location = 'editbdm.php?roleId=' + <?php echo $role->getId(); ?> + '&' + 'userId=' + userId;
        }

        function showBDEs(userId) {
            window.location = 'showbdes.php?bdmId=' + userId;
        }

        function deleteBdm(userId, empId) {
            var result = confirm("Are You Sure?");
            if(result) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo BASEURL ?>actions/admin/performdeletebdm.php",
                    data: {
                        userId: userId,
                        empId: empId
                    },
                    success: function(response) {
                        window.location.reload();
                    }
                });
            }
        }

        function search() {
            $.ajax({
                type: "POST",
                url: "<?php echo BASEURL ?>actions/admin/performsearchuser.php",
                data: {
                    searchQuery: $("#search-box").val(),
                    roleId: <?php echo $role->getId(); ?>
                },
                success: function(response) {
                    var bdmListBuilder = "";
                    for(var i=0; i<response.length; i++) {
                        bdmListBuilder += "<tr>";
                        bdmListBuilder += "<td>" + response[i].name + "</td>";
                        bdmListBuilder += "<td>" + response[i].email + "</td>";
                        bdmListBuilder += "<td>" + response[i].password + "</td>";
                        bdmListBuilder += "<td><button title='Show BDEs' class='btn btn-default action-btn' onclick='showBDEs(" + response[i].id + ")'><span class='glyphicon glyphicon-pawn'></span></button><button title='Edit' class='btn btn-default action-btn' onclick='editBdm(" + response[i].id + ")'><span class='glyphicon glyphicon-edit'></span></button><button title='Delete' class='btn btn-default action-btn' onclick='deleteBdm(" + response[i].id + "," + response[i].empId + ")'><span class='glyphicon glyphicon-trash'></span></button></td>";
                        bdmListBuilder += "</tr>";
                    }
                    $("#bdm-list").html(bdmListBuilder);
                    if(response.length == 0) {
                        $("#bdm-msg-div").html("<h4 class='text-center'>No BDMs Are Available!</h4>");
                    } else {
                        $("#bdm-msg-div").html("");
                    }
                    $("#load-more-btn").hide();
                }
            });
        }
    </script>
</body>
</html>