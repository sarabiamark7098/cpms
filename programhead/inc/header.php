<?php
/**
 * Shared header + sidebar for the Program Head area.
 * Pages must set $pageTitle and $active ('dashboard'|'accounts'|'audit'|'history')
 * before including this file.
 */
$pageTitle = $pageTitle ?? 'Program Head';
$active    = $active    ?? '';

function ph_nav_style($current, $active) {
    return $current === $active ? 'font-weight:bold;background:rgba(0,0,0,0.15);' : '';
}
?>
<!DOCTYPE html>
<html>

<head>
<title>DSWD - CPMS | <?php echo htmlspecialchars($pageTitle); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="icon" type="image/png" href="../images/icons/ciu.ico"/>
        <link rel="stylesheet" type="text/css" href="../css/main.css">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../css/table.responsive.css">
        <link rel="stylesheet" type="text/css" href="../style5.css">

        <script defer src="../js/solid.js"></script>
        <script defer src="../js/fontawesome.js"></script>
        <script src="../js/jquery.slim.min.js"></script>
        <script src="../js/popper.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../js/main.js"></script>
        <script type="text/javascript" src="../js/jquery.min.js"></script>

        <link rel="stylesheet" type="text/css" href="../datatables/datatables.css">
        <script type="text/javascript" charset="utf8" src="../datatables/datatables.js"></script>
        <script type="text/javascript" src="../js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../js/bootstrap-3.3.7.min.js"></script>

        <style>
            .dropdown .dropdown-menu .dropdown-item:active, .dropdown
            .dropdown-menu .dropdown-item:hover{background-color: skyblue !important;}
            .ph-card{border-radius:8px;padding:20px;color:#fff;margin-bottom:20px;box-shadow:0 2px 6px rgba(0,0,0,0.15);}
            .ph-card .ph-num{font-size:34px;font-weight:700;line-height:1;}
            .ph-card .ph-label{font-size:14px;opacity:.9;}
            .ph-card i{float:right;font-size:40px;opacity:.35;}
        </style>
    </head>

<body>
    <div class="wrapper">
        <!-- Sidebar Holder -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <img src="../images/logo.png" alt="dswd logo" width="100px" height="100px">
            </div>

            <ul class="list-unstyled components">
                <li>
                    <a href="home.php" style="<?php echo ph_nav_style('dashboard', $active); ?>">Home <i style="float: right;font-size:25px" class="fa fa-chart-bar"></i></a>
                </li>
                <li>
                    <a href="Dashboard.php" style="<?php echo ph_nav_style('dashboardsw', $active); ?>">Dashboard <i style="float: right;font-size:25px" class="fa fa-trophy"></i></a>
                </li>
                <li>
                    <a href="AccountsManagement.php" style="<?php echo ph_nav_style('accounts', $active); ?>">Accounts Management <i style="float: right;font-size:25px" class="fa fa-users"></i></a>
                </li>
                <li>
                    <a href="AuditLogs.php" style="<?php echo ph_nav_style('audit', $active); ?>">Audit Logs <i style="float: right;font-size:25px" class="fa fa-list-alt"></i></a>
                </li>
                <li>
                    <a href="History.php" style="<?php echo ph_nav_style('history', $active); ?>">History <i style="float: right;font-size:25px" class="fa fa-history"></i></a>
                </li>
            </ul>
        </nav>

        <!-- Page Content Holder -->
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-blue">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="navbar-btn">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    <span class="nav-link tohover" style="margin-left: 10px;">
                        <?php $name = explode(' ', $_SESSION['userfullname'] ?? ''); echo strtoupper($name[0] ?? ''); ?>
                        <small style="opacity:.8;">(Program Head)</small>
                    </span>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto tohover" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a class="nav-link tohover" data-toggle="modal" data-target="#logoutmodal">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="container-fluid" style="padding-left: 5%">
