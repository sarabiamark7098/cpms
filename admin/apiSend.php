<?php
	include("../php/class.user.php");
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
			case 'Admin': header("Location: ../admin/home.php");
							break;
			default:
				echo "<script>window.location='../index.php';</script>";
		}
	}
?>

<!DOCTYPE html>
<html>

<head>
<title>DSWD - API Send</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link rel="icon" type="image/png" href="../images/icons/ciu.ico"/>
		<link rel="stylesheet" type="text/css" href="../css/main.css">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../style5.css">

        <script defer src="../js/solid.js"></script>
        <script defer src="../js/fontawesome.js"></script>
        <script src="../js/jquery.slim.min.js"></script>
        <script src="../js/popper.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../js/jquery-3.2.1.slim.min.js"></script>
        <script type="text/javascript" src="../js/main.js"></script>
        <script type="text/javascript" src="../js/PSGC.js"></script>
        <script type="text/javascript" src="../js/jquery.min.js"></script>

		<script type="text/javascript" src="../js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../js/bootstrap-3.3.7.min.js"></script>

        <style type="text/css">
			.dropdown .dropdown-menu .dropdown-item:active, .dropdown
			.dropdown-menu .dropdown-item:hover{background-color: skyblue  !important;}
			.count-card { border-radius: 8px; padding: 25px 20px; text-align: center; margin-bottom: 15px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); }
			.count-card .count-number { font-size: 48px; font-weight: bold; }
			.count-card .count-label { font-size: 16px; margin-top: 5px; }
			.count-card.unsent { background-color: #fff3cd; border: 1px solid #ffc107; color: #856404; }
			.count-card.sent { background-color: #d4edda; border: 1px solid #28a745; color: #155724; }
			#dataLoader { text-align: center; padding: 30px 0; }
			#dataLoader .fa-spinner { font-size: 24px; color: #007bff; }
			.config-card { border: 1px solid #dee2e6; border-radius: 8px; padding: 20px; margin-bottom: 20px; background: #f8f9fa; }
			.config-card h6 { margin-bottom: 15px; font-weight: bold; }
			.config-card .form-check { margin-bottom: 8px; }
			.batch-log { font-family: monospace; font-size: 13px; background: #1e1e1e; color: #d4d4d4; padding: 15px; border-radius: 6px; max-height: 300px; overflow-y: auto; white-space: pre-wrap; }
			.batch-log .log-success { color: #4ec9b0; }
			.batch-log .log-error { color: #f44747; }
			.batch-log .log-info { color: #569cd6; }
        </style>
    </head>

<body>
    <div class="wrapper">
        <!-- Sidebar Holder -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <img src="../images/logo.png" alt="dswd logo" width="100px" height="100px" >
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
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                <h5 style="margin-bottom: 25px;">Assistance - API Sync</h5>

                <!-- Sync Configuration Card -->
                <div class="config-card">
                    <h6><i class="fa fa-cog"></i> Sync Configuration - Select Assistance Types</h6>
                    <div id="configLoader" style="text-align:center; padding:10px;">
                        <i class="fa fa-spinner fa-spin"></i> Loading configuration...
                    </div>
                    <div id="configCheckboxes" style="display:none;">
                        <div class="row" id="checkboxRow"></div>
                        <div style="margin-top: 15px;">
                            <button id="btnSaveConfig" class="btn btn-success btn-sm">
                                <i class="fa fa-save"></i> Save Configuration
                            </button>
                            <span id="configSaveMsg" style="margin-left: 10px; display:none;" class="text-success"><i class="fa fa-check"></i> Saved</span>
                        </div>
                    </div>
                </div>

                <!-- Loading spinner for counts -->
                <div id="dataLoader" style="display:none;">
                    <i class="fa fa-spinner fa-spin"></i>
                    <p style="margin-top:10px; color:#666;">Loading records...</p>
                </div>

                <!-- Count Cards -->
                <div id="countsContainer" style="display:none;">
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="count-card unsent">
                                <div class="count-number" id="unsentNumber">0</div>
                                <div class="count-label"><i class="fa fa-clock-o"></i> Unsent Records</div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="count-card sent">
                                <div class="count-number" id="sentNumber">0</div>
                                <div class="count-label"><i class="fa fa-check-circle"></i> Sent Records</div>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 20px;">
                        <div class="col-lg-3">
                            <button id="btnSendAll" class="btn btn-primary btn-lg" disabled>
                                <i class="fa fa-paper-plane"></i> Send All Unsent
                            </button>
                        </div>
                        <div class="col-lg-2">
                            <button id="btnRefresh" class="btn btn-outline-secondary btn-lg">
                                <i class="fa fa-refresh"></i> Refresh
                            </button>
                        </div>
                    </div>

                    <!-- Batch Progress Card -->
                    <div id="batchProgressCard" style="display:none; margin-top: 20px;">
                        <div class="card">
                            <div class="card-header">
                                <strong><i class="fa fa-tasks"></i> Batch Progress</strong>
                                <span id="batchStatus" style="float:right;"></span>
                            </div>
                            <div class="card-body" style="padding: 0;">
                                <div class="batch-log" id="batchLog"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Error State -->
                <div id="dataError" style="display:none; text-align:center; padding:40px 0;">
                    <p style="color:#dc3545;"><i class="fa fa-exclamation-triangle"></i> Failed to load records.</p>
                    <button class="btn btn-outline-primary btn-sm" onclick="loadCounts()"><i class="fa fa-refresh"></i> Retry</button>
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
        // Load sync configuration checkboxes
        function loadConfig(){
            $('#configLoader').show();
            $('#configCheckboxes').hide();

            $.ajax({
                type: "POST",
                url: "api_fetch.php",
                data: { load_sync_config: true },
                dataType: "json",
                success: function(response){
                    if(response.status === 'success'){
                        var html = '';
                        $.each(response.config, function(i, item){
                            var checked = parseInt(item.is_active) === 1 ? 'checked' : '';
                            html += '<div class="col-lg-3 col-md-4 col-sm-6">';
                            html += '<div class="form-check">';
                            html += '<input class="form-check-input sync-type-check" type="checkbox" value="' + item.assistance_type + '" id="chk_' + i + '" ' + checked + '>';
                            html += '<label class="form-check-label" for="chk_' + i + '">' + item.assistance_type + '</label>';
                            html += '</div></div>';
                        });
                        $('#checkboxRow').html(html);
                        $('#configLoader').hide();
                        $('#configCheckboxes').show();
                        loadCounts();
                    }
                },
                error: function(){
                    $('#configLoader').html('<span class="text-danger">Failed to load config.</span>');
                }
            });
        }

        // Save sync configuration
        $('#btnSaveConfig').on('click', function(){
            var selectedTypes = [];
            $('.sync-type-check:checked').each(function(){
                selectedTypes.push($(this).val());
            });

            var btn = $(this);
            btn.prop('disabled', true);
            $('#configSaveMsg').hide();

            $.ajax({
                type: "POST",
                url: "api_fetch.php",
                data: { save_sync_config: true, types: selectedTypes },
                dataType: "json",
                success: function(response){
                    btn.prop('disabled', false);
                    if(response.status === 'success'){
                        $('#configSaveMsg').show().delay(3000).fadeOut();
                        loadCounts();
                    }
                },
                error: function(){
                    btn.prop('disabled', false);
                    alert('Failed to save configuration.');
                }
            });
        });

        // Load counts
        function loadCounts(){
            $('#dataLoader').show();
            $('#countsContainer').hide();
            $('#dataError').hide();
            $('#btnSendAll').prop('disabled', true);

            $.ajax({
                type: "POST",
                url: "api_fetch.php",
                data: { load_counts: true },
                dataType: "json",
                success: function(response){
                    if(response.status === 'success'){
                        $('#unsentNumber').text(response.unsent);
                        $('#sentNumber').text(response.sent);

                        if(response.unsent > 0){
                            $('#btnSendAll').prop('disabled', false);
                        }

                        $('#dataLoader').hide();
                        $('#countsContainer').show();
                    } else {
                        $('#dataLoader').hide();
                        $('#dataError').show();
                    }
                },
                error: function(){
                    $('#dataLoader').hide();
                    $('#dataError').show();
                }
            });
        }

        // Batch send logic
        var totalSent = 0;
        var batchNum = 0;
        var isSending = false;

        function appendLog(msg, cls){
            var timestamp = new Date().toLocaleTimeString();
            var span = '<span class="' + (cls || '') + '">[' + timestamp + '] ' + msg + '</span>\n';
            var logEl = document.getElementById('batchLog');
            logEl.innerHTML += span;
            logEl.scrollTop = logEl.scrollHeight;
        }

        function sendBatch(){
            batchNum++;
            appendLog('Batch ' + batchNum + ': Sending up to 200 records...', 'log-info');
            $('#batchStatus').html('<i class="fa fa-spinner fa-spin"></i> Processing batch ' + batchNum + '...');

            $.ajax({
                type: "POST",
                url: "api_fetch.php",
                data: { send_unsent_batch: true },
                dataType: "json",
                success: function(response){
                    if(response.status === 'success'){
                        totalSent += response.sent_count;
                        appendLog('Batch ' + batchNum + ': Sent ' + response.sent_count + ' record(s). Remaining: ' + response.remaining, 'log-success');

                        if(response.remaining > 0){
                            sendBatch();
                        } else {
                            appendLog('All done! Total records sent: ' + totalSent, 'log-success');
                            $('#batchStatus').html('<span class="text-success"><i class="fa fa-check-circle"></i> Completed</span>');
                            isSending = false;
                            $('#btnSendAll').prop('disabled', false).html('<i class="fa fa-paper-plane"></i> Send All Unsent');
                            loadCounts();
                        }
                    } else if(response.status === 'info'){
                        appendLog(response.message, 'log-info');
                        appendLog('Total records sent: ' + totalSent, 'log-success');
                        $('#batchStatus').html('<span class="text-success"><i class="fa fa-check-circle"></i> Completed</span>');
                        isSending = false;
                        $('#btnSendAll').prop('disabled', false).html('<i class="fa fa-paper-plane"></i> Send All Unsent');
                        loadCounts();
                    } else {
                        appendLog('ERROR: ' + response.message, 'log-error');
                        appendLog('Stopped. Total records sent before error: ' + totalSent, 'log-error');
                        $('#batchStatus').html('<span class="text-danger"><i class="fa fa-exclamation-triangle"></i> Error</span>');
                        isSending = false;
                        $('#btnSendAll').prop('disabled', false).html('<i class="fa fa-paper-plane"></i> Send All Unsent');
                        loadCounts();
                    }
                },
                error: function(xhr, status, error){
                    appendLog('AJAX Error: ' + error, 'log-error');
                    appendLog('Stopped. Total records sent before error: ' + totalSent, 'log-error');
                    $('#batchStatus').html('<span class="text-danger"><i class="fa fa-exclamation-triangle"></i> Error</span>');
                    isSending = false;
                    $('#btnSendAll').prop('disabled', false).html('<i class="fa fa-paper-plane"></i> Send All Unsent');
                }
            });
        }

        $(document).ready(function(){
            loadConfig();

            $('#btnRefresh').on('click', function(){
                loadCounts();
            });

            $('#btnSendAll').on('click', function(){
                if(isSending) return;
                isSending = true;
                totalSent = 0;
                batchNum = 0;

                $(this).prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Sending...');
                $('#batchLog').html('');
                $('#batchProgressCard').show();

                appendLog('Starting batch sync...', 'log-info');
                sendBatch();
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
                    url: "userAccount.php",
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
		  var button = $(event.relatedTarget)
		  var modal = $(this);
          var dataString = 'id=logout';
            $.ajax({
                type: "GET",
                url: "apiSend.php",
                data: dataString,
                cache: false,
                success: function (data) {
                    modal.find('.logoutbody');
                },
                error: function(err) {
                }
            });
        })
    </script>
</html>
