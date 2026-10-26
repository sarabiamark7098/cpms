<?php
require_once(__DIR__ . "/inc/guard.php");

// Program Head only manages accounts within their own assigned office.
$phOffice = $_SESSION['f_office'] ?? '';

// ── Handle status change (activate / deactivate) ────────────────────────────
$flash = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['toggle_status'])) {
    $targetEmp    = $_POST['empid'] ?? '';
    $targetStatus = $_POST['new_status'] ?? '';
    $officeEmpids = $user->getOfficeEmpids($phOffice);
    if ($targetEmp === ($_SESSION['userId'] ?? '')) {
        $flash = "You cannot change your own account status.";
    } elseif ($targetEmp === '' || !in_array($targetEmp, $officeEmpids, true)) {
        $flash = "You can only manage accounts within your own office.";
    } elseif ($user->setAccountStatus($targetEmp, $targetStatus)) {
        $flash = "Account {$targetEmp} set to {$targetStatus}.";
    } else {
        $flash = "Unable to update account status.";
    }
}

// ── Handle role / office change (within this Program Head's office only) ─────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_role_office'])) {
    $targetEmp = $_POST['empid'] ?? '';
    $newPos    = $_POST['new_position'] ?? '';
    $newOff    = $_POST['new_office'] ?? '';
    $curStat   = $_POST['cur_status'] ?? 'Activated';
    $validPos  = ['Encoder','Social Worker','Admin','Program Head','Finance','Viewer'];
    $officeEmpids = $user->getOfficeEmpids($phOffice);
    if ($targetEmp === ($_SESSION['userId'] ?? '')) {
        $flash = "You cannot change your own role or office.";
    } elseif ($targetEmp === '' || !in_array($targetEmp, $officeEmpids, true)) {
        $flash = "You can only manage accounts within your own office.";
    } elseif (in_array($newPos, $validPos, true) && $newOff !== '' && $user->updateEmployee($targetEmp, $targetEmp, $newPos, $curStat, $newOff)) {
        $flash = "Account {$targetEmp} updated to {$newPos}.";
    } else {
        $flash = "Unable to update role/office.";
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

$pageTitle = 'Accounts Management';
$active    = 'accounts';
require_once(__DIR__ . "/inc/header.php");
?>
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
                                    if (($row['office_id'] ?? '') !== $phOffice) {
                                        continue; // only this Program Head's office
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
                                    // The Program Head cannot change their own status (self-lockout guard).
                                    if ($empid === ($_SESSION['userId'] ?? '')) {
                                        $action = "<span style='color:#888;'>-</span>";
                                    } else {
                                        $newStatus = $isActive ? 'Deactivated' : 'Activated';
                                        $btnClass  = $isActive ? 'btn-danger'  : 'btn-success';
                                        $btnLabel  = $isActive ? 'Deactivate'  : 'Activate';
                                        $confirmMsg = htmlspecialchars($btnLabel . ' account ' . $empid . '?', ENT_QUOTES);

                                        $editBtn = "<button type='button' class='btn btn-primary btn-sm editRoleOffice' style='margin-bottom:4px;'"
                                                . " data-empid='" . htmlspecialchars($empid, ENT_QUOTES) . "'"
                                                . " data-name=\"" . htmlspecialchars($fullname, ENT_QUOTES) . "\""
                                                . " data-position='" . htmlspecialchars($pos, ENT_QUOTES) . "'"
                                                . " data-officeid='" . htmlspecialchars($row['office_id'] ?? '', ENT_QUOTES) . "'"
                                                . " data-status='" . htmlspecialchars($status, ENT_QUOTES) . "'"
                                                . " data-toggle='modal' data-target='#editRoleOfficeModal'>Role / Office</button><br>";

                                        $action = $editBtn
                                                . "<form method='POST' style='margin:0;' onsubmit=\"return confirm('{$confirmMsg}');\">"
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
                <script>
                    $(function(){ $("#accountsTable").dataTable(); });
                </script>

    <!-- Update Role & Office modal -->
    <div class="modal hide fade" id="editRoleOfficeModal" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Role &amp; Office</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <p class="text-muted" style="margin-bottom:12px;">Account: <b id="ero-name"></b> (<span id="ero-empid-label"></span>)</p>
                        <input type="hidden" name="empid" id="ero-empid">
                        <input type="hidden" name="cur_status" id="ero-status">
                        <div class="form-group">
                            <label for="ero-position">Role</label>
                            <select name="new_position" id="ero-position" class="form-control" required>
                                <option value="Encoder">Encoder</option>
                                <option value="Social Worker">Social Worker</option>
                                <option value="Admin">Admin</option>
                                <option value="Program Head">Program Head</option>
                                <option value="Finance">Finance</option>
                                <option value="Viewer">Viewer</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="ero-office">Office</label>
                            <select name="new_office" id="ero-office" class="form-control" required>
                                <?php foreach ($officeMap as $oid => $oname) { echo "<option value='" . htmlspecialchars($oid, ENT_QUOTES) . "'>" . htmlspecialchars($oname) . "</option>"; } ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="update_role_office" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $('#editRoleOfficeModal').appendTo("body").on('show.bs.modal', function (event) {
            var b = $(event.relatedTarget);
            $('#ero-empid').val(b.data('empid'));
            $('#ero-empid-label').text(b.data('empid'));
            $('#ero-status').val(b.data('status'));
            $('#ero-name').text(b.data('name'));
            $('#ero-position').val(b.data('position'));
            $('#ero-office').val(String(b.data('officeid')));
        });
    </script>

<?php require_once(__DIR__ . "/inc/footer.php"); ?>
