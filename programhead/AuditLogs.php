<?php
require_once(__DIR__ . "/inc/guard.php");

// Program Head only sees audit logs for their own assigned office.
$phOffice = $_SESSION['f_office'] ?? '';

// empid -> full name lookup (accounts live in the hr_employee DB), plus the set
// of empids that belong to this Program Head's office.
$nameMap = [];
$officeEmpids = [];
$employees = $user->getallEmployee();
if ($employees) {
    while ($row = mysqli_fetch_assoc($employees)) {
        $nameMap[$row['empid']] = trim(
            ($row['emplname'] ?? '') . ', ' .
            ($row['empfname'] ?? '') . ' ' .
            ($row['empmname'] ?? '')
        );
        if (($row['office_id'] ?? '') === $phOffice && trim($row['position'] ?? '') !== '') {
            $officeEmpids[$row['empid']] = true;
        }
    }
}

$pageTitle = 'Audit Logs';
$active    = 'audit';
require_once(__DIR__ . "/inc/header.php");
?>
                <h4 style="margin:10px 0 20px;">Audit Logs</h4>
                <p style="color:#666;">Session events (login / logout) recorded for accounts in your office.</p>
                <div class="table-responsive-lg">
                    <table id="auditTable" class="table table-fixed table-striped table-hover highlight responsive-table" style="width:100%;">
                        <thead>
                            <tr>
                                <th>Date &amp; Time</th>
                                <th>Employee ID</th>
                                <th>Name</th>
                                <th>Action</th>
                                <th>IP Address</th>
                                <th>Hostname</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $logs = $user->getAuditLogs(500);
                            $hasRows = false;
                            if ($logs) {
                                while ($log = mysqli_fetch_assoc($logs)) {
                                    if (!isset($officeEmpids[$log['empid']])) {
                                        continue; // only accounts in this Program Head's office
                                    }
                                    $hasRows = true;
                                    $name   = $nameMap[$log['empid']] ?? '-';
                                    $action = ucfirst($log['action'] ?? '');
                                    $color  = ($log['action'] === 'login') ? '#27ab83' : '#e8833a';
                                    echo "<tr>
                                            <td>" . htmlspecialchars($log['created_at']) . "</td>
                                            <td>" . htmlspecialchars($log['empid']) . "</td>
                                            <td>" . htmlspecialchars($name) . "</td>
                                            <td><span class='badge' style='background:{$color};color:#fff;'>" . htmlspecialchars($action) . "</span></td>
                                            <td>" . htmlspecialchars($log['ip_address'] ?? '') . "</td>
                                            <td>" . htmlspecialchars($log['hostname'] ?? '') . "</td>
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
                    $(function(){ $("#auditTable").dataTable({ "order": [[0, "desc"]] }); });
                </script>
<?php require_once(__DIR__ . "/inc/footer.php"); ?>
