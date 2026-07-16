<?php
require_once(__DIR__ . "/inc/guard.php");

// Program Head only sees data for their own assigned office.
$phOffice = $_SESSION['f_office'] ?? '';

// ── Gather dashboard figures ────────────────────────────────────────────────
$roleCounts = [
    'Admin'         => 0,
    'Program Head'  => 0,
    'Social Worker' => 0,
    'Encoder'       => 0,
];
$totalAccounts = 0;
$activatedCount = 0;
$officeEmpids = [];

$employees = $user->getallEmployee();
if ($employees) {
    while ($row = mysqli_fetch_assoc($employees)) {
        $pos = trim($row['position'] ?? '');
        if ($pos === '') {
            continue; // employee without a provisioned CPMS account
        }
        if (($row['office_id'] ?? '') !== $phOffice) {
            continue; // only this Program Head's office
        }
        $officeEmpids[] = $row['empid'];
        $totalAccounts++;
        if (isset($roleCounts[$pos])) {
            $roleCounts[$pos]++;
        }
        if (($row['status'] ?? '') === 'Activated') {
            $activatedCount++;
        }
    }
}

$activeSessions = $user->getActiveSessionCountForEmpids($officeEmpids);
$todayLogins    = $user->getTodayLoginCountByOffice($phOffice);

// ── Clients served per user (with office) ───────────────────────────────────
$servedCounts = $user->getClientsServedPerUser();

// Office id -> readable name lookup
$officeMap = [];
$offices = $user->optionoffice();
if ($offices) {
    while ($o = mysqli_fetch_assoc($offices)) {
        $officeMap[$o['office_id']] = $o['office_name'] ?? ($o['office_accronym'] ?? $o['office_id']);
    }
}

// Build one row per provisioned user of the system
$emptyBuckets = ['today'=>0,'yesterday'=>0,'last3'=>0,'week'=>0,'month'=>0,'year'=>0];
$servedRows = [];
$employees2 = $user->getallEmployee();
if ($employees2) {
    while ($row = mysqli_fetch_assoc($employees2)) {
        $pos = trim($row['position'] ?? '');
        if ($pos === '') {
            continue; // only users with a CPMS account
        }
        if (($row['office_id'] ?? '') !== $phOffice) {
            continue; // only this Program Head's office
        }
        if ($pos !== 'Social Worker' && $pos !== 'Encoder') {
            continue; // exclude Program Head / Admin roles
        }
        if (($row['status'] ?? '') !== 'Activated') {
            continue; // only activated accounts
        }
        $empid = $row['empid'];
        $servedRows[] = [
            'empid'   => $empid,
            'name'    => trim(($row['emplname'] ?? '') . ', ' . ($row['empfname'] ?? '') . ' ' . ($row['empmname'] ?? '') . ' ' . ($row['empext'] ?? '')),
            'role'    => $pos,
            'office'  => $officeMap[$row['office_id']] ?? ($row['office_id'] ?? '-'),
            'periods' => $servedCounts[$empid] ?? $emptyBuckets,
        ];
    }
}
// Sort by clients served this year, highest first
usort($servedRows, function ($a, $b) { return $b['periods']['year'] - $a['periods']['year']; });

// Distinct office list for the filter dropdown
$officeFilterList = array_values(array_unique(array_map(function ($r) { return $r['office']; }, $servedRows)));
sort($officeFilterList);

// Distinct role list for the filter dropdown
$roleFilterList = array_values(array_unique(array_map(function ($r) { return $r['role']; }, $servedRows)));
sort($roleFilterList);

$pageTitle = 'Dashboard';
$active    = 'dashboard';
require_once(__DIR__ . "/inc/header.php");
?>
                <h4 style="margin:10px 0 20px;">Dashboard</h4>

                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="ph-card" style="background:#2c7be5;">
                            <i class="fa fa-users"></i>
                            <div class="ph-num"><?php echo $totalAccounts; ?></div>
                            <div class="ph-label">Total Accounts</div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="ph-card" style="background:#27ab83;">
                            <i class="fa fa-check-circle"></i>
                            <div class="ph-num"><?php echo $activatedCount; ?></div>
                            <div class="ph-label">Activated Accounts</div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="ph-card" style="background:#e8833a;">
                            <i class="fa fa-signal"></i>
                            <div class="ph-num"><?php echo $activeSessions; ?></div>
                            <div class="ph-label">Active Sessions</div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="ph-card" style="background:#6b5eae;">
                            <i class="fa fa-user"></i>
                            <div class="ph-num"><?php echo $todayLogins; ?></div>
                            <div class="ph-label">Logins Today</div>
                        </div>
                    </div>
                </div>

                <div style="margin-top:10px;">
                    <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;margin-bottom:12px;">
                        <h5 style="margin:0;">Clients Served per User</h5>
                        <div>
                            <label for="roleFilter" style="margin-right:6px;font-weight:600;">Filter by Role:</label>
                            <select id="roleFilter" class="form-control" style="display:inline-block;width:auto;min-width:160px;">
                                <option value="">All Roles</option>
                                <?php foreach ($roleFilterList as $rl): ?>
                                <option value="<?php echo htmlspecialchars($rl, ENT_QUOTES); ?>"><?php echo htmlspecialchars($rl); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="table-responsive-lg">
                        <table id="servedTable" class="table table-fixed table-striped table-hover highlight responsive-table" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Employee ID</th>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Office</th>
                                    <th>Today</th>
                                    <th>Yesterday</th>
                                    <th>Last 3 Days</th>
                                    <th>This Week</th>
                                    <th>This Month</th>
                                    <th>This Year</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($servedRows)): ?>
                                <tr><td colspan="10">NO DATA</td></tr>
                                <?php else: foreach ($servedRows as $r): $p = $r['periods']; ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($r['empid']); ?></td>
                                    <td><?php echo htmlspecialchars($r['name']); ?></td>
                                    <td><?php echo htmlspecialchars($r['role']); ?></td>
                                    <td><?php echo htmlspecialchars($r['office']); ?></td>
                                    <td><?php echo number_format($p['today']); ?></td>
                                    <td><?php echo number_format($p['yesterday']); ?></td>
                                    <td><?php echo number_format($p['last3']); ?></td>
                                    <td><?php echo number_format($p['week']); ?></td>
                                    <td><?php echo number_format($p['month']); ?></td>
                                    <td><?php echo number_format($p['year']); ?></td>
                                </tr>
                                <?php endforeach; endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <script>
                    $(function () {
                        var table = $('#servedTable').dataTable();
                        // Role column is index 2, Office column is index 3; filter via dropdowns
                        $('#roleFilter').on('change', function () {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());
                            $('#servedTable').DataTable().column(2).search(val ? '^' + val + '$' : '', true, false).draw();
                        });
                    });
                </script>
<?php require_once(__DIR__ . "/inc/footer.php"); ?>
