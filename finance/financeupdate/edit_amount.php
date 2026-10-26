<?php
include('../../php/class.user.php');
require_once("../../php/session_timeout.php");
$user = new User();

// Finance-only. Any other role is bounced back to its own area.
if (empty($_SESSION['login']) || ($_SESSION['position'] ?? '') !== 'Finance') {
    switch ($_SESSION['position'] ?? '') {
        case 'Encoder':       header('Location: ../../encoder/home.php');     break;
        case 'Social Worker': header('Location: ../../socialwork/home.php');  break;
        case 'Admin':         header('Location: ../../admin/home.php');       break;
        case 'Program Head':  header('Location: ../../programhead/home.php'); break;
        default:              header('Location: ../../index.php');
    }
    exit;
}

if (!isset($_GET['id'])) { header('Location: ../home.php'); exit; }
$trans_id = $_GET['id'];

// Save: finance may change ONLY the assistance amount and the fund sources (name + amount,
// add / remove / update up to 12). The fund amounts must sum to the assistance amount; the
// server rejects the save otherwise. On success proceed to the print hub (last.php).
if (isset($_POST['update'])) {
    $names = array(); $amounts = array();
    for ($i = 1; $i <= 12; $i++) {
        $names[$i]   = $_POST['fs' . $i] ?? '';
        $amounts[$i] = $_POST['amountf' . $i] ?? '';
    }
    $ok = $user->financeUpdateAmounts($trans_id, $_POST['a1'] ?? '', $_POST['a2'] ?? '', $names, $amounts);
    if ($ok) {
        echo "<script>window.location='last.php?id=" . htmlspecialchars($trans_id, ENT_QUOTES) . "';</script>";
        exit;
    }
}

$client = $user->clientData($trans_id);
$name = $client["lastname"] . ", " . $client["firstname"] . " "
      . (!empty($client["middlename"]) ? $client["middlename"] . " " : "")
      . (!empty($client['extraname']) ? $client['extraname'] . "." : "");
$client_assistance = $user->getGISAssistance($trans_id);
$fundsourcedata    = $user->getfundsourcedata($trans_id);

$hasType2 = !empty($client_assistance[2]['amount']);

// Existing fund sources (contiguous slots 1..12).
$funds = array();
for ($i = 1; $i <= 12; $i++) {
    if (!empty($fundsourcedata[$i]['fundsource'])) {
        $funds[$i] = array(
            'name' => $fundsourcedata[$i]['fundsource'],
            'amt'  => $fundsourcedata[$i]['fs_amount'] ?? '',
        );
    }
}
$fundCount = count($funds);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="icon" type="image/png" href="../../images/icons/ciu.ico"/>
        <link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
        <script defer src="../../js/solid.js"></script>
        <script defer src="../../js/fontawesome.js"></script>
        <script src="../../js/jquery.min.js"></script>
        <script src="../../js/popper.min.js"></script>
        <script src="../../js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../../js/jquery.inputmask.min.js"></script>
        <title>Update Amount</title>
        <style>
            body { background:#f4f6fa; }
            .amt-wrap { max-width: 980px; margin: 0 auto; }
            .ro { background:#eef0f3; }
            .fund-slot { margin-bottom:10px; }
            .total-box { font-size: 15px; }
            .total-ok  { color:#1e7e34; font-weight:600; }
            .total-bad { color:#c0392b; font-weight:600; }
            .col-head { font-weight:600; color:#555; }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark" style="position: fixed; width: 100%; z-index:100; background:#1e88e5;">
            <a href="../home.php"><img src="../../images/dswd-logo_final.png" class="img-responsive" alt="logo" width="200" height="55"></a>
        </nav>
        <br><br><br><br>
        <div class="container amt-wrap">
            <div class="card shadow-sm">
                <div class="card-header text-white" style="background:#1e88e5;">
                    <h4 class="mb-0"><i class="fa fa-coins"></i> Update Amount &amp; Fund Source</h4>
                </div>
                <div class="card-body">
                    <p class="mb-1"><b>Client:</b> <?php echo htmlspecialchars($name); ?></p>
                    <p class="mb-3"><b>Transaction:</b> <?php echo htmlspecialchars($trans_id); ?></p>

                    <form id="amtForm" method="post" action="edit_amount.php?id=<?php echo htmlspecialchars($trans_id, ENT_QUOTES); ?>">

                        <!-- Assistance (GIS-style row) -->
                        <h5 class="text-dark" style="font-weight:bold;">Assistance:</h5>
                        <div class="row">
                            <div class="col col-head text-center">PURPOSE</div>
                            <div class="col-3 col-head text-center">AMOUNT</div>
                            <div class="col-3 col-head text-center">MODE</div>
                        </div>
                        <div class="row">
                            <div class="col"><input class="form-control ro" value="<?php echo htmlspecialchars($client_assistance[1]['purpose'] ?? ''); ?>" readonly></div>
                            <div class="col-3"><input class="form-control currencyMaskedInput" id="a1" name="a1" required value="<?php echo htmlspecialchars($client_assistance[1]['amount'] ?? ''); ?>"></div>
                            <div class="col-3"><input class="form-control ro" value="<?php echo htmlspecialchars($client_assistance[1]['mode'] ?? ''); ?>" readonly></div>
                        </div>
                        <?php if ($hasType2) { ?>
                        <div class="row mt-1">
                            <div class="col"><input class="form-control ro" value="<?php echo htmlspecialchars($client_assistance[2]['purpose'] ?? ''); ?>" readonly></div>
                            <div class="col-3"><input class="form-control currencyMaskedInput" id="a2" name="a2" required value="<?php echo htmlspecialchars($client_assistance[2]['amount'] ?? ''); ?>"></div>
                            <div class="col-3"><input class="form-control ro" value="<?php echo htmlspecialchars($client_assistance[2]['mode'] ?? ''); ?>" readonly></div>
                        </div>
                        <?php } ?>

                        <hr>

                        <!-- Fund Source (add / remove / update, up to 12) -->
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="text-dark" style="font-weight:bold;">Fund Source:</h5>
                            <button type="button" id="addFund" class="btn btn-outline-primary btn-sm">
                                <i class="fa fa-plus"></i> Add Fund Source
                            </button>
                        </div>
                        <div class="row">
                            <div class="col-6 col-head">FUND SOURCE</div>
                            <div class="col-4 col-head">AMOUNT</div>
                            <div class="col-2"></div>
                        </div>
                        <div id="fundList">
                            <?php for ($i = 1; $i <= 12; $i++) {
                                $has = isset($funds[$i]);
                                // Show slots that already hold a fund; always show slot 1 even if empty.
                                $show = $has || ($i === 1 && $fundCount === 0);
                            ?>
                            <div class="form-row fund-slot align-items-center" data-slot="<?php echo $i; ?>" style="<?php echo $show ? '' : 'display:none;'; ?>">
                                <div class="col-6">
                                    <input list="chargings" class="form-control fundName" id="fs<?php echo $i; ?>" name="fs<?php echo $i; ?>"
                                           placeholder="Fund Source" value="<?php echo htmlspecialchars($has ? $funds[$i]['name'] : ''); ?>">
                                </div>
                                <div class="col-4">
                                    <input class="form-control currencyMaskedInput fundAmt" id="amountf<?php echo $i; ?>" name="amountf<?php echo $i; ?>"
                                           placeholder="Amount" value="<?php echo htmlspecialchars($has ? $funds[$i]['amt'] : ''); ?>">
                                </div>
                                <div class="col-2">
                                    <button type="button" class="btn btn-outline-danger btn-sm rmFund" data-slot="<?php echo $i; ?>">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <?php echo $user->chargings(); // <datalist id="chargings"> ?>

                        <div class="total-box mt-3">
                            Assistance amount: <b><span id="assistAmt">0.00</span></b>
                            &nbsp;|&nbsp; Fund total: <b><span id="fundTotal">0.00</span></b>
                            &nbsp;|&nbsp; Remaining balance: <b><span id="remainBal">0.00</span></b>
                            <div id="totalFlag" class="mt-1"></div>
                        </div>

                        <hr>
                        <div class="text-right">
                            <a href="../home.php" class="btn btn-outline-secondary">Cancel</a>
                            <button type="submit" name="update" id="saveBtn" class="btn btn-primary">
                                <i class="fa fa-save"></i> Save &amp; Continue to Print
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function () {
                $(".currencyMaskedInput").inputmask({
                    alias: "currency", prefix: "", rightAlign: false,
                    groupSeparator: ",", autoGroup: true, digits: 2, allowMinus: false
                });

                function num(v){ return parseFloat(String(v == null ? "" : v).replace(/,/g, "")) || 0; }

                // Rows that are visible AND have a fund name count toward the total.
                function activeSlots(){
                    return $("#fundList .fund-slot").filter(function(){
                        return $(this).css("display") !== "none" && $.trim($("#fs"+$(this).data("slot")).val()) !== "";
                    });
                }

                function fmt(v){ return v.toLocaleString(undefined,{minimumFractionDigits:2, maximumFractionDigits:2}); }

                function recalc(){
                    var total = 0;
                    activeSlots().each(function(){
                        total += num($("#amountf"+$(this).data("slot")).val());
                    });
                    var assist = num($("#a1").val());
                    var remain = assist - total;   // how much of the assistance is still unallocated
                    $("#fundTotal").text(fmt(total));
                    $("#assistAmt").text(fmt(assist));
                    $("#remainBal").text(fmt(remain));
                    // green when fully allocated, amber when there is balance left, red when over-allocated
                    $("#remainBal").css("color", Math.abs(remain) < 0.005 ? "#1e7e34" : (remain > 0 ? "#b26a00" : "#c0392b"));

                    var flag = $("#totalFlag");
                    var hasFunds = activeSlots().length > 0;
                    if(!hasFunds){
                        flag.text("(no fund source)").attr("class", "mt-1");
                        $("#saveBtn").prop("disabled", false);
                        return true;
                    }
                    if(Math.abs(remain) < 0.005){
                        flag.text("✓ fully allocated").attr("class", "mt-1 total-ok");
                        $("#saveBtn").prop("disabled", false);
                        return true;
                    }
                    flag.text(remain > 0
                                ? ("✗ " + fmt(remain) + " still to allocate")
                                : ("✗ over-allocated by " + fmt(-remain)))
                        .attr("class", "mt-1 total-bad");
                    $("#saveBtn").prop("disabled", true);
                    return false;
                }

                // Add: reveal the next hidden slot (up to 12).
                $("#addFund").on("click", function(){
                    var next = $("#fundList .fund-slot").filter(function(){ return $(this).css("display") === "none"; }).first();
                    if(next.length){ next.show(); next.find(".fundName").focus(); }
                    else { alert("Maximum of 12 fund sources."); }
                    recalc();
                });

                // Remove: clear + hide the slot.
                $(document).on("click", ".rmFund", function(){
                    var slot = $(this).data("slot");
                    $("#fs"+slot).val("");
                    $("#amountf"+slot).val("");
                    $(this).closest(".fund-slot").hide();
                    recalc();
                });

                $(document).on("keyup change", ".fundAmt, .fundName, #a1", recalc);

                // Block the save when fund amounts do not match the assistance amount.
                $("#amtForm").on("submit", function(e){
                    if(!recalc()){
                        e.preventDefault();
                        alert("The fund source amounts must sum to the assistance amount before saving.");
                    }
                });

                setTimeout(recalc, 300);
            });
        </script>
    </body>
</html>
