<?php
	include("../php/class.user.php");
    require_once("../php/session_timeout.php");
	$user = new User();

	if(!$_SESSION['login']){
		header('location:../index.php');
		}
	if($_SESSION['position'] != 'Admin'){
		switch ($_SESSION['position']){
			case 'Encoder': header("Location: ../encoder/home.php");
							break;
			case 'Social Worker': header("Location: ../socialwork/home.php");
							break;
			case 'Program Head': header("Location: ../programhead/home.php");
							break;
			default:
				echo "<script>window.location='../index.php';</script>";
		}
	}

	// ── Handle status change (activate / deactivate) ────────────────────────────
	$flash = '';
	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['toggle_status'])) {
		$targetEmp    = $_POST['empid'] ?? '';
		$targetStatus = $_POST['new_status'] ?? '';
		if ($targetEmp === ($_SESSION['userId'] ?? '')) {
			$flash = "You cannot change your own account status.";
		} elseif ($targetEmp !== '' && $user->setAccountStatus($targetEmp, $targetStatus)) {
			$flash = "Account {$targetEmp} set to {$targetStatus}.";
		} else {
			$flash = "Unable to update account status.";
		}
	}

	// Office id -> readable name lookup
	$officeMap = [];
	$offices = $user->optionoffice();
	if ($offices) {
		while ($o = mysqli_fetch_assoc($offices)) {
			$officeMap[$o['office_id']] = $o['office_name'] ?? ($o['office_accronym'] ?? $o['office_id']);
		}
	}
?>

<!DOCTYPE html>
<html>

<head>
<title>DSWD - CPMS | Accounts Management</title>
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
			.dropdown-menu .dropdown-item:hover{background-color: skyblue  !important;}
		</style>
		<script>
		  $(function(){
			$("#accountsTable").dataTable();
		  })
		</script>

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
            <div class="container-fluid"  style="padding-left: 5%">
                <h4 style="margin:10px 0 20px;">Accounts Management</h4>
                <?php if ($flash !== ''): ?>
                <div class="alert alert-info" style="background:#e7f3fe;border:1px solid #2c7be5;color:#12457a;padding:10px 14px;border-radius:4px;">
                    <?php echo htmlspecialchars($flash); ?>
                </div>
                <?php endif; ?>
                <div class="table-responsive-lg">
                    <table id="accountsTable" class="table table-fixed table-striped table-hover highlight responsive-table" style="width:100%;">
                        <thead>
                            <tr>
                                <th>Employee ID</th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Office</th>
                                <th>Status</th>
                                <th style="width:12%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $employees = $user->getallEmployee();
                            $hasRows = false;
                            if ($employees) {
                                while ($row = mysqli_fetch_assoc($employees)) {
                                    $pos = trim($row['position'] ?? '');
                                    if ($pos === '') {
                                        continue; // only show provisioned CPMS accounts
                                    }
                                    $hasRows = true;
                                    $empid    = $row['empid'];
                                    $fullname = trim(
                                        ($row['emplname'] ?? '') . ', ' .
                                        ($row['empfname'] ?? '') . ' ' .
                                        ($row['empmname'] ?? '') . ' ' .
                                        ($row['empext'] ?? '')
                                    );
                                    $office = $officeMap[$row['office_id']] ?? ($row['office_id'] ?? '-');
                                    $status = $row['status'] ?? '';
                                    $isActive = ($status === 'Activated');
                                    $badge = $isActive
                                        ? "<span class='badge' style='background:#27ab83;color:#fff;'>Activated</span>"
                                        : "<span class='badge' style='background:#dc3545;color:#fff;'>" . htmlspecialchars($status ?: 'Deactivated') . "</span>";

                                    // Toggle button: deactivate if active, activate if not.
                                    // Admin cannot change their own status (self-lockout guard).
                                    if ($empid === ($_SESSION['userId'] ?? '')) {
                                        $action = "<span style='color:#888;'>(you)</span>";
                                    } else {
                                        $newStatus = $isActive ? 'Deactivated' : 'Activated';
                                        $btnClass  = $isActive ? 'btn-danger'  : 'btn-success';
                                        $btnLabel  = $isActive ? 'Deactivate'  : 'Activate';
                                        $confirmMsg = htmlspecialchars($btnLabel . ' account ' . $empid . '?', ENT_QUOTES);

                                        $action = "<form method='POST' style='margin:0;' onsubmit=\"return confirm('{$confirmMsg}');\">"
                                                . "<input type='hidden' name='empid' value='" . htmlspecialchars($empid, ENT_QUOTES) . "'>"
                                                . "<input type='hidden' name='new_status' value='{$newStatus}'>"
                                                . "<button type='submit' name='toggle_status' class='btn {$btnClass} btn-sm'>{$btnLabel}</button>"
                                                . "</form>";
                                    }

                                    echo "<tr>
                                            <td>" . htmlspecialchars($empid) . "</td>
                                            <td>" . htmlspecialchars($fullname) . "</td>
                                            <td>" . htmlspecialchars($pos) . "</td>
                                            <td>" . htmlspecialchars($office) . "</td>
                                            <td>" . $badge . "</td>
                                            <td>" . $action . "</td>
                                          </tr>";
                                }
                            }
                            if (!$hasRows) {
                                echo "<tr><td colspan='6'>NO DATA</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
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
				<div class="useraccount">

				</div>
			</div>
		</div>
    </div>
</div>
</body>
    <script>
        $('#userAccount').appendTo("body").on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var userid = button.data('id')
            var modal = $(this);
            var dataString = 'id=' + userid;
                $.ajax({
                    type: "GET",
                    url: "adminuserAccount.php",
                    data: dataString,
                    cache: false,
                    success: function (data) {
                        modal.find('.useraccount').html(data);
                    },
                    error: function(err) {
                    }
                });
        })
    </script>

    <div class="modal hide fade" id="logoutmodal" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header"><h4>Logout <i class="fa fa-lock"></i></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button></div>
            <div class="modal-body logoutbody"><i class="fa fa-question-circle"></i> Are you sure you want to log-out?</div>
            <div class="modal-footer"><a href="../php/logout.php" class="btn btn-primary btn-block">Logout</a></div>
            </div>
        </div>
    </div>

    <script>
        $('#logoutmodal').appendTo("body").on('show.bs.modal', function (event) {
            var modal = $(this);
        })
    </script>

</html>
