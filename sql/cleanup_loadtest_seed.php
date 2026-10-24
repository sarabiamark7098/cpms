<?php
/**
 * Removes ALL load-test seed data (rows whose trans_id contains "-SEED").
 * Run from CLI:  php sql/cleanup_loadtest_seed.php
 * Does not touch real records.
 */
require __DIR__.'/../php/config.php';
$db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
if (!$db) { exit("CONNECT FAIL\n"); }

foreach (['assistance','tbl_coe_fund','tbl_transaction'] as $t) {
    $before = mysqli_fetch_assoc(mysqli_query($db,"SELECT COUNT(*) c FROM `$t` WHERE trans_id LIKE '%-SEED%'"))['c'];
    mysqli_query($db, "DELETE FROM `$t` WHERE trans_id LIKE '%-SEED%'") or die("ERR $t: ".mysqli_error($db)."\n");
    echo "deleted $before seed rows from $t\n";
}
echo "done.\n";
