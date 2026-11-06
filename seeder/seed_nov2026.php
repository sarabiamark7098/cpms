<?php
/**
 * Seeder: November 1-30, 2026 completed transactions.
 *
 * Populates fully-consistent records that follow the real app process:
 *   encoding (client_data [+ beneficiary_data] + tbl_transaction)
 *     -> social work / GIS (service, assessment, assistance, other_client_information,
 *        source_of_income, tbl_coe_fund [+ family])
 *     -> finish (coe + tbl_transaction.status_client='Done', date_accomplished)
 *
 * Every seeded transaction is tagged so it can be removed later:
 *   tbl_transaction.note    = 'SEEDER'
 *   tbl_transaction.remarks = 'SEEDED NOV2026'
 * and each new trans_id is appended to seeder/seeded_trans_ids_nov2026.txt.
 * Use seeder/cleanup_nov2026.php to delete everything this inserts.
 *
 * USAGE (CLI only):
 *   php seeder/seed_nov2026.php            # 20000 records (default)
 *   php seeder/seed_nov2026.php 25000      # custom count
 *
 * Fund amounts always balance to the assistance amount, matching the GIS rule.
 */

if (php_sapi_name() !== 'cli') {
    die("This seeder must be run from the command line.\n");
}

require __DIR__ . '/../php/config.php';

$TOTAL  = isset($argv[1]) ? max(1, (int)$argv[1]) : 20000;
$YEAR   = 2026;
$MONTH  = 11;            // November
$TZ     = 'Asia/Manila';
date_default_timezone_set($TZ);

if ($TOTAL > 999999) { die("Count must be <= 999999 (trans_id tail is 6 digits).\n"); }

mysqli_report(MYSQLI_REPORT_OFF);
$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
if (!$con) { die("DB connection failed: " . mysqli_connect_error() . "\n"); }
mysqli_set_charset($con, 'latin1');

function esc($con, $v) { return mysqli_real_escape_string($con, (string)$v); }
function pick(array $a) { return $a[array_rand($a)]; }
/** weighted pick: $pairs = [[value,weight],...] */
function pickw(array $pairs) {
    $total = 0; foreach ($pairs as $p) { $total += $p[1]; }
    $r = mt_rand(1, $total); $acc = 0;
    foreach ($pairs as $p) { $acc += $p[1]; if ($r <= $acc) return $p[0]; }
    return $pairs[0][0];
}
function q($con, $sql) {
    if (!mysqli_query($con, $sql)) {
        throw new RuntimeException("Query failed: " . mysqli_error($con) . "\nSQL: " . substr($sql, 0, 300));
    }
}
function loadCol($con, $sql) {
    $out = []; $res = mysqli_query($con, $sql);
    if ($res) { while ($row = mysqli_fetch_row($res)) { if ($row[0] !== null && $row[0] !== '') $out[] = $row[0]; } }
    return $out;
}

// ---- reference data pulled from the live DB (keeps joins / lookups authentic) ----
$offices = loadCol($con, "SELECT DISTINCT LEFT(trans_id,9) FROM tbl_transaction WHERE trans_id REGEXP '^[0-9]{6}-[0-9]{2}-' LIMIT 40");
if (!$offices) { $offices = ['112402-01','118201-01','118602-01','112509-01']; }

$fundsources = loadCol($con, "SELECT DISTINCT fundsource FROM tbl_fundsource WHERE fundsource IS NOT NULL AND fundsource<>'' ORDER BY fundsource");
if (count($fundsources) < 3) { $fundsources = ['CV1','DC1','DC2','DC3','R1','OP','DS']; }

$glSign = loadCol($con, "SELECT signatory_id FROM signatory WHERE option_GL='1'");
if (!$glSign) { $glSign = loadCol($con, "SELECT signatory_id FROM signatory LIMIT 20"); }
if (!$glSign) { $glSign = ['18']; }

$encoders = loadCol($con, "SELECT encoded_encoder FROM tbl_transaction WHERE status_client='Done' AND encoded_encoder<>'' GROUP BY encoded_encoder ORDER BY COUNT(*) DESC LIMIT 150");
if (!$encoders) { $encoders = ['11-8144','11-6905']; }

$socialworkers = loadCol($con, "SELECT encoded_socialWork FROM tbl_transaction WHERE status_client='Done' AND encoded_socialWork<>'' GROUP BY encoded_socialWork ORDER BY COUNT(*) DESC LIMIT 150");
if (!$socialworkers) { $socialworkers = ['11-6470','11-6971']; }

$signatoryNames = loadCol($con, "SELECT CONCAT_WS(' ', first_name, middle_I, last_name) FROM signatory WHERE option_GL='1' AND first_name IS NOT NULL LIMIT 60");
if (!$signatoryNames) { $signatoryNames = ['JOHN EDWARD A. MAGBANUA']; }

// ---- static pools ----
$firstNames = ['JUAN','MARIA','JOSE','ANA','PEDRO','ROSA','MARK','GRACE','PAULO','LIEZL','RICO','JOY',
    'DANILO','CARMEN','ANTONIO','LUZ','RAMON','TERESITA','EDUARDO','NORA',' ALLAN','JOCELYN','ARNEL','MERCY',
    'FERNANDO','ANGELICA','ROLANDO','CRISTINA','BENJAMIN','ELENA','MICHAEL','JENNIFER','ROBERTO','EVELYN'];
$midNames   = ['SANTOS','REYES','CRUZ','BAUTISTA','OCAMPO','GARCIA','MENDOZA','TORRES','FLORES','RAMOS',
    'AQUINO','CASTRO','DELA CRUZ','VILLANUEVA','GONZALES','PASCUAL','FRANCISCO','GALANG','TOLENTINO','DOMINGO'];
$lastNames  = ['DELA CRUZ','SANTOS','REYES','GARCIA','MENDOZA','TORRES','FLORES','RAMOS','AQUINO','CASTRO',
    'VILLANUEVA','GONZALES','FERNANDEZ','MORALES','PEREZ','RIVERA','GOMEZ','DIAZ','HERNANDEZ','ROMERO',
    'NAVARRO','SALVADOR','AGUILAR','MARQUEZ','ANDRADA','ESPINOSA','BELTRAN','CABRERA','PANGANIBAN','SORIANO'];
$exNames    = ['','','','','JR.','SR.','III'];
$sexes      = [['MALE',1],['FEMALE',1]];
$civil      = [['SINGLE',4],['MARRIED',5],['WIDOWED',2],['SEPARATED',1]];
$occupations= ['FARMER','VENDOR','DRIVER','LABORER','HOUSEWIFE','TEACHER','FISHERMAN','CONSTRUCTION WORKER',
    'STORE HELPER','CAREGIVER','UNEMPLOYED','SELF-EMPLOYED','RETIRED','TRICYCLE DRIVER','SEAMSTRESS'];
$idTypes    = ['NATIONAL ID','DRIVERS LICENSE','PHILIPPINE PASSPORT','UMID','POSTAL ID','VOTERS ID','SENIOR CITIZEN ID','PWD ID'];
$relations  = [['Self',40],['MOTHER',9],['SON',8],['DAUGHTER',8],['FATHER',7],['HUSBAND',5],['WIFE',4],
    ['BROTHER',3],['SISTER',3],['COMMON-LAW',2],['AUNT',2],['COUSIN',2],['UNCLE',1],['NIECE',1],['NEPHEW',1],['GRANDMOTHER',1]];
$modeAdmission = [['Referral',72],['Walk-In',28]];
$programType   = [['0',55],['1',25],['',20]];
$clientType    = [['New',70],['Returning',30]];

// sector id => category text (from gis.php sectorToCategory)
$sectorToCategory = [
    1 => 'Family Heads and Other Needy Adult',
    2 => 'Men/Women in Specially Difficult Circumstances',
    3 => 'Persons with Disabilities',
    4 => 'Youth',
    5 => 'Senior Citizens',
    6 => 'Persons Living with HIV/AIDS',
    7 => 'Children in Need of Special Protection',
];
$sectorWeights = [[1,40],[2,33],[5,13],[4,5],[3,4],[7,3],[6,2]];

// Each transaction is SINGLE-MODE (all its assistance rows share one mode,
// GL or CAV) and its fund amounts sum to the full assistance amount. This is
// what makes the Charging Sources table (fund amounts per DISTINCT trans+mode)
// and the Assistance table (assistance amounts per mode) reconcile exactly.
$txnModePool = [['GL',53],['CAV',47]];
$glTypePool  = [['Medical Assistance',70],['Funeral Assistance',20],['Burial Assistance',10]];
$cavTypePool = [['Medical Assistance',24],['Food Subsidy Assistance',24],['Cash Relief Assistance',11],
                ['Educational Assistance',10],['Other Cash Assistance',8],['Transportation Assistance',7],
                ['Funeral Assistance',6],['Material Assistance',6],['Burial Assistance',4]];

$purposes = ['MEDICINE','HOSPITAL BILL','LABORATORY','FOOD','TRANSPORTATION','SCHOOL ALLOWANCE',
    'FUNERAL SERVICE','MEDICAL SUPPLIES','DIALYSIS','CHEMOTHERAPY','RENTAL','UTILITY BILL'];
$causeOfDeath = ['CARDIAC ARREST','PNEUMONIA','CANCER','MULTIPLE ORGAN FAILURE','SEPSIS','STROKE','RENAL FAILURE'];
$region = 'Region XI (Davao Region)';
$province = 'Davao de Oro';
$municipalities = ['Nabunturan','Monkayo','Montevista','Compostela','New Bataan','Pantukan','Maco','Mabini','Maragusan','Laak'];
$street = 'Purok 1';

function randAmount() {
    // realistic multiples; occasional larger GL amount
    $base = [1000,1500,2000,2500,3000,4000,5000,6000,8000,10000,12000,15000,20000,25000,30000];
    $amt = $base[array_rand($base)];
    if (mt_rand(1,100) <= 8) { $amt = mt_rand(31,60) * 1000; } // some > 30k
    return $amt;
}
/** split an integer amount into $n parts (each >= 100, multiple of 100) summing exactly to amount */
function splitAmount($amount, $n) {
    if ($n <= 1) return [$amount];
    $units = intdiv($amount, 100);         // work in hundreds
    if ($units < $n) return [$amount];     // too small to split
    $parts = array_fill(0, $n, 1);
    $remaining = $units - $n;
    for ($k = 0; $k < $n - 1; $k++) {
        $take = mt_rand(0, $remaining);
        $parts[$k] += $take;
        $remaining -= $take;
    }
    $parts[$n - 1] += $remaining;
    return array_map(function ($u) { return $u * 100; }, $parts);
}
function randDateInNov($year, $month) {
    $day = mt_rand(1, 30);
    $h = mt_rand(7, 16); $mi = mt_rand(0, 59); $s = mt_rand(0, 59);
    return mktime($h, $mi, $s, $month, $day, $year);
}

$logFile = __DIR__ . '/seeded_trans_ids_nov2026.txt';
$logFh = fopen($logFile, 'a');

echo "Seeding {$TOTAL} Nov {$YEAR} 'Done' transactions...\n";
echo "Offices:" . count($offices) . " Funds:" . count($fundsources) . " GLsign:" . count($glSign)
   . " Encoders:" . count($encoders) . " SW:" . count($socialworkers) . "\n";

$start = microtime(true);
mysqli_autocommit($con, false);
$done = 0;

try {
    for ($i = 0; $i < $TOTAL; $i++) {
        // ---------- dates ----------
        $enteredTs = randDateInNov($YEAR, $MONTH);
        $endOfNov  = mktime(23, 59, 0, $MONTH, 30, $YEAR);
        $accTs     = min($enteredTs + mt_rand(600, 3 * 86400), $endOfNov);
        $dateEntered = date('Y-m-d H:i:s', $enteredTs);
        $dateAcc     = date('Y-m-d H:i:s', $accTs);
        $dateBirth   = date('Y-m-d', mktime(0, 0, 0, mt_rand(1, 12), mt_rand(1, 28), mt_rand(1945, 2007)));

        // ---------- identity / ids ----------
        $office   = pick($offices);
        $transId  = $office . '-' . date('YmdHis', $enteredTs) . sprintf('%06d', $i);

        $fn = trim(pick($firstNames)); $mn = pick($midNames); $ln = pick($lastNames); $ex = pick($exNames);
        $sex = pickw($sexes); $cstat = pickw($civil); $occ = pick($occupations);
        $salary = (string)(mt_rand(0, 25) * 1000);
        $contact = '09' . mt_rand(100000000, 999999999);
        $muni = pick($municipalities);

        $relation = pickw($relations);
        $hasBene  = ($relation !== 'Self');

        $sector   = pickw($sectorWeights);
        $category = $sectorToCategory[$sector];
        $program  = pickw($programType);
        $typeClient = pickw($clientType);
        $encoder  = pick($encoders);
        $sworker  = pick($socialworkers);
        $sign     = pick($glSign);
        $modeAdm  = pickw($modeAdmission);

        // ---------- ENCODING: client_data ----------
        q($con, "INSERT INTO client_data (lastname, firstname, middlename, extraname, sex, civil_status, date_birth,
                 occupation, salary, contact, category, subCategory, client_region, client_province, client_municipality,
                 client_barangay, client_street, client_district, date_inserted)
                 VALUES ('".esc($con,$ln)."','".esc($con,$fn)."','".esc($con,$mn)."','".esc($con,$ex)."','".esc($con,$sex)."',
                 '".esc($con,$cstat)."','{$dateBirth}','".esc($con,$occ)."','{$salary}','{$contact}','".esc($con,$category)."',
                 '".esc($con,$category)."','".esc($con,$region)."','".esc($con,$province)."','".esc($con,$muni)."',
                 'Barangay ".mt_rand(1,12)."','".esc($con,$street)."','1st District','{$dateEntered}')");
        $clientAi = mysqli_insert_id($con);
        $clientId = 'C-' . $clientAi;
        q($con, "UPDATE client_data SET client_id='{$clientId}' WHERE auto_increment_4_id={$clientAi}");

        // ---------- ENCODING: beneficiary_data (when relation != Self) ----------
        $beneId = null;
        if ($hasBene) {
            $bfn = pick($firstNames); $bmn = pick($midNames); $bln = $ln; $bex = pick($exNames);
            $bsex = pickw($sexes); $bbday = date('Y-m-d', mktime(0,0,0, mt_rand(1,12), mt_rand(1,28), mt_rand(1945,2010)));
            q($con, "INSERT INTO beneficiary_data (b_fname, b_mname, b_lname, b_exname, b_civilStatus, b_contact, b_bday,
                     b_sex, b_occupation, b_salary, b_category, b_region, b_province, b_municipality, b_barangay,
                     b_district, b_street, b_date_inserted)
                     VALUES ('".esc($con,$bfn)."','".esc($con,$bmn)."','".esc($con,$bln)."','".esc($con,$bex)."',
                     '".esc($con,pickw($civil))."','{$contact}','{$bbday}','".esc($con,$bsex)."','".esc($con,pick($occupations))."',
                     '0','".esc($con,$category)."','".esc($con,$region)."','".esc($con,$province)."','".esc($con,$muni)."',
                     'Barangay ".mt_rand(1,12)."','1st District','".esc($con,$street)."','{$dateEntered}')");
            $beneAi = mysqli_insert_id($con);
            $beneId = 'B-' . $beneAi;
            q($con, "UPDATE beneficiary_data SET bene_id='{$beneId}' WHERE auto_increment_id_bene={$beneAi}");
        }

        // ---------- ENCODING: tbl_transaction (tagged for cleanup) ----------
        $beneCol  = $hasBene ? "'".esc($con,$beneId)."'" : "NULL";
        $csb      = $hasBene ? '1' : 'NULL';
        $btc      = $hasBene ? '1' : 'NULL';
        $progVal  = ($program === '') ? 'NULL' : "'".esc($con,$program)."'";
        q($con, "INSERT INTO tbl_transaction (trans_id, client_id, bene_id, relation, date_entered, date_accomplished,
                 note, program_type, type_of_client, status_client, encoded_encoder, encoded_socialWork, signatory_id,
                 signatory_GL, remarks, clientonly, clientsamebene, benetoclient)
                 VALUES ('".esc($con,$transId)."','{$clientId}', {$beneCol}, '".esc($con,$relation)."','{$dateEntered}',
                 '{$dateAcc}','SEEDER', {$progVal}, '".esc($con,$typeClient)."','Done','".esc($con,$encoder)."',
                 '".esc($con,$sworker)."','".esc($con,$sign)."','".esc($con,$sign)."','SEEDED NOV2026', 1, {$csb}, {$btc})");

        // ---------- SOCIAL WORK: service ----------
        $refName = ($modeAdm === 'Referral') ? esc($con, $muni . ' MSWDO') : '';
        q($con, "INSERT INTO service (trans_id, service1, service2, service3, service4, service5, service6, ref_name)
                 VALUES ('".esc($con,$transId)."', ".mt_rand(1,6).", 0, 0, 0, 0, 0, '{$refName}')");

        // ---------- SOCIAL WORK: assessment ----------
        $problem = 'Client sought assistance for ' . strtolower(pick($purposes)) . '.';
        $socAss  = 'Assessed as eligible; assistance recommended and granted.';
        q($con, "INSERT INTO assessment (trans_id, gis_option, target_sector, subcat_ass, problem, soc_ass, mode_admission, client_num)
                 VALUES ('".esc($con,$transId)."','1','{$sector}','".esc($con,$category)."','".esc($con,$problem)."',
                 '".esc($con,$socAss)."','".esc($con,$modeAdm)."', ".mt_rand(1,6).")");

        // ---------- SOCIAL WORK: assistance (single mode per txn) ----------
        $txnMode  = pickw($txnModePool);
        $typePool = ($txnMode === 'GL') ? $glTypePool : $cavTypePool;
        $type1   = pickw($typePool);
        $amount1 = randAmount();
        $pur1 = pick($purposes);
        $ifMedical = (stripos($type1, 'Medical') !== false) ? 'Medicine/Hospitalization' : '';
        $ifBurial  = (stripos($type1, 'Funeral') !== false || stripos($type1, 'Burial') !== false) ? 'Funeral Service' : '';
        $cod       = ($ifBurial !== '') ? pick($causeOfDeath) : '';
        q($con, "INSERT INTO assistance (trans_id, type, if_medical, if_burial, cause_of_death, free_funeral_service,
                 financial, material, amount, mode, fund, purpose, type_description)
                 VALUES ('".esc($con,$transId)."','".esc($con,$type1)."','".esc($con,$ifMedical)."','".esc($con,$ifBurial)."',
                 '".esc($con,$cod)."','', '', '', '".esc($con,number_format($amount1,2))."','".esc($con,$txnMode)."','', '".esc($con,$pur1)."','Type1')");

        $hasType2 = (mt_rand(1,100) <= 8);
        $amount2 = 0;
        if ($hasType2) {
            $type2 = pickw($typePool);           // same mode as Type1 so the txn stays single-mode
            $amount2 = randAmount();
            q($con, "INSERT INTO assistance (trans_id, type, amount, mode, fund, purpose, type_description)
                     VALUES ('".esc($con,$transId)."','".esc($con,$type2)."','".esc($con,number_format($amount2,2))."',
                     '".esc($con,$txnMode)."','', '".esc($con,pick($purposes))."','Type2')");
        }

        // ---------- SOCIAL WORK: tbl_coe_fund (funds balance to the FULL assistance amount) ----------
        $totalAmt = $amount1 + $amount2;
        $nFunds = pickw([[1,60],[2,30],[3,10]]);
        $fundPick = (array)array_rand(array_flip($fundsources), min($nFunds, count($fundsources)));
        $nFunds = count($fundPick);
        $parts = splitAmount($totalAmt, $nFunds);
        $fundRows = [];
        foreach ($fundPick as $idx => $fsName) {
            $fsAmt = number_format($parts[$idx], 2);
            $fundRows[] = "('".esc($con,$transId)."','".esc($con,$fsName)."','".esc($con,$fsAmt)."')";
        }
        q($con, "INSERT INTO tbl_coe_fund (trans_id, fundsource, fs_amount) VALUES " . implode(',', $fundRows));

        // ---------- SOCIAL WORK: other_client_information + source_of_income ----------
        q($con, "INSERT INTO other_client_information (trans_id, otherClientInformation, crisisSeverityQuestion1,
                 crisisSeverityQuestion2, crisisSeverityQuestion3, supportSystemAvailability, externalResources, selfHelp, vulnerability_riskFactor)
                 VALUES ('".esc($con,$transId)."','', '".mt_rand(1,3)."','".mt_rand(1,3)."','".mt_rand(1,3)."',
                 '".mt_rand(1,2)."','".mt_rand(1,2)."','".mt_rand(1,2)."','".mt_rand(1,3)."')");
        q($con, "INSERT INTO source_of_income (trans_id, wage, profit, domestic_source, abroad, government_transfer, pension, other_income)
                 VALUES ('".esc($con,$transId)."','".(mt_rand(0,1)?esc($con,$salary):'')."','', '', '', '', '', '')");

        // ---------- SOCIAL WORK: family (only when there is a beneficiary) ----------
        if ($hasBene && mt_rand(1,100) <= 70) {
            $members = mt_rand(1, 4); $fam = [];
            for ($m = 0; $m < $members; $m++) {
                $fam[] = "('".esc($con,$transId)."','".esc($con,pick($firstNames).' '.$ln)."','".esc($con,pick(['SON','DAUGHTER','SPOUSE','PARENT','SIBLING']))."',"
                       . mt_rand(1,80) . ",'".esc($con,pick($occupations))."','".(mt_rand(0,15)*1000)."')";
            }
            q($con, "INSERT INTO family (trans_id, name, relation_bene, age, occupation, salary) VALUES " . implode(',', $fam));
        }

        // ---------- FINISH: coe certificate ----------
        $idType = pick($idTypes);
        $signName = pick($signatoryNames);
        $document = esc($con, "{$signName}-Valid ID:-{$idType}-SUPPORTING DOCUMENTS-Save-");
        q($con, "INSERT INTO coe (trans_id, document, id_presented, others_input)
                 VALUES ('".esc($con,$transId)."','{$document}','".esc($con,$idType)."','".esc($con,$idType)."')");

        fwrite($logFh, $transId . "\n");
        $done++;

        if ($done % 1000 === 0) {
            mysqli_commit($con);
            $rate = $done / max(0.001, microtime(true) - $start);
            printf("  %6d / %d  (%.0f/s)\n", $done, $TOTAL, $rate);
        }
    }
    mysqli_commit($con);
} catch (Throwable $e) {
    mysqli_rollback($con);
    fclose($logFh);
    die("\nABORTED after {$done} records (rolled back current batch): " . $e->getMessage() . "\n");
}

fclose($logFh);
$elapsed = microtime(true) - $start;
printf("\nDONE. Inserted %d transactions in %.1fs.\n", $done, $elapsed);
echo "trans_ids logged to: {$logFile}\n";
echo "To remove everything: php seeder/cleanup_nov2026.php\n";
