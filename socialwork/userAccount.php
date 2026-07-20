<?php
include('../php/class.user.php');
$user = new User();

if (!$_SESSION['login']) {
    header('Location: ../index.php');
    exit;
}

$userid  = $_GET['id'] ?? $_SESSION['userId'];
$getuser = $user->show_user_data($userid);
$fullname = strtoupper($getuser['empfname'] . ' ' . $getuser['empmname'][0] . ' ' . $getuser['emplname']);

$initials = '';
if (!empty($getuser['empfname'])) {
    $firstname = explode(' ', $getuser['empfname']);
    if (!empty($firstname[2])) {
        $initials = strtoupper($firstname[0][0] . $firstname[1][0] . $firstname[2][0]);
    } elseif (!empty($firstname[1])) {
        $initials = strtoupper($firstname[0][0] . $firstname[1][0]);
    } else {
        $initials = strtoupper($firstname[0][0]);
    }
}
if (!empty($getuser['empmname'])) {
    $middlename = explode(' ', $getuser['empmname']);
    if (!empty($middlename[0])) {
        $initials .= strtoupper($middlename[0][0]);
    }
}
if (!empty($getuser['emplname'])) {
    $lastname = explode(' ', $getuser['emplname']);
    if (!empty($lastname[2])) {
        $initials .= strtoupper($lastname[0][0] . $lastname[1][0] . $lastname[2][0]);
    } elseif (!empty($lastname[1])) {
        $initials .= strtoupper($lastname[0][0] . $lastname[1][0]);
    } else {
        $initials .= strtoupper($lastname[0][0]);
    }
}

$hasPending = $user->validateid($getuser['empnum']);
?>
<!DOCTYPE html>
<html>
<body>
    <div class="modal-body">
        <div class="row form-group">
            <div class="col-sm-9">
                <img class="responsive-img" src="../images/no_avatar.gif" style="width: 40%; border-radius: 50%; margin-left: 45%;">
            </div>
        </div>
        <div class="row" style="margin-top: 2%;">
            <div class="form-group col-lg-8">
                <input value="<?php echo htmlspecialchars($fullname); ?>" type="text" class="form-control" readonly>
                <label class="active">Fullname</label>
            </div>
            <div class="form-group col-lg-4">
                <input value="<?php echo htmlspecialchars($getuser['empid']); ?>" type="text" class="form-control" readonly>
                <label class="active">User ID</label>
            </div>
        </div>
        <div class="row" style="margin-top: 2%;">
            <div class="form-group col-lg-2"></div>
            <div class="form-group col-lg-8">
                <input value="<?php echo htmlspecialchars($getuser['position']); ?>" type="text" class="form-control" readonly>
                <label class="active">Position</label>
            </div>
            <div class="form-group col-lg-2"></div>
        </div>
        <div class="row" style="margin-top: 2%;">
            <div class="form-group col-lg-2"></div>
            <div class="form-group col-lg-8">
                <input value="<?php echo htmlspecialchars($user->get_office_name($getuser['office_id'])); ?>" type="text" class="form-control" readonly>
                <label class="active">Office Designated</label>
            </div>
            <div class="form-group col-lg-2"></div>
        </div>

        <hr>
        <h6 style="text-align:center; font-weight:bold;">Request Designation Change</h6>

        <?php if ($hasPending): ?>
        <div class="alert alert-warning" style="margin:10px 0; font-size:13px;">
            <i class="fa fa-clock-o"></i> You have a <strong>pending request</strong> awaiting Admin approval.
        </div>
        <?php else: ?>
        <form action="../php/request_change.php" method="POST">
            <div class="row" style="margin-top:10px;">
                <div class="form-group col-lg-6">
                    <select name="designation" class="form-control" required>
                        <option value="">Select Position</option>
                        <option value="Encoder" <?php echo ($getuser['position'] == 'Encoder' ? 'selected' : ''); ?>>Encoder</option>
                        <option value="Social Worker" <?php echo ($getuser['position'] == 'Social Worker' ? 'selected' : ''); ?>>Social Worker</option>
                    </select>
                    <label class="active">New Position</label>
                </div>
                <div class="form-group col-lg-6">
                    <select name="office" class="form-control" required>
                        <option value="">Select Office</option>
                        <?php
                        $getoffice = $user->optionoffice();
                        foreach ($getoffice as $value) {
                            $sel = ($getuser['office_id'] == $value['office_id']) ? 'selected' : '';
                            echo '<option value="' . htmlspecialchars($value['office_id']) . '" ' . $sel . '>' . htmlspecialchars($value['office_name']) . '</option>';
                        }
                        ?>
                    </select>
                    <label class="active">New Office</label>
                </div>
            </div>
            <div class="modal-footer" style="padding:10px 0 0;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit Request</button>
            </div>
        </form>
        <?php endif; ?>
    </div>
</body>
</html>
