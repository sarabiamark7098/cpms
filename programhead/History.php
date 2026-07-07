<?php
require_once(__DIR__ . "/inc/guard.php");

// empid -> full name lookup
$nameMap = [];
$employees = $user->getallEmployee();
if ($employees) {
    while ($row = mysqli_fetch_assoc($employees)) {
        $nameMap[$row['empid']] = trim(
            ($row['emplname'] ?? '') . ', ' .
            ($row['empfname'] ?? '') . ' ' .
            ($row['empmname'] ?? '')
        );
    }
}

// office id -> readable name
$officeMap = [];
$offices = $user->optionoffice();
if ($offices) {
    while ($o = mysqli_fetch_assoc($offices)) {
        $officeMap[$o['office_id']] = $o['office_name'] ?? ($o['office_accronym'] ?? $o['office_id']);
    }
}

$pageTitle = 'History';
$active    = 'history';
require_once(__DIR__ . "/inc/header.php");
?>
                <h4 style="margin:10px 0 20px;">Login History</h4>
                <p style="color:#666;">Login / logout history across all accounts.</p>
                <div class="table-responsive-lg">
                    <table id="historyTable" class="table table-fixed table-striped table-hover highlight responsive-table" style="width:100%;">
                        <thead>
                            <tr>
                                <th>Employee ID</th>
                                <th>Name</th>
                                <th>Office</th>
                                <th>Login</th>
                                <th>Logout</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $history = $user->getLoginHistory(500);
                            $hasRows = false;
                            if ($history) {
                                while ($h = mysqli_fetch_assoc($history)) {
                                    $hasRows = true;
                                    $name   = $nameMap[$h['empid']] ?? '-';
                                    $office = $officeMap[$h['office_id']] ?? ($h['office_id'] ?? '-');
                                    $logout = !empty($h['logout_datetime'])
                                        ? htmlspecialchars($h['logout_datetime'])
                                        : "<span style='color:#e8833a;'>&mdash;</span>";
                                    echo "<tr>
                                            <td>" . htmlspecialchars($h['empid']) . "</td>
                                            <td>" . htmlspecialchars($name) . "</td>
                                            <td>" . htmlspecialchars($office) . "</td>
                                            <td>" . htmlspecialchars($h['login_datetime']) . "</td>
                                            <td>" . $logout . "</td>
                                          </tr>";
                                }
                            }
                            if (!$hasRows) {
                                echo "<tr><td colspan='5'>NO DATA</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <script>
                    $(function(){ $("#historyTable").dataTable({ "order": [[3, "desc"]] }); });
                </script>
<?php require_once(__DIR__ . "/inc/footer.php"); ?>
