<?php
/**
 * Cleanup for seed_nov2026.php.
 *
 * Removes every row the seeder created, identified by the tag
 *   tbl_transaction.note = 'SEEDER' AND remarks = 'SEEDED NOV2026'
 * and the client_id / bene_id those transactions point to.
 *
 * USAGE (CLI only):
 *   php seeder/cleanup_nov2026.php          # dry run: just prints counts
 *   php seeder/cleanup_nov2026.php yes       # actually delete
 */

if (php_sapi_name() !== 'cli') { die("CLI only.\n"); }
require __DIR__ . '/../php/config.php';

$confirm = (isset($argv[1]) && strtolower($argv[1]) === 'yes');

mysqli_report(MYSQLI_REPORT_OFF);
$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
if (!$con) { die("DB connection failed: " . mysqli_connect_error() . "\n"); }
mysqli_set_charset($con, 'latin1');

function q($con, $sql) {
    if (!mysqli_query($con, $sql)) { die("Query failed: " . mysqli_error($con) . "\nSQL: " . substr($sql,0,200) . "\n"); }
}
function scalar($con, $sql) { $r = mysqli_query($con, $sql); $row = $r ? mysqli_fetch_row($r) : [0]; return $row[0]; }

$tagWhere = "note='SEEDER' AND remarks='SEEDED NOV2026'";
$count = (int)scalar($con, "SELECT COUNT(*) FROM tbl_transaction WHERE {$tagWhere}");
echo "Seeded transactions found: {$count}\n";
if ($count === 0) { echo "Nothing to clean.\n"; exit; }

if (!$confirm) {
    echo "Dry run. Re-run with 'yes' to delete:\n  php seeder/cleanup_nov2026.php yes\n";
    exit;
}

// Indexed temp table so the IN (subquery) deletes below use a key lookup
// instead of degenerating into a per-row rescan (some child tables, e.g.
// other_client_information / family, have no index on trans_id).
q($con, "DROP TEMPORARY TABLE IF EXISTS _seed_ids");
q($con, "CREATE TEMPORARY TABLE _seed_ids (
             trans_id  VARCHAR(40) NOT NULL,
             client_id VARCHAR(30) NULL,
             bene_id   VARCHAR(30) NULL,
             PRIMARY KEY (trans_id),
             KEY k_client (client_id),
             KEY k_bene (bene_id)
         ) ENGINE=InnoDB");
q($con, "INSERT INTO _seed_ids (trans_id, client_id, bene_id)
         SELECT trans_id, client_id, bene_id FROM tbl_transaction WHERE {$tagWhere}");

$childTables = ['service','assessment','assistance','other_client_information','source_of_income','tbl_coe_fund','coe','family'];
foreach ($childTables as $t) {
    q($con, "DELETE FROM {$t} WHERE trans_id IN (SELECT trans_id FROM _seed_ids)");
    echo "  cleared {$t}\n";
}

q($con, "DELETE FROM client_data WHERE client_id IN (SELECT client_id FROM _seed_ids WHERE client_id IS NOT NULL)");
echo "  cleared client_data\n";
q($con, "DELETE FROM beneficiary_data WHERE bene_id IN (SELECT bene_id FROM _seed_ids WHERE bene_id IS NOT NULL)");
echo "  cleared beneficiary_data\n";
q($con, "DELETE FROM tbl_transaction WHERE {$tagWhere}");
echo "  cleared tbl_transaction\n";

echo "Cleanup complete. Removed {$count} seeded transactions and their related rows.\n";
