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

    // Selected transaction (batch) reference from the Records list.
    $batchKey  = isset($_GET['batch']) ? trim($_GET['batch']) : '';
    $statusRaw = isset($_GET['status']) ? trim($_GET['status']) : '';

    if($batchKey === ''){
        header('Location: Records.php');
        exit;
    }

    // All beneficiaries for this transaction. DataTables handles paging,
    // searching and sorting on the client.
    $beneficiaries = $user->getSyncBatchBeneficiaries($batchKey, $statusRaw);

    // Transaction summary.
    $total = count($beneficiaries);
    $syncedAt = '';
    if(!empty($beneficiaries)){
        $syncedAt = $beneficiaries[0]['sent_at'];
        foreach($beneficiaries as $b){
            if($b['sent_at'] < $syncedAt){ $syncedAt = $b['sent_at']; }
        }
        $statusLabel = (strtolower($beneficiaries[0]['status']) === 'success') ? 'Successful' : 'Failed';
    } else {
        $statusLabel = (strtolower($statusRaw) === 'success') ? 'Successful' : 'Failed';
    }
    $isSuccess = ($statusLabel === 'Successful');
    $syncedAtDisplay = $syncedAt !== '' ? date('M d, Y h:i A', strtotime($syncedAt)) : '-';

    function bene_fullname($b){
        $parts = array_filter([
            trim($b['lastname']) !== '' ? $b['lastname'] . ',' : '',
            $b['firstname'],
            $b['middlename'],
            $b['extraname']
        ]);
        $name = trim(implode(' ', $parts));
        if($name === '' || $name === ','){ return '(name unavailable)'; }
        return $name;
    }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>DSWD - Sync Transaction Details</title>

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
        .summary-card { border: 1px solid #dee2e6; border-radius: 8px; padding: 18px 22px; margin-bottom: 22px; background: #f8f9fa; }
        .summary-card .summary-item { display: inline-block; margin-right: 40px; }
        .summary-card .summary-label { font-size: 12px; color: #888; text-transform: uppercase; letter-spacing: .5px; }
        .summary-card .summary-value { font-size: 20px; font-weight: 700; color: #333; }
        .bene-table td { vertical-align: middle; }
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
                <div style="margin-bottom: 15px;">
                    <a href="Records.php" class="btn btn-outline-secondary btn-sm">
                        <i class="fa fa-arrow-left"></i> Back to Records
                    </a>
                </div>

                <h5 style="margin-bottom: 18px;">Sync Transaction Details</h5>

                <!-- Transaction summary -->
                <div class="summary-card">
                    <div class="summary-item">
                        <div class="summary-label">Timestamp</div>
                        <div class="summary-value"><?php echo htmlspecialchars($syncedAtDisplay); ?></div>
                    </div>
                    <div class="summary-item">
                        <div class="summary-label">Beneficiaries Synced</div>
                        <div class="summary-value"><?php echo intval($total); ?></div>
                    </div>
                    <div class="summary-item">
                        <div class="summary-label">Status</div>
                        <div class="summary-value">
                            <span class="badge-status <?php echo $isSuccess ? 'badge-success-soft' : 'badge-failed-soft'; ?>">
                                <i class="fa <?php echo $isSuccess ? 'fa-check-circle' : 'fa-times-circle'; ?>"></i>
                                <?php echo htmlspecialchars($statusLabel); ?>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Beneficiary list -->
                <div class="table-responsive-lg">
                    <table id="beneTable" class="table table-striped table-hover bene-table border-left border-bottom" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Beneficiary Name</th>
                                <th>Control No.</th>
                                <th>Assistance Type</th>
                                <th>Date Served</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($beneficiaries as $b):
                                $rowSuccess = (strtolower($b['status']) === 'success');
                                $dateServed = !empty($b['date_accomplished']) ? date('M d, Y', strtotime($b['date_accomplished'])) : '-';
                            ?>
                                <tr>
                                    <td></td>
                                    <td><?php echo htmlspecialchars(bene_fullname($b)); ?></td>
                                    <td><?php echo htmlspecialchars($b['trans_id']); ?></td>
                                    <td><?php echo htmlspecialchars($b['assistance_type'] !== null && $b['assistance_type'] !== '' ? $b['assistance_type'] : '-'); ?></td>
                                    <td><?php echo htmlspecialchars($dateServed); ?></td>
                                    <td>
                                        <span class="badge-status <?php echo $rowSuccess ? 'badge-success-soft' : 'badge-failed-soft'; ?>">
                                            <?php echo $rowSuccess ? 'Successful' : 'Failed'; ?>
                                        </span>
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

        $(function(){
            var table = $('#beneTable').DataTable({
                order: [[1, 'asc']],
                pageLength: 10,
                lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']],
                columnDefs: [
                    { targets: 0, orderable: false, searchable: false, className: 'text-center' }
                ],
                language: {
                    search: 'Search beneficiaries:',
                    emptyTable: 'No beneficiary details found for this transaction.'
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

            // Keep the "#" column as a running row number that reflects the
            // current order, page and search.
            table.on('order.dt search.dt draw.dt', function(){
                table.column(0, {search: 'applied', order: 'applied'}).nodes().each(function(cell, i){
                    cell.innerHTML = i + 1;
                });
            });
            table.draw();
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
