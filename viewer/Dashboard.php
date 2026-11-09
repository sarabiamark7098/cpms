<?php
	include('../php/class.user.php');
    require_once("../php/session_timeout.php");
    $user = new User();
?>
<?php
	if((!$_SESSION['login']) && (!$_SESSION['userAccountusername'])	&& (!$_SESSION['userAccountpassword'])){
		header('Location:../index.php');
		}
	if($_SESSION['position'] != 'Viewer'){
		switch ($_SESSION['position']){
			case 'Encoder': header("Location: ../encoder/home.php");
							break;
			case 'Social Worker': header("Location: ../socialwork/home.php");
							break;
			case 'Admin': header("Location: ../admin/home.php");
							break;
			case 'Program Head': header("Location: ../programhead/home.php");
							break;
			case 'Finance': header("Location: ../finance/Dashboard.php");
							break;
			default:
				echo "<script>window.location='../index.php';</script>";
		}
    }
	$offices = $user->optionoffice();
?>

<!DOCTYPE html>
<html>

<head>
<title>DSWD Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta charset="UTF-8">
		<link rel="icon" type="image/png" href="../images/icons/ciu.ico"/>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../css/table.responsive.css">
        <link rel="stylesheet" type="text/css" href="../style5.css">
		<link rel="stylesheet" type="text/css" href="../css/finance.css?v=2">
		<link rel="stylesheet" type="text/css" href="../css/all.css">

        <script defer src="../js/solid.js"></script>
        <script defer src="../js/fontawesome.js"></script>
        <script src="../js/jquery.min.js"></script>
        <script src="../js/popper.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../js/main.js"></script>
        <script defer type="text/javascript" src="../js/chart.umd.min.js"></script>

		<style type="text/css">
            .dash-filter { background:#fff; border:1px solid #e3e6ea; border-radius:6px; padding:14px 16px; margin-bottom:18px; }
            .dash-filter label { font-size:12px; font-weight:600; color:#555; margin-bottom:2px; display:block; }
            .kpi-card { border-radius:8px; color:#fff; padding:14px 18px; margin-bottom:12px; box-shadow:0 1px 3px rgba(0,0,0,.12); }
            .kpi-card .kpi-label { font-size:13px; opacity:.9; }
            .kpi-card .kpi-value { font-size:26px; font-weight:700; line-height:1.2; }
            .kpi-card .kpi-sub { font-size:13px; opacity:.95; }
            .kpi-gl   { background:linear-gradient(135deg,#1565c0,#1e88e5); }
            .kpi-glb  { background:linear-gradient(135deg,#1565c0,#1e88e5); }
            .kpi-cav  { background:linear-gradient(135deg,#1565c0,#1e88e5); }
            .kpi-cavb { background:linear-gradient(135deg,#1565c0,#1e88e5); }
            .dash-panel { background:#fff; border:1px solid #e3e6ea; border-radius:8px; padding:16px; margin-bottom:22px; }
            .dash-panel h5 { font-weight:700; margin-bottom:14px; }
            .chart-box { position:relative; height:320px; }
            /* The shared css/table.responsive.css applies a global scrollable-
               tbody hack (tbody{display:block;height:600px;overflow:scroll} and
               thead/tbody tr{display:table}) but leaves tfoot alone, which drifts
               the Total out of its columns and forces a tall empty body. Restore
               normal table semantics here so the colgroup widths govern every
               row (header, body and the Total footer) identically. */
            .fund-table-wrap table { display:table; table-layout:fixed; width:100%; font-size:13px; margin-bottom:0; }
            .fund-table-wrap thead  { display:table-header-group; width:auto; }
            .fund-table-wrap tbody  { display:table-row-group; height:auto; overflow:visible; }
            .fund-table-wrap tfoot  { display:table-footer-group; }
            .fund-table-wrap tr     { display:table-row; width:auto; }

            /* Fixed column widths so header, body rows and the Total footer
               always line up; stable gutter keeps the scrollbar from shifting
               columns; header pinned to the top and Total pinned to the bottom
               so both stay visible and aligned while the body scrolls. */
            .fund-table-wrap { max-height:340px; overflow-y:auto; scrollbar-gutter:stable; }
            .fund-table-wrap col.col-fund  { width:54%; }
            .fund-table-wrap col.col-count { width:18%; }
            .fund-table-wrap col.col-amt   { width:28%; }
            .fund-table-wrap th, .fund-table-wrap td { overflow-wrap:anywhere; vertical-align:middle; }
            .fund-table-wrap td.text-right, .fund-table-wrap th.text-right, .fund-table-wrap td.text-amt { white-space:nowrap; }
            .fund-table-wrap thead th { position:sticky; z-index:3; background:#f5f6f8; }
            .fund-table-wrap thead tr:first-child th { top:0; height:30px; }
            .fund-table-wrap thead tr:nth-child(2) th { top:30px; }
            .fund-table-wrap tfoot td { position:sticky; bottom:0; z-index:3; background:#eef1f5; font-weight:700; border-top:2px solid #cfd6dd; }
            .text-amt { font-variant-numeric:tabular-nums; }

            /* Fund-source x assistance-type matrix: can be wide, so scroll both
               ways; sticky header rows and a sticky first column keep the fund
               source labels and the type headers in view while scrolling. */
            .matrix-wrap { max-height:440px; overflow:auto; scrollbar-gutter:stable; }
            .matrix-wrap table { display:table; table-layout:auto; width:auto; min-width:100%; font-size:13px; margin-bottom:0; }
            .matrix-wrap thead { display:table-header-group; }
            .matrix-wrap tbody { display:table-row-group; height:auto; overflow:visible; }
            .matrix-wrap tfoot { display:table-footer-group; }
            .matrix-wrap tr    { display:table-row; }
            .matrix-wrap th, .matrix-wrap td { white-space:nowrap; vertical-align:middle; }
            .matrix-wrap thead th { position:sticky; z-index:3; background:#f5f6f8; }
            .matrix-wrap thead tr:first-child th  { top:0; }
            .matrix-wrap thead tr:nth-child(2) th { top:31px; }
            .matrix-wrap tfoot td { position:sticky; bottom:0; z-index:3; background:#eef1f5; font-weight:700; border-top:2px solid #cfd6dd; }
            /* Freeze ONLY the Fund Source column: header row 1 (rowspan cell),
               every body row, and the footer. The second header row's first
               cell is the first type's GL column, so it must NOT be frozen. */
            .matrix-wrap tbody td:first-child { position:sticky; left:0; z-index:2; background:#fff; }
            .matrix-wrap thead tr:first-child th:first-child { position:sticky; left:0; z-index:5; background:#f5f6f8; }
            .matrix-wrap tfoot td:first-child { left:0; z-index:5; }

            /* Per-table multi-select assistance filter (checkbox dropdown). */
            .matrix-filter { position:relative; }
            .matrix-filter-menu { display:none; position:absolute; right:0; top:100%; margin-top:4px; z-index:1000;
                background:#fff; border:1px solid #cfd6dd; border-radius:6px; padding:6px 0; min-width:240px;
                max-height:300px; overflow-y:auto; box-shadow:0 4px 14px rgba(0,0,0,.15); }
            .matrix-filter-menu.open { display:block; }
            .matrix-filter-item { display:block; margin:0; padding:5px 12px; font-size:13px; font-weight:400; cursor:pointer; white-space:nowrap; }
            .matrix-filter-item:hover { background:#f2f6fb; }
            .matrix-filter-item input { margin-right:7px; }
            #dashLoading { display:none; }
				#sidebar{display:none !important;}
		#content{margin-left:0 !important;width:100% !important;}
	</style>
    </head>

<body>
    <div class="wrapper">

        <!-- Page Content Holder -->
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-blue">
                <div class="container-fluid">
                    <a class="nav-link toggle tohover" data-id="<?php echo $_SESSION['userId'];?>" data-target="#userAccount" style="margin-left: 10px;" data-toggle="modal" aria-haspopup="true" aria-expanded="false">
                        <?php $name = explode(' ',$_SESSION['userfullname']); $namef=strtoupper($name[0]); echo $namef;?>
                    </a>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto tohover" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a class="nav-link tohover" data-toggle="modal" data-target="#logoutmodal">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="container-fluid" style="padding:20px 3%;">
                <h4 style="font-weight:700;">Dashboard</h4>
                <p class="text-muted" style="margin-top:-4px;">Guarantee Letters &amp; Outright Cash by office and charging.</p>

                <!-- Filter bar -->
                <div class="dash-filter">
                    <div class="row align-items-end">
                        <div class="col-lg-2 col-md-4 col-6">
                            <label for="granularity">Period</label>
                            <select id="granularity" class="form-control">
                                <option value="day">Day</option>
                                <option value="month" selected>Month</option>
                                <option value="year">Year</option>
                                <option value="custom">Custom</option>
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-4 col-6">
                            <label>Date</label>
                            <input type="date"   id="input-day"   class="form-control" style="display:none;">
                            <input type="month"  id="input-month" class="form-control">
                            <input type="number" id="input-year"  class="form-control" min="2000" max="2100" placeholder="YYYY" style="display:none;">
                            <div id="input-range" style="display:none; align-items:center; gap:6px;">
                                <input type="date" id="input-from" class="form-control" title="From">
                                <span class="text-muted" style="font-size:12px;">to</span>
                                <input type="date" id="input-to" class="form-control" title="To">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-8">
                            <label for="office">Office</label>
                            <select id="office" class="form-control">
                                <option value="">All Offices</option>
                                <?php if ($offices) { while ($o = mysqli_fetch_assoc($offices)) {
                                    echo '<option value="'.htmlspecialchars($o['office_id']).'">'.htmlspecialchars($o['office_name']).'</option>';
                                } } ?>
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-2 col-4">
                            <label>&nbsp;</label>
                            <button id="applyFilter" class="btn btn-primary btn-block">
                                <i class="fa fa-sync"></i> Apply
                            </button>
                        </div>
                    </div>
                    <div id="dashLoading" class="text-primary" style="margin-top:8px;"><i class="fa fa-spinner fa-spin"></i> Loading data…</div>
                    <div id="periodLabel" class="text-muted" style="margin-top:8px; font-size:13px;"></div>
                    <div id="liveStamp" class="text-success" style="margin-top:4px; font-size:12px;"><i class="fa fa-circle" style="font-size:8px;"></i> Live</div>
                </div>

                                                <!-- ===== GL / CAV summary ===== -->
                <div class="row">
                    <div class="col-lg-6">
                        <div class="dash-panel">
                            <h5><i class="fa fa-file-alt text-primary"></i> Guarantee Letters (GL)</h5>
                            <div class="kpi-card kpi-gl">
                                <div class="kpi-label">Total Guarantee Letters</div>
                                <div class="kpi-value" id="glTotalCount">0</div>
                                <div class="kpi-sub">Amount: <span id="glTotalAmount">&#8369;0.00</span></div>
                            </div>
                            <div class="chart-box" style="margin-top:12px;"><canvas id="glOfficeChart"></canvas></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="dash-panel">
                            <h5><i class="fa fa-hand-holding-usd" style="color:#1e88e5;"></i> Outright Cash (CAV)</h5>
                            <div class="kpi-card kpi-cav">
                                <div class="kpi-label">Total Outright Cash</div>
                                <div class="kpi-value" id="cavTotalCount">0</div>
                                <div class="kpi-sub">Amount: <span id="cavTotalAmount">&#8369;0.00</span></div>
                            </div>
                            <div class="chart-box" style="margin-top:12px;"><canvas id="cavOfficeChart"></canvas></div>
                        </div>
                    </div>
                </div>

                <div class="dash-panel">
                    <h5><i class="fa fa-coins" style="color:#1e88e5;"></i> Charging Sources</h5>
                    <div class="fund-table-wrap" style="margin-top:12px;">
                        <table class="table table-sm table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th rowspan="2">Charging</th>
                                    <th colspan="2" class="text-center" style="background:#e3f0fc;">Guarantee Letter (GL)</th>
                                    <th colspan="2" class="text-center" style="background:#e3f0fc;">Outright Cash (CAV)</th>
                                    <th rowspan="2" class="text-right">Overall Amount</th>
                                </tr>
                                <tr>
                                    <th class="text-right">Count</th><th class="text-right">Amount</th>
                                    <th class="text-right">Count</th><th class="text-right">Amount</th>
                                </tr>
                            </thead>
                            <tbody id="fundMergedBody"></tbody>
                            <tfoot><tr class="font-weight-bold">
                                <td>Total</td>
                                <td class="text-right" id="fundGlCount">0</td><td class="text-right text-amt" id="fundGlAmt">&#8369;0.00</td>
                                <td class="text-right" id="fundCavCount">0</td><td class="text-right text-amt" id="fundCavAmt">&#8369;0.00</td>
                                <td class="text-right text-amt" id="fundOverall">&#8369;0.00</td>
                            </tr></tfoot>
                        </table>
                    </div>
</div>

                <div class="dash-panel">
                    <h5><i class="fa fa-notes-medical" style="color:#1e88e5;"></i> Assistance</h5>
                    <div class="fund-table-wrap" style="margin-top:12px;">
                        <table class="table table-sm table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th rowspan="2">Type of Assistance</th>
                                    <th colspan="2" class="text-center" style="background:#e3f0fc;">Guarantee Letter (GL)</th>
                                    <th colspan="2" class="text-center" style="background:#e3f0fc;">Outright Cash (CAV)</th>
                                    <th rowspan="2" class="text-right">Overall Amount</th>
                                </tr>
                                <tr>
                                    <th class="text-right">Count</th><th class="text-right">Amount</th>
                                    <th class="text-right">Count</th><th class="text-right">Amount</th>
                                </tr>
                            </thead>
                            <tbody id="typeMergedBody"></tbody>
                            <tfoot><tr class="font-weight-bold">
                                <td>Total</td>
                                <td class="text-right" id="typeGlCount">0</td><td class="text-right text-amt" id="typeGlAmt">&#8369;0.00</td>
                                <td class="text-right" id="typeCavCount">0</td><td class="text-right text-amt" id="typeCavAmt">&#8369;0.00</td>
                                <td class="text-right text-amt" id="typeOverall">&#8369;0.00</td>
                            </tr></tfoot>
                        </table>
                    </div>
</div>

                <div class="dash-panel">
                    <div class="d-flex justify-content-between align-items-center flex-wrap" style="gap:10px;">
                        <h5 style="margin:0;"><i class="fa fa-coins" style="color:#1e88e5;"></i> Number of Assistance per Charging</h5>
                        <div class="matrix-filter">
                            <button type="button" id="matrixFilterBtn" class="btn btn-sm btn-outline-secondary">
                                <i class="fa fa-filter"></i> Assistance: <span id="matrixFilterLabel">All</span> <i class="fa fa-caret-down"></i>
                            </button>
                            <div id="matrixFilterMenu" class="matrix-filter-menu">
                                <label class="matrix-filter-item" style="font-weight:700;border-bottom:1px solid #eee;">
                                    <input type="checkbox" id="matrixFilterAll" checked> All Assistance
                                </label>
                                <div id="matrixFilterList"></div>
                            </div>
                        </div>
                    </div>
                    <div class="matrix-wrap" style="margin-top:12px;">
                        <table class="table table-sm table-striped table-bordered" id="fundMatrixTable">
                            <thead id="fundMatrixHead"></thead>
                            <tbody id="fundMatrixBody"></tbody>
                            <tfoot id="fundMatrixFoot"></tfoot>
                        </table>
                    </div>
</div>
            </div>
        </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $(this).toggleClass('active');
            });
        });
    </script>

<div class="module">
    <div class="modal fade in" id="userAccount" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">User Account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
				<div class="useraccount"></div>
			</div>
		</div>
    </div>
</div>

    <div class="modal hide fade" id="logoutmodal" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header"><h4>Logout <i class="fa fa-lock"></i></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button></div>
            <div class="modal-body logoutbody"><i class="fa fa-question-circle"></i> Are you sure you want to log-out?</div>
            <div class="modal-footer"><a href="../php/logout.php" class="btn btn-primary btn-block">Logout</a></div>
            </div>
        </div>
    </div>

<script src="../js/session_heartbeat.js"></script>
</body>

<script type="text/javascript">
    //userAccount modal loader
    $('#userAccount').appendTo("body").on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var userid = button.data('id');
        var modal = $(this);
        $.ajax({ type: "GET", url: "userAccount.php", data: 'id=' + userid, cache: false,
            success: function (data) { modal.find('.useraccount').html(data); } });
    });
</script>

<script type="text/javascript">
(function () {
    var charts = {};
    var peso = new Intl.NumberFormat('en-PH', { style: 'currency', currency: 'PHP' });
    var num  = new Intl.NumberFormat('en-PH');

    var palette = ['#1e88e5'];

    function colorList(n) {
        var out = [];
        for (var i = 0; i < n; i++) { out.push(palette[i % palette.length]); }
        return out;
    }

    // Toggle the matching date input when the granularity changes
    function currentValue() {
        var g = $('#granularity').val();
        if (g === 'day')   { return $('#input-day').val(); }
        if (g === 'year')  { return $('#input-year').val(); }
        if (g === 'custom'){ return ($('#input-from').val() || '') + '..' + ($('#input-to').val() || ''); }
        return $('#input-month').val();
    }
    function syncInputs() {
        var g = $('#granularity').val();
        $('#input-day, #input-month, #input-year').hide();
        $('#input-range').css('display', 'none');
        if (g === 'day')   { $('#input-day').show(); }
        else if (g === 'year') { $('#input-year').show(); }
        else if (g === 'custom') { $('#input-range').css('display', 'flex'); }
        else { $('#input-month').show(); }
    }

    function CHART_OPTS(horizontal){
        return {
            indexAxis: horizontal ? 'y' : 'x',
            responsive: true, maintainAspectRatio: false,
            animation: false,                       // fast redraws for real-time
            plugins: { legend: { display: false } },
            scales: { x: { ticks: { autoSkip: false } }, y: { beginAtZero: true } }
        };
    }

    // Create a chart once, then mutate its data in place (cheap on refresh).
    function upsertBar(ctx, labels, data, label, colors, horizontal) {
        var ch = charts[ctx];
        if (!ch) {
            charts[ctx] = new Chart(document.getElementById(ctx), {
                type: 'bar',
                data: { labels: labels, datasets: [{ label: label, data: data, backgroundColor: colors, borderWidth: 0 }] },
                options: CHART_OPTS(horizontal)
            });
            return;
        }
        ch.data.labels = labels;
        ch.data.datasets[0].data = data;
        ch.data.datasets[0].backgroundColor = colors;
        ch.update('none');                          // no re-animation = no jank
    }

    function renderOfficeChart(canvasId, rows) {
        upsertBar(canvasId,
            rows.map(function (r) { return r.office_name; }),
            rows.map(function (r) { return r.cnt; }),
            'Count', colorList(rows.length), false);
    }
    function esc(v){ return $('<div>').text(v == null ? '' : v).html(); }
    // Merged GL+CAV table: label, GL count/amount, CAV count/amount, overall.
    function renderMerged(bodyId, rows, ids) {
        var glC=0, glA=0, cvC=0, cvA=0, ov=0, html='';
        if (!rows || !rows.length) {
            html = '<tr><td colspan="6" class="text-center text-muted">No data</td></tr>';
        } else {
            for (var i = 0; i < rows.length; i++) {
                var r = rows[i];
                glC+=r.gl_cnt; glA+=r.gl_amt; cvC+=r.cav_cnt; cvA+=r.cav_amt; ov+=r.overall;
                html += '<tr><td>' + esc(r.label) +
                    '</td><td class="text-right">' + num.format(r.gl_cnt) +
                    '</td><td class="text-right text-amt">' + peso.format(r.gl_amt) +
                    '</td><td class="text-right">' + num.format(r.cav_cnt) +
                    '</td><td class="text-right text-amt">' + peso.format(r.cav_amt) +
                    '</td><td class="text-right text-amt">' + peso.format(r.overall) + '</td></tr>';
            }
        }
        document.getElementById(bodyId).innerHTML = html;
        $('#'+ids.glCount).text(num.format(glC));  $('#'+ids.glAmt).text(peso.format(glA));
        $('#'+ids.cavCount).text(num.format(cvC)); $('#'+ids.cavAmt).text(peso.format(cvA));
        $('#'+ids.overall).text(peso.format(ov));
    }

    // ---- Fund-source x assistance-type matrix (count + amount per mode) ----
    var matrixData = null;        // last payload for this table
    var matrixSelTypes = [];      // chosen assistance types ([] = All)

    // Types to display: the selected ones that still exist, in payload order
    // (empty selection = all types).
    function matrixDisplayTypes() {
        var all = (matrixData && matrixData.types) ? matrixData.types : [];
        if (!matrixSelTypes.length) { return all.slice(); }
        return all.filter(function (t) { return matrixSelTypes.indexOf(t) !== -1; });
    }

    // Matrix: rows = fund source; per assistance type four sub-columns
    // (GL Count, GL Amount, CAV Count, CAV Amount); trailing Total Count /
    // Total Amount columns and a Total footer row. Honours the multi-select
    // assistance filter.
    function renderFundMatrix() {
        var rows  = (matrixData && matrixData.rows) ? matrixData.rows : [];
        var types = matrixDisplayTypes();
        var head = document.getElementById('fundMatrixHead');
        var body = document.getElementById('fundMatrixBody');
        var foot = document.getElementById('fundMatrixFoot');

        if (!types.length || !rows.length) {
            head.innerHTML = '';
            body.innerHTML = '<tr><td class="text-center text-muted">No data for this selection</td></tr>';
            foot.innerHTML = '';
            return;
        }

        // Header: each type spans 4 columns (GL Count/Amount, CAV Count/Amount).
        var h1 = '<tr><th rowspan="2">Charging</th>';
        var h2 = '<tr>';
        for (var t = 0; t < types.length; t++) {
            h1 += '<th colspan="4" class="text-center" style="background:#e3f0fc;">' + esc(types[t]) + '</th>';
            h2 += '<th class="text-right">GL Count</th><th class="text-right">GL Amount</th>' +
                  '<th class="text-right">CAV Count</th><th class="text-right">CAV Amount</th>';
        }
        h1 += '<th rowspan="2" class="text-right">Total Count</th>' +
              '<th rowspan="2" class="text-right">Total Amount</th></tr>';
        h2 += '</tr>';
        head.innerHTML = h1 + h2;

        // Body + running per-column totals (parallel arrays over displayed types).
        var cGl=[], cGlA=[], cCav=[], cCavA=[], gCnt=0, gAmt=0, bHtml='';
        for (var z=0; z<types.length; z++){ cGl[z]=0; cGlA[z]=0; cCav[z]=0; cCavA[z]=0; }
        for (var i=0; i<rows.length; i++){
            var row = rows[i], cells = row.cells || {};
            var rCnt=0, rAmt=0, tds='';
            for (var c=0; c<types.length; c++){
                var cell = cells[types[c]] || {gl:0,glAmt:0,cav:0,cavAmt:0};
                cGl[c]+=cell.gl; cGlA[c]+=cell.glAmt; cCav[c]+=cell.cav; cCavA[c]+=cell.cavAmt;
                rCnt += cell.gl + cell.cav; rAmt += cell.glAmt + cell.cavAmt;
                tds += '<td class="text-right">'+num.format(cell.gl)+
                       '</td><td class="text-right text-amt">'+peso.format(cell.glAmt)+
                       '</td><td class="text-right">'+num.format(cell.cav)+
                       '</td><td class="text-right text-amt">'+peso.format(cell.cavAmt)+'</td>';
            }
            bHtml += '<tr><td>'+esc(row.fundsource)+'</td>'+tds+
                     '<td class="text-right">'+num.format(rCnt)+
                     '</td><td class="text-right text-amt">'+peso.format(rAmt)+'</td></tr>';
            gCnt += rCnt; gAmt += rAmt;
        }
        body.innerHTML = bHtml;

        // Footer: per type/mode totals + grand count/amount.
        var fHtml = '<tr class="font-weight-bold"><td>Total</td>';
        for (var k=0; k<types.length; k++){
            fHtml += '<td class="text-right">'+num.format(cGl[k])+
                     '</td><td class="text-right text-amt">'+peso.format(cGlA[k])+
                     '</td><td class="text-right">'+num.format(cCav[k])+
                     '</td><td class="text-right text-amt">'+peso.format(cCavA[k])+'</td>';
        }
        fHtml += '<td class="text-right">'+num.format(gCnt)+
                 '</td><td class="text-right text-amt">'+peso.format(gAmt)+'</td></tr>';
        foot.innerHTML = fHtml;
    }

    // Build the checkbox menu from the payload's types, keeping any still-valid
    // selections, and refresh the button label.
    function populateMatrixFilter() {
        var types = (matrixData && matrixData.types) ? matrixData.types : [];
        matrixSelTypes = matrixSelTypes.filter(function (t) { return types.indexOf(t) !== -1; });
        var html = '';
        for (var i=0;i<types.length;i++){
            var on = (!matrixSelTypes.length || matrixSelTypes.indexOf(types[i])!==-1) ? ' checked' : '';
            html += '<label class="matrix-filter-item"><input type="checkbox" class="matrix-type-cb" value="'+
                    esc(types[i])+'"'+on+'> '+esc(types[i])+'</label>';
        }
        document.getElementById('matrixFilterList').innerHTML = html;
        document.getElementById('matrixFilterAll').checked = !matrixSelTypes.length;
        updateMatrixFilterLabel();
    }

    function updateMatrixFilterLabel() {
        var lbl = !matrixSelTypes.length ? 'All'
                : (matrixSelTypes.length === 1 ? matrixSelTypes[0] : matrixSelTypes.length + ' selected');
        $('#matrixFilterLabel').text(lbl);
    }

    // Read checkbox state into matrixSelTypes ([] = all = none/every ticked).
    function syncMatrixSelFromCheckboxes() {
        var sel = [];
        $('.matrix-type-cb:checked').each(function(){ sel.push($(this).val()); });
        var total = $('.matrix-type-cb').length;
        matrixSelTypes = (sel.length === 0 || sel.length === total) ? [] : sel;
    }

    var REFRESH_MS = 15000;   // real-time poll interval
    var pending = null;       // in-flight request (prevents overlap)
    var lastSig = null;       // signature of last rendered payload
    var pollTimer = null;

    function render(d) {
        $('#periodLabel').text('Showing ' + d.period.start.substring(0,10) + ' to ' + d.period.end.substring(0,10) +
            (d.period.office ? (' \u00b7 ' + $('#office option:selected').text()) : ' \u00b7 All Offices'));
        $('#glTotalCount').text(num.format(d.guaranteeLetters.totalCount));
        $('#glTotalAmount').text(peso.format(d.guaranteeLetters.totalAmount));
        renderOfficeChart('glOfficeChart', d.guaranteeLetters.byOffice);
        $('#cavTotalCount').text(num.format(d.outrightCash.totalCount));
        $('#cavTotalAmount').text(peso.format(d.outrightCash.totalAmount));
        renderOfficeChart('cavOfficeChart', d.outrightCash.byOffice);
        renderMerged('fundMergedBody', d.fundSourcesMerged, {glCount:'fundGlCount',glAmt:'fundGlAmt',cavCount:'fundCavCount',cavAmt:'fundCavAmt',overall:'fundOverall'});
        renderMerged('typeMergedBody', d.assistanceTypesMerged, {glCount:'typeGlCount',glAmt:'typeGlAmt',cavCount:'typeCavCount',cavAmt:'typeCavAmt',overall:'typeOverall'});
        matrixData = d.fundSourceTypeMatrix;
        populateMatrixFilter();
        renderFundMatrix();
    }

    function load(silent) {
        if (pending) { pending.abort(); }            // never overlap requests
        if (!silent) { $('#dashLoading').show(); }
        pending = $.ajax({
            type: 'GET', url: 'dashboard_data.php', dataType: 'json',
            data: { granularity: $('#granularity').val(), value: currentValue(), office: $('#office').val() },
            success: function (d) {
                if (d.error) { if (!silent) alert(d.error); return; }
                var sig = JSON.stringify([d.period, d.guaranteeLetters, d.outrightCash, d.fundSourcesMerged, d.assistanceTypesMerged, d.fundSourceTypeMatrix]);
                if (sig !== lastSig) { lastSig = sig; render(d); }   // skip work when unchanged
                $('#liveStamp').html('<i class="fa fa-circle" style="font-size:8px;"></i> Live &middot; updated ' + new Date().toLocaleTimeString());
            },
            error: function (xhr, st) { if (st !== 'abort' && !silent) alert('Failed to load dashboard data.'); },
            complete: function () { pending = null; if (!silent) $('#dashLoading').hide(); }
        });
    }

    function startPolling() {
        if (pollTimer) return;
        pollTimer = setInterval(function () {
            if (!document.hidden && !pending) { load(true); }       // pause when tab hidden / busy
        }, REFRESH_MS);
    }
    document.addEventListener('visibilitychange', function () {
        if (!document.hidden && !pending) { load(true); }           // refresh on return to tab
    });

    $(function () {
        var now = new Date();
        var mm = ('0' + (now.getMonth() + 1)).slice(-2);
        $('#input-month').val(now.getFullYear() + '-' + mm);
        var today = now.getFullYear() + '-' + mm + '-' + ('0' + now.getDate()).slice(-2);
        $('#input-day').val(today);
        $('#input-year').val(now.getFullYear());
        $('#input-from').val(now.getFullYear() + '-' + mm + '-01');
        $('#input-to').val(today);
        syncInputs();
        $('#granularity').on('change', syncInputs);
        $('#applyFilter').on('click', function () { lastSig = null; load(false); });

        // Per-table assistance multi-select filter (checkbox dropdown).
        $('#matrixFilterBtn').on('click', function (e) {
            e.stopPropagation();
            $('#matrixFilterMenu').toggleClass('open');
        });
        $('#matrixFilterMenu').on('click', function (e) { e.stopPropagation(); });
        $(document).on('click', function () { $('#matrixFilterMenu').removeClass('open'); });
        $('#matrixFilterAll').on('change', function () {
            $('.matrix-type-cb').prop('checked', this.checked);
            syncMatrixSelFromCheckboxes();
            updateMatrixFilterLabel();
            renderFundMatrix();
        });
        $('#matrixFilterList').on('change', '.matrix-type-cb', function () {
            syncMatrixSelFromCheckboxes();
            $('#matrixFilterAll').prop('checked', !matrixSelTypes.length);
            updateMatrixFilterLabel();
            renderFundMatrix();
        });

        load(false);
        startPolling();
    });
})();
</script>
</html>
