<div class="list-group" id="side-menu">
<br>
    <a href="../home.php" class="list-group-item">
        <i class="fa fa-home" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Home
    </a>
    <?php if ($_SESSION['role'] == "ADMIN") : ?>
        <a href="admin/addbdm.php" class="list-group-item">
            <i class="fa fa-users" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Add BDM
        </a>
    <?php endif; ?>
    <?php if ($_SESSION['role'] == "ADMIN") : ?>
        <a href="admin/addbde.php" class="list-group-item">
            <i class="fa fa-users" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Add BDE
        </a>
    <?php endif; ?>
    <?php if ($_SESSION['role'] == "ADMIN") : ?>
        <a href="admin/addclient.php" class="list-group-item">
            <i class="fa fa-users" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Add Client
        </a>
    <?php endif; ?>
    <?php if ($_SESSION['role'] == "ADMIN") : ?>
        <a href="admin/bdmlist.php" class="list-group-item">
            <i class="fa fa-list" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BDM List
        </a>
    <?php endif; ?>
    <?php if ($_SESSION['role'] == "ADMIN") : ?>
        <a href="admin/bdelist.php" class="list-group-item">
            <i class="fa fa-list" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BDE List
        </a>
    <?php endif; ?>
    <?php if ($_SESSION['role'] == "ADMIN") : ?>
        <a href="admin/clientcompanylist.php" class="list-group-item">
            <i class="fa fa-list" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Client Company List
        </a>
    <?php endif; ?>
    <?php if ($_SESSION['role'] == "ADMIN") : ?>
        <a href="admin/clientcontactlist.php" class="list-group-item">
            <i class="fa fa-list" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Client Contact List
        </a>
    <?php endif; ?>
    <?php if ($_SESSION['role'] == "ADMIN") : ?>
        <a href="configurations.php" class="list-group-item">
            <i class="fa fa-list" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Configurations
        </a>
    <?php endif; ?>
    
      <!--BDE SIDE MENU -->
    <?php if ($_SESSION['role'] == "BDE") : ?>
        <a href="bde_registration.php" class="list-group-item">
            <i class="fa fa-users" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Add Client
        </a>
    <?php endif; ?>
    <?php if ($_SESSION['role'] == "BDE") : ?>
        <a href="bde_csv.php" class="list-group-item">
            <i class="fa fa-upload" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CSV File Upload
        </a>
    <?php endif; ?>
    <?php if ($_SESSION['role'] == "BDE") : ?>
        <a href="bde_clientlist.php" class="list-group-item">
            <i class="fa fa-list" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Client List
        </a>
    <?php endif; ?>
    <?php if ($_SESSION['role'] == "BDE") : ?>
        <a href="bde_companyclientlist.php" class="list-group-item">
         <i class="fa fa-list" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Company List
        </a>
    <?php endif; ?>
    
    
    <!-- BDM side menu -->
    <?php if ($_SESSION['role'] == "BDM") : ?>
        <a href="companylist.php" class="list-group-item">
            <i class="fa fa-list" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Client Company List
        </a>
    <?php endif; ?>
    <?php if ($_SESSION['role'] == "BDM") : ?>
        <a href="clientlist.php" class="list-group-item">
            <i class="fa fa-list" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Client Contact List
        </a>
    <?php endif; ?>
    <?php if ($_SESSION['role'] == "BDM") : ?>
        <a href="bdelist.php" class="list-group-item">
            <i class="fa fa-list" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BDE List
        </a>
    <?php endif; ?>
    <?php if ($_SESSION['role'] == "BDM") : ?>
        <a href="inbox.php" class="list-group-item">
            <i class="fa fa-inbox" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mail Inbox
        </a>
    <?php endif; ?>
    
    
</div>

 
