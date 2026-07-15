<?php
require_once(__DIR__ . "/inc/guard.php"); // boots $user + session, enforces Program Head role

// The office this Program Head is assigned to (set at login).
$phOffice     = $_SESSION['f_office'] ?? '';
$phOfficeName = $phOffice !== '' ? ($user->get_office_name($phOffice) ?: $phOffice) : '';

/**
 * Leaderboard of social workers for TODAY, ranked by the number of 'Done'
 * transactions each catered — scoped to a single office ($onlyOfficeId).
 * Returns the same board shape used by the public dashboard, but restricted so
 * a Program Head only ever sees their own office's social workers.
 */
function buildOfficeBoards($user, $onlyOfficeId, $perOffice = 20) {
    if ($onlyOfficeId === '') {
        return [];
    }
    $counts = $user->getTransactionsCateredTodayPerSW(); // empid => catered count

    // office id -> readable name lookup
    $officeMap = [];
    $offices = $user->optionoffice();
    if ($offices) {
        while ($o = mysqli_fetch_assoc($offices)) {
            $officeMap[$o['office_id']] = $o['office_name'] ?? ($o['office_accronym'] ?? $o['office_id']);
        }
    }

    $byOffice = [];
    $employees = $user->getallEmployee();
    if ($employees) {
        while ($e = mysqli_fetch_assoc($employees)) {
            if (trim($e['position'] ?? '') !== 'Social Worker') {
                continue; // only social workers
            }
            if (($e['office_id'] ?? '') !== $onlyOfficeId) {
                continue; // only this Program Head's office
            }
            $empid   = $e['empid'];
            $catered = $counts[$empid] ?? 0;
            if ($catered <= 0) {
                continue; // only those who served clients today
            }
            $office = $officeMap[$e['office_id']] ?? ($e['office_id'] ?? 'Unassigned');
            $name = strtoupper(trim(
                ($e['empfname'] ?? '') . ' ' .
                (!empty($e['empmname']) ? $e['empmname'][0] . '. ' : '') .
                ($e['emplname'] ?? '') . ' ' .
                ($e['empext'] ?? '')
            ));
            if (!isset($byOffice[$office])) {
                $byOffice[$office] = ['office' => $office, 'total' => 0, 'rows' => []];
            }
            $byOffice[$office]['total'] += $catered;
            $byOffice[$office]['rows'][] = ['empid' => $empid, 'name' => $name, 'catered' => $catered];
        }
    }

    foreach ($byOffice as &$o) {
        usort($o['rows'], function ($a, $b) { return $b['catered'] - $a['catered']; });
        $o['rows'] = array_slice($o['rows'], 0, $perOffice);
    }
    unset($o);

    $boards = array_values($byOffice);
    usort($boards, function ($a, $b) { return $b['total'] - $a['total']; });

    return $boards;
}

$boards = buildOfficeBoards($user, $phOffice, 20);

// AJAX endpoint: return the current board as JSON so the page can refresh
// itself without reloading (reactive to newly served clients).
if (isset($_GET['data'])) {
    header('Content-Type: application/json');
    echo json_encode([
        'as_of'   => date('F j, Y'),
        'time'    => date('g:i:s A'),
        'offices' => $boards,
    ]);
    exit;
}

$pageTitle = 'Dashboard';
$active    = 'dashboardsw';
require_once(__DIR__ . "/inc/header.php");
?>
                <style>
                    /* Scoped so the leaderboard's dark theme stays inside its panel
                       and does not affect the rest of the Program Head area. */
                    .tsw-panel {
                        background: radial-gradient(circle at 20% 0%, #7b2ff7 0%, #4a1e9e 45%, #2a0d5e 100%);
                        border-radius: 18px; color: #fff;
                        padding: 26px 20px 30px; margin: 10px 0 20px;
                        box-shadow: 0 6px 20px rgba(0,0,0,0.18);
                    }
                    .tsw-panel .tsw-head { text-align: center; margin-bottom: 24px; }
                    .tsw-panel .tsw-head h3 {
                        font-size: 26px; font-weight: 800; margin: 0 0 8px;
                        text-shadow: 0 2px 12px rgba(0,0,0,.35);
                    }
                    .tsw-panel .tsw-head .as-of {
                        display: inline-block; font-size: 13px; font-weight: 600;
                        background: rgba(255,255,255,.14); padding: 5px 14px; border-radius: 20px;
                    }
                    .tsw-panel .as-of #liveDot {
                        display: inline-block; width: 8px; height: 8px; border-radius: 50%;
                        background: #4ade80; margin-right: 7px; vertical-align: middle;
                        box-shadow: 0 0 0 0 rgba(74,222,128,.7); animation: tswpulse 1.8s infinite;
                    }
                    @keyframes tswpulse {
                        0%   { box-shadow: 0 0 0 0 rgba(74,222,128,.6); }
                        70%  { box-shadow: 0 0 0 8px rgba(74,222,128,0); }
                        100% { box-shadow: 0 0 0 0 rgba(74,222,128,0); }
                    }
                    .tsw-panel .boards {
                        display: flex; gap: 16px; justify-content: center;
                        flex-wrap: wrap; align-items: flex-start;
                    }
                    .tsw-panel .office-col {
                        flex: 1 1 100%; max-width: 100%; width: 100%;
                        background: rgba(255,255,255,.08);
                        border: 1px solid rgba(255,255,255,.12);
                        border-radius: 18px; padding: 16px 18px 10px;
                    }
                    /* Flexible columns for the ranking: up to 3, down to 1 as the
                       viewport narrows (each column is at least 260px wide). */
                    .tsw-panel .office-rows {
                        columns: 3 260px;
                        column-gap: 16px;
                    }
                    .tsw-panel .office-head {
                        display: flex; align-items: baseline; justify-content: space-between;
                        gap: 8px; padding: 2px 4px 12px; border-bottom: 1px solid rgba(255,255,255,.14);
                        margin-bottom: 12px;
                    }
                    .tsw-panel .office-head .office-name { font-size: 16px; font-weight: 800; text-transform: uppercase; line-height: 1.2; }
                    .tsw-panel .office-head .office-total { flex: 0 0 auto; font-size: 12px; font-weight: 700; letter-spacing: .5px; color: #dcc6ff; white-space: nowrap; }
                    .tsw-panel .rank-row {
                        display: flex; align-items: center; gap: 10px;
                        background: rgba(255,255,255,.06);
                        border-radius: 40px; padding: 8px 14px 8px 8px; margin-bottom: 9px;
                        transition: background .35s ease;
                        break-inside: avoid; -webkit-column-break-inside: avoid;
                    }
                    .tsw-panel .rank-row.top1 { background: linear-gradient(90deg, rgba(255,215,0,.30), rgba(255,255,255,.05)); }
                    .tsw-panel .rank-row.top2 { background: linear-gradient(90deg, rgba(220,220,230,.26), rgba(255,255,255,.05)); }
                    .tsw-panel .rank-row.top3 { background: linear-gradient(90deg, rgba(205,127,50,.26), rgba(255,255,255,.05)); }
                    .tsw-panel .rank-badge { position: relative; flex: 0 0 42px; height: 42px; display: flex; align-items: center; justify-content: center; }
                    .tsw-panel .rank-badge svg { position: absolute; width: 42px; height: 42px; }
                    .tsw-panel .rank-badge span { position: relative; font-size: 17px; font-weight: 800; color: #fff; text-shadow: 0 1px 4px rgba(0,0,0,.4); }
                    .tsw-panel .rank-info { flex: 1 1 auto; min-width: 0; }
                    .tsw-panel .rank-info .name { font-size: 15px; font-weight: 700; text-transform: uppercase; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
                    .tsw-panel .rank-info .empid { font-size: 11.5px; color: #cdb6ff; font-weight: 600; }
                    .tsw-panel .rank-count { flex: 0 0 auto; text-align: center; padding-left: 4px; }
                    .tsw-panel .rank-count .num { font-size: 22px; font-weight: 800; line-height: 1; }
                    .tsw-panel .rank-count .lbl { font-size: 9px; letter-spacing: .5px; text-transform: uppercase; color: #dcc6ff; font-weight: 700; }
                    .tsw-panel .empty-state { text-align: center; padding: 44px 20px; font-size: 15px; background: rgba(255,255,255,.08); border-radius: 20px; color: #e9d9ff; width: 100%; }
                </style>

                <h4 style="margin:10px 0 4px;">Dashboard</h4>
                <p style="color:#666;margin:0 0 14px;">
                    <strong><?php echo htmlspecialchars($phOfficeName !== '' ? $phOfficeName : 'your office'); ?></strong>,
                    ranked by clients served today.
                </p>

                <div class="tsw-panel">
                    <div class="tsw-head">
                        <h3><?php echo htmlspecialchars($phOfficeName !== '' ? $phOfficeName : 'Your Office'); ?></h3>
                        <div class="as-of">
                            <span id="liveDot"></span>
                            As of <span id="asOf"><?php echo date('F j, Y'); ?></span> &middot; updates live
                        </div>
                    </div>
                    <div id="boards" class="boards"><!-- populated by PHP + refreshed via JS --></div>
                </div>

                <script>
                    function tswBadge(rank) {
                        var fill = '#7c4dff';
                        if (rank === 1) fill = '#ffce3a';
                        else if (rank === 2) fill = '#cfd4e0';
                        else if (rank === 3) fill = '#e08b3a';
                        return '<div class="rank-badge">' +
                            '<svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" fill="' + fill + '" /></svg>' +
                            '<span>' + rank + '</span></div>';
                    }
                    function tswEscape(s) {
                        return String(s == null ? '' : s).replace(/[&<>"']/g, function (c) {
                            return { '&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;' }[c];
                        });
                    }
                    function tswRankRow(r, i) {
                        var rank = i + 1;
                        var topCls = rank <= 3 ? ' top' + rank : '';
                        return '<div class="rank-row' + topCls + '">' +
                            tswBadge(rank) +
                            '<div class="rank-info">' +
                                '<div class="name">' + tswEscape(r.name) + '</div>' +
                                '<div class="empid">' + tswEscape(r.empid) + '</div>' +
                            '</div>' +
                            '<div class="rank-count">' +
                                '<div class="num">' + Number(r.catered).toLocaleString() + '</div>' +
                                '<div class="lbl">Txns</div>' +
                            '</div>' +
                        '</div>';
                    }
                    function tswRender(offices) {
                        var wrap = document.getElementById('boards');
                        if (!offices || offices.length === 0) {
                            wrap.innerHTML = '<div class="empty-state">No social worker in your office has ' +
                                'catered a completed transaction yet today. Check back soon.</div>';
                            return;
                        }
                        var html = '';
                        offices.forEach(function (o) {
                            html += '<div class="office-col">' +
                                '<div class="office-head">' +
                                    '<div class="office-name">' + tswEscape(o.office) + '</div>' +
                                    '<div class="office-total">' + Number(o.total).toLocaleString() + ' served</div>' +
                                '</div>' +
                                '<div class="office-rows">' + o.rows.map(tswRankRow).join('') + '</div>' +
                            '</div>';
                        });
                        wrap.innerHTML = html;
                    }

                    // Initial paint from PHP-rendered data (no flash of empty content)
                    tswRender(<?php echo json_encode(array_values($boards)); ?>);

                    // Reactive refresh: re-fetch scoped to this office
                    function tswRefresh() {
                        fetch('Dashboard.php?data=1&_=' + Date.now(), { cache: 'no-store' })
                            .then(function (res) { return res.json(); })
                            .then(function (data) {
                                tswRender(data.offices);
                                document.getElementById('asOf').textContent = data.as_of;
                            })
                            .catch(function () { /* keep last good render on transient errors */ });
                    }
                    setInterval(tswRefresh, 15000); // poll every 15s
                </script>
<?php require_once(__DIR__ . "/inc/footer.php"); ?>
