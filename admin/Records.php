<?php
    include('../php/class.user.php');
    require_once("../php/session_timeout.php");
    $user = new User();

    if(!$_SESSION['login']){
        header('Location:../index.php');
    }
    if($_SESSION['position'] != 'Admin'){
        switch ($_SESSION['position']){
            case 'Encoder': header("Location: ../encoder/home.php");
                            break;
            case 'Social Worker': header("Location: ../socialwork/home.php");
                            break;
            case 'Admin': header("Location: ../admin/home.php");
                            break;
            default:
                echo "<script>window.location='../index.php';</script>";
        }
    }

    // Sync transaction history for the last 3 months. DataTables handles
    // paging, searching and sorting on the client.
    $syncMonths = 3;
    $transactions = $user->getSyncTransactions($syncMonths);
    $total = count($transactions);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>DSWD - Records</title>

    <link rel="icon" type="image/png" href="../images/icons/ciu.ico"/>
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../style5.css">
    <link rel="stylesheet" type="text/css" href="../datatables/datatables.css">

    <script defer src="../js/solid.js"></script>
    <script defer src="../js/fontawesome.js"></script>
    <script src="../js/jquery.slim.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/jquery-3.2.1.slim.min.js"></script>
    <script type="text/javascript" src="../js/main.js"></script>
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap-3.3.7.min.js"></script>
    <script type="text/javascript" charset="utf8" src="../datatables/datatables.js"></script>

    <style type="text/css">
        .badge-status { font-size: 13px; padding: 6px 12px; border-radius: 12px; font-weight: 600; }
        .badge-success-soft { background-color: #d4edda; color: #155724; }
        .badge-failed-soft { background-color: #f8d7da; color: #721c24; }
        .records-table td { vertical-align: middle; }
        .bene-count-pill { display:inline-block; min-width: 42px; padding: 4px 10px; background:#e9ecef; border-radius: 12px; font-weight: 600; }
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
                    <a href="home.php">Providers<i style="float: right;font-size:25px" class="fa fa-handshake"></i> </a>
                </li>
                <li>
                    <a href="OfficePage.php">Offices<i style="float: right;font-size:25px" class="fa fa-building"></i></a>
                </li>
                <li>
                    <a href="Employee.php">Employees <i style="float: right;font-size:25px" class="fa fa-users"></i></a>
                </li>
                <li>
                    <a href="SignatoryPage.php">Signatory List <i style="float: right;font-size:25px" class="fa fa-list"></i></a>
                </li>
                <li>
                    <a href="GISassessment.php">GIS Assessment <i style="float: right;font-size:25px" class="fa fa-list"></i></a>
                </li>
                <li>
                    <a href="fundsource.php">Fund Source <i style="float: right;font-size:25px" class="fa fa-list"></i></a>
                </li>
                <li>
                    <a href="SubCategoryPage.php">Sub-Categories <i style="float: right;font-size:25px" class="fa fa-tags"></i></a>
                </li>
                <li>
                    <a href="GenderIdentityPage.php">Gender Identities <i style="float: right;font-size:25px" class="fa fa-venus-mars"></i></a>
                </li>
                <li>
                    <a href="summarylist.php">Summary List <i style="float: right;font-size:25px" class="fa fa-list"></i></a>
                </li>
                <li>
                    <a href="reissue_log.php">Re-issue Logs <i style="float: right;font-size:25px" class="fa fa-list"></i></a>
                </li>
                <li>
                    <a href="cancelledGL_logs.php">Cancelled GL Logs <i style="float: right;font-size:25px" class="fa fa-list"></i></a>
                </li>
                <li>
                    <a href="AccountsManagement.php">Accounts Management <i style="float: right;font-size:25px" class="fa fa-user-cog"></i></a>
                </li>
                <li>
                    <a href="apiSend.php">API Send <i style="float: right;font-size:25px" class="fa fa-paper-plane"></i></a>
                </li>
                <li class="active">
                    <a href="Records.php">Records <i style="float: right;font-size:25px" class="fa fa-database"></i></a>
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
                    <a class="nav-link toggle tohover" data-id="<?php echo $_SESSION['userId'];?>" data-target="#userAccount" style="margin-left: 10px;" data-toggle="modal" aria-haspopup="true" aria-expanded="false">
                        <?php $name = explode(' ',$_SESSION['userfullname']); $namef=strtoupper($name[0]); echo $namef;?>
                    </a>
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

            <div class="container-fluid" style="padding-left: 5%; padding-right: 5%;">
                <h5 style="margin-bottom: 5px;">RDV Syncing Records</h5>
                <p style="color:#666; margin-bottom: 20px;">
                    Transaction history of daily onsite served beneficiaries synced to the RDV
                    <span style="color:#999;">(last <?php echo (int)$syncMonths; ?> months)</span>.
                </p>

                <!-- Table -->
                <div class="table-responsive-lg">
                    <table id="recordsTable" class="table table-striped table-hover records-table border-left border-bottom" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Timestamp</th>
                                <th class="text-center">Beneficiaries Synced</th>
                                <th class="text-center">Status</th>
                                <th>Source</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($transactions as $t):
                                $isSuccess = (strtolower($t['status']) === 'success');
                                $timestamp = date('M d, Y h:i A', strtotime($t['started_at']));
                                $source = (strtoupper($t['sent_by']) === 'CRON') ? 'System (CRON)' : 'Manual';
                                $detailUrl = 'RecordDetails.php?batch=' . urlencode($t['batch_key']) . '&status=' . urlencode($t['status']);
                            ?>
                                <tr>
                                    <td data-order="<?php echo htmlspecialchars($t['started_at']); ?>"><?php echo htmlspecialchars($timestamp); ?></td>
                                    <td class="text-center"><span class="bene-count-pill"><?php echo intval($t['bene_count']); ?></span></td>
                                    <td class="text-center">
                                        <span class="badge-status <?php echo $isSuccess ? 'badge-success-soft' : 'badge-failed-soft'; ?>">
                                            <i class="fa <?php echo $isSuccess ? 'fa-check-circle' : 'fa-times-circle'; ?>"></i>
                                            <?php echo $isSuccess ? 'Successful' : 'Failed'; ?>
                                        </span>
                                    </td>
                                    <td><?php echo htmlspecialchars($source); ?></td>
                                    <td class="text-center">
                                        <a class="btn btn-sm btn-outline-primary" href="<?php echo $detailUrl; ?>">
                                            <i class="fa fa-eye"></i> View
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebar').toggleClass('active');
            $('#sidebarCollapse').toggleClass('active');
        });
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $(this).toggleClass('active');
            });
        });
    </script>

    <script type="text/javascript">
        $(function(){
            $('#recordsTable').DataTable({
                order: [[0, 'desc']],
                pageLength: 25,
                lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']],
                columnDefs: [
                    { targets: 4, orderable: false, searchable: false }
                ],
                language: {
                    search: 'Search transactions:',
                    emptyTable: 'No sync transactions found in the last 3 months.'
                },
                responsive: {
                    breakpoints: [
                        {name: 'bigdesktop', width: Infinity},
                        {name: 'meddesktop', width: 1480},
                        {name: 'smalldesktop', width: 1280},
                        {name: 'medium', width: 1188},
                        {name: 'tabletl', width: 1024},
                        {name: 'btwtabllandp', width: 848},
                        {name: 'tabletp', width: 768},
                        {name: 'mobilel', width: 480},
                        {name: 'mobilep', width: 320}
                    ]
                }
            });
        });
    </script>

    <div class="module">
        <div class="modal fade in" id="userAccount" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">User Account</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="useraccount"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#userAccount').appendTo("body").on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var userid = button.data('id')
            var modal = $(this);
            var dataString = 'id=' + userid;
            $.ajax({
                type: "GET",
                url: "userAccount.php",
                data: dataString,
                cache: false,
                success: function (data) {
                    modal.find('.useraccount').html(data);
                },
                error: function(err) {}
            });
        })
    </script>

    <div class="modal hide fade" id="logoutmodal" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header"><h4>Logout <i class="fa fa-lock"></i></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body logoutbody"><i class="fa fa-question-circle"></i> Are you sure you want to log-out?</div>
                <div class="modal-footer"><a href="../php/logout.php" class="btn btn-primary btn-block">Logout</a></div>
            </div>
        </div>
    </div>
</body>
</html>
