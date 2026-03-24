<?php
    include('../php/class.user.php');
    require_once('../php/session_timeout.php');
    $user = new User();

    if(!$_SESSION['login']){
        header('Location:../index.php');
        exit;
    }
    if($_SESSION['position'] != 'Admin'){
        switch($_SESSION['position']){
            case 'Encoder':       header('Location:../encoder/home.php');     break;
            case 'Social Worker': header('Location:../socialwork/home.php');  break;
            default:              echo "<script>window.location='../index.php';</script>"; exit;
        }
    }

    $error   = '';
    $success = '';

    if(isset($_POST['register'])){
        $empid          = $_POST['empid']          ?? '';
        $empnum         = $_POST['empnum']         ?? 0;
        $empfname       = $_POST['empfname']       ?? '';
        $empmname       = $_POST['empmname']       ?? '';
        $emplname       = $_POST['emplname']       ?? '';
        $empext         = $_POST['empext']         ?? '';
        $empsex         = $_POST['empsex']         ?? '';
        $empstatus      = $_POST['empstatus']      ?? '';
        $emp_position   = $_POST['emp_position']   ?? '';
        $empuser        = $_POST['empuser']        ?? '';
        $emppass        = $_POST['emppass']        ?? '';
        $confirm_pass   = $_POST['confirm_pass']   ?? '';
        $position       = $_POST['position']       ?? '';
        $office_id      = $_POST['office_id']      ?? '';
        $acc_status     = $_POST['acc_status']     ?? '';
        $sw_license_no  = $_POST['sw_license_no']  ?? '';
        $sw_expiry      = $_POST['sw_expiry']      ?? '';

        // Basic validation
        if(empty($empid) || empty($emplname) || empty($empfname) ||
           empty($empuser) || empty($emppass) || empty($position) || empty($office_id)){
            $error = 'Please fill in all required fields.';
        } elseif($emppass !== $confirm_pass){
            $error = 'Passwords do not match.';
        } else {
            $result = $user->registerAccount(
                $empid, $empnum, $empfname, $empmname, $emplname,
                $empext, $empsex, $empstatus, $emp_position,
                $empuser, $emppass, $position, $office_id,
                $acc_status, $sw_license_no, $sw_expiry
            );

            switch($result){
                case 'success':
                    $success = "Account for <strong>" . htmlspecialchars(strtoupper($emplname)) .
                               ", " . htmlspecialchars(strtoupper($empfname)) .
                               "</strong> registered successfully.";
                    break;
                case 'username_taken':
                    $error = "Username &ldquo;" . htmlspecialchars($empuser) . "&rdquo; is already taken. Please choose another.";
                    break;
                default:
                    $error = 'Registration failed. Please try again.';
            }
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>DSWD - CPMS | Register Employee Account</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" href="../images/icons/ciu.ico"/>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../style5.css">
    <script defer src="../js/solid.js"></script>
    <script defer src="../js/fontawesome.js"></script>
    <script src="../js/jquery.slim.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap-3.3.7.min.js"></script>

    <style>
        /* ── Step Wizard Indicator ── */
        .reg-steps {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 28px 0 32px;
            gap: 0;
        }
        .reg-step {
            display: flex;
            align-items: center;
            flex-direction: column;
            position: relative;
        }
        .step-circle {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #d0d4de;
            color: #fff;
            font-size: 16px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background .3s;
            z-index: 1;
        }
        .step-circle.active  { background: #3a7bd5; }
        .step-circle.done    { background: #28a745; }
        .step-label {
            font-size: 11px;
            margin-top: 6px;
            color: #666;
            font-weight: 600;
            text-align: center;
            white-space: nowrap;
        }
        .step-label.active { color: #3a7bd5; }
        .step-connector {
            flex: 1;
            height: 3px;
            background: #d0d4de;
            min-width: 80px;
            max-width: 160px;
            margin-bottom: 18px;
            transition: background .3s;
        }
        .step-connector.done { background: #28a745; }

        /* ── Form Panel ── */
        .reg-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 16px rgba(0,0,0,.08);
            padding: 32px 40px 24px;
            max-width: 820px;
            margin: 0 auto 40px;
        }
        .reg-card h5.section-title {
            font-size: 13px;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: #3a7bd5;
            border-bottom: 2px solid #e8ecf4;
            padding-bottom: 8px;
            margin: 24px 0 18px;
        }
        .reg-card h5.section-title:first-child { margin-top: 0; }

        /* ── Username feedback ── */
        .field-feedback {
            font-size: 12px;
            margin-top: 3px;
            min-height: 16px;
        }
        .field-feedback.ok  { color: #28a745; }
        .field-feedback.err { color: #dc3545; }

        /* ── Password strength bar ── */
        .pass-strength { height: 4px; border-radius: 2px; margin-top: 4px; transition: all .3s; }

        /* ── SW License section ── */
        #sw-fields { display: none; }

        /* ── Nav buttons ── */
        .reg-nav { display: flex; justify-content: space-between; margin-top: 28px; }
        .reg-nav .btn { min-width: 110px; }

        /* ── Alert ── */
        .reg-alert { border-radius: 8px; font-size: 14px; margin-bottom: 0; }
    </style>
</head>

<body>
<div class="wrapper">

    <!-- ═══ Sidebar ═══ -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <img src="../images/logo.png" alt="dswd logo" width="100px" height="100px">
        </div>
        <ul class="list-unstyled components">
            <li><a href="home.php">Providers <i style="float:right;font-size:25px" class="fa fa-handshake"></i></a></li>
            <li><a href="OfficePage.php">Offices <i style="float:right;font-size:25px" class="fa fa-building"></i></a></li>
            <li class="active"><a href="Employee.php">Employees <i style="float:right;font-size:25px" class="fa fa-users"></i></a></li>
            <li><a href="SignatoryPage.php">Signatory List <i style="float:right;font-size:25px" class="fa fa-list"></i></a></li>
            <li><a href="GISassessment.php">GIS Assessment <i style="float:right;font-size:25px" class="fa fa-list"></i></a></li>
            <li><a href="fundsource.php">Fund Source <i style="float:right;font-size:25px" class="fa fa-list"></i></a></li>
            <li><a href="summarylist.php">Summary List <i style="float:right;font-size:25px" class="fa fa-list"></i></a></li>
            <li><a href="reissue_log.php">Re-issue Logs <i style="float:right;font-size:25px" class="fa fa-list"></i></a></li>
            <li><a href="cancelledGL_logs.php">Cancelled GL Logs <i style="float:right;font-size:25px" class="fa fa-list"></i></a></li>
        </ul>
    </nav>

    <!-- ═══ Main Content ═══ -->
    <div id="content">

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-blue">
            <div class="container-fluid">
                <button type="button" id="sidebarCollapse" class="navbar-btn">
                    <span></span><span></span><span></span>
                </button>
                <a class="nav-link toggle tohover" data-id="<?php echo $_SESSION['userId']; ?>"
                   data-target="#userAccount" style="margin-left:10px;"
                   data-toggle="modal" aria-haspopup="true" aria-expanded="false">
                    <?php $n = explode(' ', $_SESSION['userfullname']); echo strtoupper($n[0]); ?>
                </a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link tohover" data-toggle="modal" data-target="#logoutmodal">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Page heading -->
        <div class="container-fluid" style="padding: 20px 5%">
            <div style="display:flex; align-items:center; gap:12px; margin-bottom:4px;">
                <a href="Employee.php" class="btn btn-sm btn-outline-secondary">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
                <h4 style="margin:0; font-weight:700;">Register Employee Account</h4>
            </div>
            <p style="color:#888; margin-bottom:0; font-size:13px; padding-left:2px;">
                Complete both steps to create a new system account.
            </p>

            <!-- ── Alert Messages ── -->
            <?php if($error): ?>
            <div class="alert alert-danger reg-alert" style="margin-top:16px;">
                <i class="fa fa-exclamation-circle"></i> <?php echo $error; ?>
            </div>
            <?php endif; ?>
            <?php if($success): ?>
            <div class="alert alert-success reg-alert" style="margin-top:16px;">
                <i class="fa fa-check-circle"></i> <?php echo $success; ?>
                <a href="RegisterEmployee.php" class="btn btn-sm btn-success" style="float:right; margin-top:-4px;">
                    Register Another
                </a>
                <a href="Employee.php" class="btn btn-sm btn-outline-success" style="float:right; margin-top:-4px; margin-right:8px;">
                    Go to Employees
                </a>
            </div>
            <?php endif; ?>

            <!-- ════════════════════════════════════════════ -->
            <!--  Step Indicator                              -->
            <!-- ════════════════════════════════════════════ -->
            <div class="reg-steps" id="stepIndicator">
                <div class="reg-step">
                    <div class="step-circle active" id="circle1">1</div>
                    <div class="step-label active" id="label1">Account &amp; Details</div>
                </div>
                <div class="step-connector" id="connector1"></div>
                <div class="reg-step">
                    <div class="step-circle" id="circle2">2</div>
                    <div class="step-label" id="label2">Assignment</div>
                </div>
            </div>

            <!-- ════════════════════════════════════════════ -->
            <!--  THE FORM                                    -->
            <!-- ════════════════════════════════════════════ -->
            <form method="POST" action="RegisterEmployee.php" id="regForm" autocomplete="off">

                <!-- ══════════════════════════════════ -->
                <!--  STEP 1: Account & Details         -->
                <!-- ══════════════════════════════════ -->
                <div id="step1" class="reg-card">

                    <h5 class="section-title"><i class="fa fa-id-card"></i> &nbsp;Employee Information</h5>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Employee ID <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="empid" name="empid"
                                   value="<?php echo htmlspecialchars($_POST['empid'] ?? ''); ?>"
                                   placeholder="e.g. 11-0001" required>
                            <div class="field-feedback" id="empid-feedback"></div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Employee Number</label>
                            <input type="number" class="form-control" id="empnum" name="empnum"
                                   value="<?php echo htmlspecialchars($_POST['empnum'] ?? ''); ?>"
                                   placeholder="e.g. 1234">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Government Position</label>
                            <input type="text" class="form-control" id="emp_position" name="emp_position"
                                   value="<?php echo htmlspecialchars($_POST['emp_position'] ?? ''); ?>"
                                   placeholder="e.g. Social Welfare Officer II">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="emplname" name="emplname"
                                   value="<?php echo htmlspecialchars($_POST['emplname'] ?? ''); ?>"
                                   placeholder="Last Name" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="empfname" name="empfname"
                                   value="<?php echo htmlspecialchars($_POST['empfname'] ?? ''); ?>"
                                   placeholder="First Name" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Middle Name</label>
                            <input type="text" class="form-control" id="empmname" name="empmname"
                                   value="<?php echo htmlspecialchars($_POST['empmname'] ?? ''); ?>"
                                   placeholder="Middle Name">
                        </div>
                        <div class="form-group col-md-1">
                            <label>Ext.</label>
                            <input type="text" class="form-control" id="empext" name="empext"
                                   value="<?php echo htmlspecialchars($_POST['empext'] ?? ''); ?>"
                                   placeholder="Jr.">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Sex</label>
                            <select class="form-control" id="empsex" name="empsex">
                                <option value="">-- Select --</option>
                                <option value="Male"   <?php echo (($_POST['empsex'] ?? '') === 'Male'   ? 'selected' : ''); ?>>Male</option>
                                <option value="Female" <?php echo (($_POST['empsex'] ?? '') === 'Female' ? 'selected' : ''); ?>>Female</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Employment Status</label>
                            <select class="form-control" id="empstatus" name="empstatus">
                                <option value="">-- Select --</option>
                                <option value="Permanent"   <?php echo (($_POST['empstatus'] ?? '') === 'Permanent'   ? 'selected' : ''); ?>>Permanent</option>
                                <option value="Contractual" <?php echo (($_POST['empstatus'] ?? '') === 'Contractual' ? 'selected' : ''); ?>>Contractual</option>
                                <option value="COS"         <?php echo (($_POST['empstatus'] ?? '') === 'COS'         ? 'selected' : ''); ?>>Contract of Service</option>
                                <option value="JO"          <?php echo (($_POST['empstatus'] ?? '') === 'JO'          ? 'selected' : ''); ?>>Job Order</option>
                            </select>
                        </div>
                    </div>

                    <h5 class="section-title"><i class="fa fa-key"></i> &nbsp;Account Credentials</h5>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="empuser" name="empuser"
                                   value="<?php echo htmlspecialchars($_POST['empuser'] ?? ''); ?>"
                                   placeholder="Choose a username" required autocomplete="new-password">
                            <div class="field-feedback" id="username-feedback"></div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="emppass" name="emppass"
                                   placeholder="Password" required autocomplete="new-password">
                            <div class="pass-strength bg-secondary" id="passBar"></div>
                            <div class="field-feedback" id="pass-feedback"></div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Confirm Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="confirm_pass" name="confirm_pass"
                                   placeholder="Repeat password" required>
                            <div class="field-feedback" id="confirm-feedback"></div>
                        </div>
                    </div>

                    <!-- Step 1 → Next button -->
                    <div class="reg-nav">
                        <a href="Employee.php" class="btn btn-secondary">
                            <i class="fa fa-times"></i> Cancel
                        </a>
                        <button type="button" class="btn btn-primary" id="btnNext">
                            Next &nbsp;<i class="fa fa-arrow-right"></i>
                        </button>
                    </div>
                </div><!-- /step1 -->


                <!-- ══════════════════════════════════ -->
                <!--  STEP 2: Assignment                -->
                <!-- ══════════════════════════════════ -->
                <div id="step2" class="reg-card" style="display:none;">

                    <!-- Readonly summary of Step 1 -->
                    <div style="background:#f4f6fb; border-radius:8px; padding:12px 18px; margin-bottom:20px; font-size:13px; color:#555;">
                        <strong>Employee:</strong>
                        <span id="s2-name" style="font-weight:700; color:#222;"></span>
                        &nbsp;&bull;&nbsp;
                        <strong>ID:</strong> <span id="s2-empid"></span>
                        &nbsp;&bull;&nbsp;
                        <strong>Username:</strong> <span id="s2-user"></span>
                    </div>

                    <h5 class="section-title"><i class="fa fa-sitemap"></i> &nbsp;System Assignment</h5>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>System Role <span class="text-danger">*</span></label>
                            <select class="form-control" id="position" name="position" required>
                                <option value="">-- Select Role --</option>
                                <option value="Encoder"       <?php echo (($_POST['position'] ?? '') === 'Encoder'       ? 'selected' : ''); ?>>Encoder</option>
                                <option value="Social Worker" <?php echo (($_POST['position'] ?? '') === 'Social Worker' ? 'selected' : ''); ?>>Social Worker</option>
                                <option value="Admin"         <?php echo (($_POST['position'] ?? '') === 'Admin'         ? 'selected' : ''); ?>>Admin</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Office Assignment <span class="text-danger">*</span></label>
                            <select class="form-control" id="office_id" name="office_id" required>
                                <option value="">-- Select Office --</option>
                                <?php
                                    $offices = $user->optionoffice();
                                    foreach($offices as $off){
                                        $sel = (($_POST['office_id'] ?? '') === $off['office_id']) ? 'selected' : '';
                                        echo "<option value=\"{$off['office_id']}\" {$sel}>"
                                           . htmlspecialchars($off['office_name'])
                                           . "</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Account Status <span class="text-danger">*</span></label>
                            <select class="form-control" id="acc_status" name="acc_status" required>
                                <option value="">-- Select --</option>
                                <option value="Activated"   <?php echo (($_POST['acc_status'] ?? '') === 'Activated'   ? 'selected' : ''); ?>>Activated</option>
                                <option value="Deactivated" <?php echo (($_POST['acc_status'] ?? '') === 'Deactivated' ? 'selected' : ''); ?>>Deactivated</option>
                            </select>
                        </div>
                    </div>

                    <!-- SW License (visible only when Social Worker is selected) -->
                    <div id="sw-fields">
                        <h5 class="section-title"><i class="fa fa-id-badge"></i> &nbsp;Social Worker License</h5>
                        <div class="row">
                            <div class="form-group col-md-5">
                                <label>SW License Number</label>
                                <input type="text" class="form-control" id="sw_license_no" name="sw_license_no"
                                       value="<?php echo htmlspecialchars($_POST['sw_license_no'] ?? ''); ?>"
                                       placeholder="License No.">
                            </div>
                            <div class="form-group col-md-4">
                                <label>License Expiry Date</label>
                                <input type="date" class="form-control" id="sw_expiry" name="sw_expiry"
                                       value="<?php echo htmlspecialchars($_POST['sw_expiry'] ?? ''); ?>">
                            </div>
                        </div>
                    </div>

                    <!-- Step 2 navigation -->
                    <div class="reg-nav">
                        <button type="button" class="btn btn-secondary" id="btnBack">
                            <i class="fa fa-arrow-left"></i> &nbsp;Back
                        </button>
                        <button type="submit" class="btn btn-success" name="register" id="btnRegister">
                            <i class="fa fa-check"></i> &nbsp;Register Account
                        </button>
                    </div>
                </div><!-- /step2 -->

            </form>
        </div><!-- /container -->
    </div><!-- /content -->
</div><!-- /wrapper -->

<!-- ═══ User Account Modal ═══ -->
<div class="modal fade in" id="userAccount" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">User Account</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="useraccount"></div>
        </div>
    </div>
</div>

<!-- ═══ Logout Modal ═══ -->
<div class="modal hide fade" id="logoutmodal" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Logout <i class="fa fa-lock"></i></h4>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body"><i class="fa fa-question-circle"></i> Are you sure you want to log-out?</div>
            <div class="modal-footer"><a href="../php/logout.php" class="btn btn-primary btn-block">Logout</a></div>
        </div>
    </div>
</div>

<!-- ═══ Scripts ═══ -->
<script>
$(document).ready(function(){

    /* ── Sidebar toggle ── */
    $('#sidebar').toggleClass('active');
    $('#sidebarCollapse').toggleClass('active');
    $('#sidebarCollapse').on('click', function(){
        $('#sidebar').toggleClass('active');
        $(this).toggleClass('active');
    });

    /* ── User account modal ── */
    $('#userAccount').appendTo('body').on('show.bs.modal', function(e){
        var id = $(e.relatedTarget).data('id');
        $(this).find('.useraccount').load('adminuserAccount.php?id=' + id);
    });

    /* ══════════════════════════════════════════════
     * Employee ID lookup — prefill personal fields
     * ══════════════════════════════════════════════ */
    $('#empid').on('blur', function(){
        var empid = $.trim($(this).val());
        if(!empid) return;

        $('#empid-feedback').html('<span style="color:#888;"><i class="fa fa-spinner fa-spin"></i> Looking up...</span>');

        $.ajax({
            type: 'POST',
            url:  'lookup_employee.php',
            data: { empid: empid },
            dataType: 'json',
            success: function(res){
                if(res.status === 'not_found'){
                    $('#empid-feedback').html('').attr('class','field-feedback ok').text('New employee — fill in the details below.');
                } else if(res.status === 'has_account'){
                    $('#empid-feedback').attr('class','field-feedback err')
                        .html('<i class="fa fa-exclamation-triangle"></i> This employee already has a system account. You can still proceed to update it.');
                    fillFields(res);
                } else {
                    // exists, no account yet — prefill
                    $('#empid-feedback').attr('class','field-feedback ok')
                        .html('<i class="fa fa-check"></i> Employee found — personal details pre-filled.');
                    fillFields(res);
                }
            },
            error: function(){
                $('#empid-feedback').attr('class','field-feedback').text('');
            }
        });
    });

    function fillFields(res){
        if(res.empnum)        $('#empnum').val(res.empnum);
        if(res.emplname)      $('#emplname').val(res.emplname);
        if(res.empfname)      $('#empfname').val(res.empfname);
        if(res.empmname)      $('#empmname').val(res.empmname);
        if(res.empext)        $('#empext').val(res.empext);
        if(res.empsex)        $('#empsex').val(res.empsex);
        if(res.empstatus)     $('#empstatus').val(res.empstatus);
        if(res.emp_position)  $('#emp_position').val(res.emp_position);
        if(res.empuser)       $('#empuser').val(res.empuser);
    }

    /* ══════════════════════════════════════════════
     * Username availability check
     * ══════════════════════════════════════════════ */
    var usernameTimer;
    $('#empuser').on('input', function(){
        clearTimeout(usernameTimer);
        var val = $.trim($(this).val());
        if(val.length < 3){ $('#username-feedback').html('').attr('class','field-feedback'); return; }

        usernameTimer = setTimeout(function(){
            var empid = $.trim($('#empid').val());
            $.ajax({
                type:     'POST',
                url:      'check_username.php',
                data:     { empuser: val, empid: empid },
                dataType: 'json',
                success: function(res){
                    if(res.available){
                        $('#username-feedback').attr('class','field-feedback ok')
                            .html('<i class="fa fa-check"></i> Username is available.');
                    } else {
                        $('#username-feedback').attr('class','field-feedback err')
                            .html('<i class="fa fa-times"></i> Username is already taken.');
                    }
                }
            });
        }, 500);
    });

    /* ══════════════════════════════════════════════
     * Password strength & match
     * ══════════════════════════════════════════════ */
    $('#emppass').on('input', function(){
        var v = $(this).val(), s = 0;
        if(v.length >= 6)                    s++;
        if(v.length >= 10)                   s++;
        if(/[A-Z]/.test(v))                  s++;
        if(/[0-9]/.test(v))                  s++;
        if(/[^A-Za-z0-9]/.test(v))          s++;

        var colors = ['#dc3545','#fd7e14','#ffc107','#20c997','#28a745'];
        var labels = ['Very Weak','Weak','Fair','Strong','Very Strong'];
        var pct    = (s / 5) * 100;
        $('#passBar').css({ width: pct + '%', background: colors[s-1] || '#dee2e6' });
        if(v.length > 0){
            $('#pass-feedback').attr('class','field-feedback').css('color', colors[s-1] || '#888')
                .text(labels[s-1] || '');
        } else {
            $('#passBar').css({ width: '0%', background: '#dee2e6' });
            $('#pass-feedback').text('');
        }
        checkPassMatch();
    });

    $('#confirm_pass').on('input', checkPassMatch);

    function checkPassMatch(){
        var p = $('#emppass').val(), c = $('#confirm_pass').val();
        if(!c) { $('#confirm-feedback').text('').attr('class','field-feedback'); return; }
        if(p === c){
            $('#confirm-feedback').attr('class','field-feedback ok').html('<i class="fa fa-check"></i> Passwords match.');
        } else {
            $('#confirm-feedback').attr('class','field-feedback err').html('<i class="fa fa-times"></i> Passwords do not match.');
        }
    }

    /* ══════════════════════════════════════════════
     * SW License visibility
     * ══════════════════════════════════════════════ */
    $('#position').on('change', function(){
        if($(this).val() === 'Social Worker'){
            $('#sw-fields').slideDown(200);
        } else {
            $('#sw-fields').slideUp(200);
        }
    });
    // Restore on page reload after error
    if($('#position').val() === 'Social Worker') $('#sw-fields').show();

    /* ══════════════════════════════════════════════
     * Step navigation
     * ══════════════════════════════════════════════ */
    $('#btnNext').on('click', function(){
        // Validate Step 1 fields
        var ok = true;
        var required1 = ['empid','emplname','empfname','empuser','emppass','confirm_pass'];
        required1.forEach(function(fid){
            var el = $('#' + fid);
            if(!$.trim(el.val())){
                el.addClass('is-invalid').css('border-color','#dc3545');
                ok = false;
            } else {
                el.removeClass('is-invalid').css('border-color','');
            }
        });

        if(!ok){
            alert('Please fill in all required fields in Step 1 before proceeding.');
            return;
        }
        if($('#emppass').val() !== $('#confirm_pass').val()){
            alert('Passwords do not match.');
            return;
        }
        if($('#username-feedback').hasClass('err')){
            alert('The username you entered is already taken. Please choose a different one.');
            return;
        }

        // Update Step 2 summary bar
        var fname = $.trim($('#empfname').val());
        var lname = $.trim($('#emplname').val());
        $('#s2-name').text(lname + ', ' + fname);
        $('#s2-empid').text($('#empid').val());
        $('#s2-user').text($('#empuser').val());

        // Transition
        $('#step1').fadeOut(200, function(){
            $('#step2').fadeIn(200);
        });

        // Update indicator
        $('#circle1').removeClass('active').addClass('done').html('<i class="fa fa-check" style="font-size:14px;"></i>');
        $('#label1').removeClass('active');
        $('#connector1').addClass('done');
        $('#circle2').addClass('active');
        $('#label2').addClass('active');

        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    $('#btnBack').on('click', function(){
        $('#step2').fadeOut(200, function(){
            $('#step1').fadeIn(200);
        });

        // Revert indicator
        $('#circle1').addClass('active').removeClass('done').html('1');
        $('#label1').addClass('active');
        $('#connector1').removeClass('done');
        $('#circle2').removeClass('active');
        $('#label2').removeClass('active');

        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    /* ── Step 2 final validation ── */
    $('#btnRegister').on('click', function(){
        var ok = true;
        ['position','office_id','acc_status'].forEach(function(fid){
            var el = $('#' + fid);
            if(!el.val()){
                el.css('border-color','#dc3545');
                ok = false;
            } else {
                el.css('border-color','');
            }
        });
        if(!ok){
            alert('Please complete all required assignment fields before registering.');
            return false;
        }
    });

    /* ── Restore Step 2 on server-side error with step2 data ── */
    <?php if($error && !empty($_POST['position'])): ?>
    $('#step1').hide();
    $('#step2').show();
    $('#circle1').removeClass('active').addClass('done').html('<i class="fa fa-check" style="font-size:14px;"></i>');
    $('#connector1').addClass('done');
    $('#circle2').addClass('active');
    $('#label2').addClass('active');
    if($('#position').val() === 'Social Worker') $('#sw-fields').show();
    <?php endif; ?>

});
</script>

</body>
</html>
