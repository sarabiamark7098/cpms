<?php
	require(__DIR__ . '/php/class.user.php');

	$user = new User();

	/**
	 * Build one leaderboard per office for TODAY, based on the number of 'Done'
	 * transactions each social worker catered. Returns an ordered array of
	 * boards (busiest office first):
	 *   [ ['office'=>name, 'total'=>int, 'rows'=>[ ['empid','name','catered'], ... ]], ... ]
	 * Only "Social Worker" accounts with at least one catered transaction today
	 * appear, and each office column is capped at $perOffice entries.
	 */
	function buildOfficeBoards($user, $perOffice = 10) {
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

		// Rank within each office, cap the column, then order offices by volume
		foreach ($byOffice as &$o) {
			usort($o['rows'], function ($a, $b) { return $b['catered'] - $a['catered']; });
			$o['rows'] = array_slice($o['rows'], 0, $perOffice);
		}
		unset($o);

		$boards = array_values($byOffice);
		usort($boards, function ($a, $b) { return $b['total'] - $a['total']; });

		return $boards;
	}

	$boards = buildOfficeBoards($user, 10);

	// AJAX endpoint: return the current per-office boards as JSON so the page can
	// refresh itself without reloading (reactive to newly served clients).
	if (isset($_GET['data'])) {
		header('Content-Type: application/json');
		echo json_encode([
			'as_of'   => date('F j, Y'),
			'time'    => date('g:i:s A'),
			'offices' => $boards,
		]);
		exit;
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Top Social Workers of the Day</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
	<style>
		* { box-sizing: border-box; margin: 0; padding: 0; }
		body {
			font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
			background: radial-gradient(circle at 20% 0%, #7b2ff7 0%, #4a1e9e 45%, #2a0d5e 100%);
			min-height: 100vh;
			color: #fff;
			padding: 30px 16px 60px;
		}
		.dash-wrap { max-width: 1280px; margin: 0 auto; }
		.dash-header { text-align: center; margin-bottom: 26px; }
		.dash-header .kicker {
			letter-spacing: 3px; font-size: 13px; font-weight: 700;
			color: #e9c6ff; text-transform: uppercase;
		}
		.dash-header h1 {
			font-size: 34px; font-weight: 800; line-height: 1.1; margin: 6px 0 8px;
			text-shadow: 0 2px 14px rgba(0,0,0,.35);
		}
		.dash-header .as-of {
			display: inline-block; font-size: 13px; font-weight: 600;
			background: rgba(255,255,255,.14); padding: 5px 14px; border-radius: 20px;
		}
		.dash-header .as-of #liveDot {
			display: inline-block; width: 8px; height: 8px; border-radius: 50%;
			background: #4ade80; margin-right: 7px; vertical-align: middle;
			box-shadow: 0 0 0 0 rgba(74,222,128,.7); animation: pulse 1.8s infinite;
		}
		@keyframes pulse {
			0%   { box-shadow: 0 0 0 0 rgba(74,222,128,.6); }
			70%  { box-shadow: 0 0 0 8px rgba(74,222,128,0); }
			100% { box-shadow: 0 0 0 0 rgba(74,222,128,0); }
		}

		/* Horizontal row of per-office columns */
		.boards {
			display: flex; gap: 16px; overflow-x: auto;
			padding-bottom: 14px; align-items: flex-start;
			scrollbar-color: rgba(255,255,255,.4) transparent;
		}
		.boards::-webkit-scrollbar { height: 9px; }
		.boards::-webkit-scrollbar-thumb { background: rgba(255,255,255,.35); border-radius: 6px; }
		.office-col {
			flex: 0 0 300px; max-width: 300px;
			background: rgba(255,255,255,.08);
			border: 1px solid rgba(255,255,255,.12);
			border-radius: 18px; padding: 14px 14px 8px;
			backdrop-filter: blur(4px);
		}
		.office-head {
			display: flex; align-items: baseline; justify-content: space-between;
			gap: 8px; padding: 2px 4px 12px; border-bottom: 1px solid rgba(255,255,255,.14);
			margin-bottom: 12px;
		}
		.office-head .office-name {
			font-size: 15px; font-weight: 800; text-transform: uppercase; line-height: 1.2;
		}
		.office-head .office-total {
			flex: 0 0 auto; font-size: 11px; font-weight: 700; letter-spacing: .5px;
			color: #dcc6ff; white-space: nowrap;
		}

		.rank-row {
			display: flex; align-items: center; gap: 10px;
			background: rgba(255,255,255,.06);
			border-radius: 40px; padding: 7px 12px 7px 7px; margin-bottom: 9px;
			transition: background .35s ease;
		}
		.rank-row.top1 { background: linear-gradient(90deg, rgba(255,215,0,.30), rgba(255,255,255,.05)); }
		.rank-row.top2 { background: linear-gradient(90deg, rgba(220,220,230,.26), rgba(255,255,255,.05)); }
		.rank-row.top3 { background: linear-gradient(90deg, rgba(205,127,50,.26), rgba(255,255,255,.05)); }
		.rank-badge {
			position: relative; flex: 0 0 40px; height: 40px;
			display: flex; align-items: center; justify-content: center;
		}
		.rank-badge svg { position: absolute; width: 40px; height: 40px; }
		.rank-badge span {
			position: relative; font-size: 16px; font-weight: 800; color: #fff;
			text-shadow: 0 1px 4px rgba(0,0,0,.4);
		}
		.rank-info { flex: 1 1 auto; min-width: 0; }
		.rank-info .name {
			font-size: 14px; font-weight: 700; text-transform: uppercase;
			white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
		}
		.rank-info .empid { font-size: 11px; color: #cdb6ff; font-weight: 600; }
		.rank-count { flex: 0 0 auto; text-align: center; padding-left: 4px; }
		.rank-count .num { font-size: 20px; font-weight: 800; line-height: 1; }
		.rank-count .lbl {
			font-size: 9px; letter-spacing: .5px; text-transform: uppercase;
			color: #dcc6ff; font-weight: 700;
		}

		.empty-state {
			text-align: center; padding: 50px 20px; font-size: 16px;
			background: rgba(255,255,255,.08); border-radius: 20px; color: #e9d9ff;
		}
		.back-link {
			display: block; text-align: center; margin-top: 26px;
			color: #e9c6ff; font-weight: 600; text-decoration: none; font-size: 14px;
		}
		.back-link:hover { text-decoration: underline; color: #fff; }
	</style>
</head>
<body>
	<div class="dash-wrap">
		<div class="dash-header">
			<div class="kicker">CIU Processing &amp; Monitoring System</div>
			<h1>Top Social Workers of the Day</h1>
			<div class="as-of">
				<span id="liveDot"></span>
				As of <span id="asOf"><?php echo date('F j, Y'); ?></span>
				&middot; per office, ranked by clients served
			</div>
		</div>

		<div id="boards" class="boards"><!-- populated by PHP + refreshed via JS --></div>

		<a class="back-link" href="index.php">&larr; Back to Login</a>
	</div>

	<script>
		// Trophy/star badge coloured by rank
		function badge(rank) {
			var fill = '#7c4dff';
			if (rank === 1) fill = '#ffce3a';
			else if (rank === 2) fill = '#cfd4e0';
			else if (rank === 3) fill = '#e08b3a';
			return '<div class="rank-badge">' +
				'<svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" fill="' + fill + '" /></svg>' +
				'<span>' + rank + '</span></div>';
		}

		function escapeHtml(s) {
			return String(s == null ? '' : s).replace(/[&<>"']/g, function (c) {
				return { '&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;' }[c];
			});
		}

		function rankRow(r, i) {
			var rank = i + 1;
			var topCls = rank <= 3 ? ' top' + rank : '';
			return '<div class="rank-row' + topCls + '">' +
				badge(rank) +
				'<div class="rank-info">' +
					'<div class="name">' + escapeHtml(r.name) + '</div>' +
					'<div class="empid">' + escapeHtml(r.empid) + '</div>' +
				'</div>' +
				'<div class="rank-count">' +
					'<div class="num">' + Number(r.catered).toLocaleString() + '</div>' +
					'<div class="lbl">Txns</div>' +
				'</div>' +
			'</div>';
		}

		function render(offices) {
			var wrap = document.getElementById('boards');
			if (!offices || offices.length === 0) {
				wrap.innerHTML = '<div class="empty-state" style="flex:1 1 auto;">No social worker has ' +
					'catered a completed transaction yet today. Check back soon.</div>';
				return;
			}
			var html = '';
			offices.forEach(function (o) {
				html += '<div class="office-col">' +
					'<div class="office-head">' +
						'<div class="office-name">' + escapeHtml(o.office) + '</div>' +
						'<div class="office-total">' + Number(o.total).toLocaleString() + ' served</div>' +
					'</div>' +
					'<div class="office-rows">' + o.rows.map(rankRow).join('') + '</div>' +
				'</div>';
			});
			wrap.innerHTML = html;
		}

		// Initial paint from PHP-rendered data (no flash of empty content)
		render(<?php echo json_encode(array_values($boards)); ?>);

		// Reactive refresh: re-fetch the boards so they update as clients are served
		function refresh() {
			fetch('dashboard.php?data=1&_=' + Date.now(), { cache: 'no-store' })
				.then(function (res) { return res.json(); })
				.then(function (data) {
					render(data.offices);
					document.getElementById('asOf').textContent = data.as_of;
				})
				.catch(function () { /* keep last good render on transient errors */ });
		}
		setInterval(refresh, 15000); // poll every 15s
	</script>
</body>
</html>
