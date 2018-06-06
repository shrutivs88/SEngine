<div class="list-group" id="side-menu">
    <a href="../home.php" class="list-group-item">
        <i class="fa fa-home" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Home
    </a>
    <?php if ($_SESSION['role'] == "ADMIN") : ?>
        <a href="addbdm.php" class="list-group-item">
            <i class="fa fa-users" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Add BDM
        </a>
    <?php endif; ?>
    <?php if ($_SESSION['role'] == "ADMIN") : ?>
        <a href="addbde.php" class="list-group-item">
            <i class="fa fa-users" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Add BDE
        </a>
    <?php endif; ?>
    <?php if ($_SESSION['role'] == "ADMIN" || $_SESSION['role'] == "BDE") : ?>
        <a href="addclient.php" class="list-group-item">
            <i class="fa fa-users" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Add Client
        </a>
    <?php endif; ?>
    <?php if ($_SESSION['role'] == "ADMIN") : ?>
        <a href="bdmlist.php" class="list-group-item">
            <i class="fa fa-list" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BDM List
        </a>
    <?php endif; ?>
    <?php if ($_SESSION['role'] == "ADMIN") : ?>
        <a href="bdelist.php" class="list-group-item">
            <i class="fa fa-list" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BDE List
        </a>
    <?php endif; ?>
    <?php if ($_SESSION['role'] == "ADMIN") : ?>
        <a href="clientcompanylist.php" class="list-group-item">
            <i class="fa fa-list" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Client Company List
        </a>
    <?php endif; ?>
    <?php if ($_SESSION['role'] == "ADMIN") : ?>
        <a href="clientcontactlist.php" class="list-group-item">
            <i class="fa fa-list" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Client Contact List
        </a>
    <?php endif; ?>
    <?php if ($_SESSION['role'] == "ADMIN") : ?>
        <a href="configurations.php" class="list-group-item">
            <i class="fa fa-list" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Configurations
        </a>
    <?php endif; ?>
</div>