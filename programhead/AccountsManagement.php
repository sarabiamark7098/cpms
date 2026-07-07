<?php
require_once(__DIR__ . "/inc/guard.php");

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
                <script>
                    $(function(){ $("#accountsTable").dataTable(); });
                </script>
<?php require_once(__DIR__ . "/inc/footer.php"); ?>
