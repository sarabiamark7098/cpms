<?php
require_once(__DIR__ . "/inc/guard.php");

// ── Gather dashboard figures ────────────────────────────────────────────────
$roleCounts = [
    'Admin'         => 0,
    'Program Head'  => 0,
    'Social Worker' => 0,
    'Encoder'       => 0,
];
$totalAccounts = 0;
$activatedCount = 0;

$employees = $user->getallEmployee();
if ($employees) {
    while ($row = mysqli_fetch_assoc($employees)) {
        $pos = trim($row['position'] ?? '');
        if ($pos === '') {
            continue; // employee without a provisioned CPMS account
        }
        $totalAccounts++;
        if (isset($roleCounts[$pos])) {
            $roleCounts[$pos]++;
        }
        if (($row['status'] ?? '') === 'Activated') {
            $activatedCount++;
        }
    }
}

$activeSessions = $user->getActiveSessionCount();
$todayLogins    = $user->getTodayLoginCount();

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
                            <i class="fa fa-sign-in"></i>
                            <div class="ph-num"><?php echo $todayLogins; ?></div>
                            <div class="ph-label">Logins Today</div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive-lg" style="max-width:520px;margin-top:15px;">
                    <h5>Accounts by Role</h5>
                    <table class="table table-striped table-hover" style="width:100%;">
                        <thead>
                            <tr><th>Role</th><th style="width:30%">Count</th></tr>
                        </thead>
                        <tbody>
                            <?php foreach ($roleCounts as $role => $count): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($role); ?></td>
                                <td><?php echo $count; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
<?php require_once(__DIR__ . "/inc/footer.php"); ?>
