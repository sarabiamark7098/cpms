<?php
include('../php/class.user.php');

$user = new User();

// Set MySQL connection charset to UTF-8 to ensure proper encoding
mysqli_set_charset($user->db, 'utf8mb4');

$from_date = isset($_GET['fromdate']) ? date("Y-m-d 00:00:00", strtotime($_GET['fromdate'])) : null;
$to_date = isset($_GET['todate']) ? date("Y-m-d 23:59:00", strtotime($_GET['todate'])) : null;

// Validate that dates are provided
if (empty($from_date) || empty($to_date)) {
    echo "<script>alert('Please provide both From Date and To Date!');
    window.location.href='export.php';</script>";
    exit;
}
$office_loc = $_SESSION['f_office'];

$query = "SELECT cd.client_id, t.trans_id, t.date_entered, t.encoded_encoder, MAX(g.control_no) AS control_no, cd.occupation, cd.salary, 
        t.date_accomplished, bd.bene_id, cd.client_region, cd.client_province, cd.client_municipality, cd.client_barangay, cd.client_district,
        cd.lastname, cd.firstname, cd.middlename, cd.extraname, cd.sex, cd.civil_status, cd.date_birth, ass.mode_admission, cd.category, cd.subCategory,
        bd.b_lname, bd.b_fname, bd.b_mname, bd.b_exname, MAX(g.cname) AS cname, bd.b_bday, bd.b_sex, bd.b_category, t.pantawid_bene, 
        t.status_client, t.program_type, t.other_program, COUNT(f.name) AS familycount
        FROM client_data AS cd
        INNER JOIN tbl_transaction as t USING (client_id)
        LEFT OUTER JOIN beneficiary_data as bd USING (bene_id)
        INNER JOIN assessment as ass USING (trans_id)
        INNER JOIN assistance as ast USING (trans_id)
        LEFT JOIN family as f USING (trans_id)
        LEFT OUTER JOIN gl as g USING (trans_id)
        WHERE (LEFT(t.trans_id, 9) = '$office_loc') 
          AND (t.date_accomplished BETWEEN '{$from_date}' and '{$to_date}') 
          AND t.status_client = 'Done' 
        GROUP BY cd.client_id, t.trans_id, t.date_entered, t.encoded_encoder, cd.occupation, cd.salary, 
        t.date_accomplished, bd.bene_id, cd.client_region, cd.client_province, 
        cd.client_municipality, cd.client_barangay, cd.client_district, cd.lastname, 
        cd.firstname, cd.middlename, cd.extraname, cd.sex, cd.civil_status, cd.date_birth, 
        ass.mode_admission, cd.category, bd.b_lname, bd.b_fname, 
        bd.b_mname, bd.b_exname, bd.b_bday, 
        bd.b_sex, bd.b_category, 
        cd.subCategory, t.pantawid_bene, t.status_client, t.program_type, t.other_program
        ORDER BY t.date_entered ASC";

$result = mysqli_query($user->db, $query);

// Check if any rows are returned before proceeding
if (mysqli_num_rows($result) === 0) {
    echo "<script>alert('NO TRANSACTION MADE ON THIS DATE RANGE!');
    window.location.href='export.php';</script>";
    exit;
}

// Prepare the filename
$filename = date("M d", strtotime($from_date)) . "-" . date("M d Y", strtotime($to_date)) . " Export.csv";

// Set headers for CSV download (UTF-8)
header('Content-Type: text/csv; charset=UTF-8');
header("Content-Disposition: attachment; filename=\"{$filename}\"");
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

// Open a file handle for outputting to the browser
$output = fopen('php://output', 'w');

// Output UTF-8 BOM
fwrite($output, "\xEF\xBB\xBF");

// Column headers
$headers = [
    "Date Entered", "Entered By", "Client No", "Date Accomplished", "Region", "Province",
    "City/Municipality", "Barangay", "District", "LastName", "FirstName", "MiddleName", "ExtraName",
    "Sex", "CivilStatus", "DOB", "Age", "Occupation", "Salary", "Number of Family Member",
    "ModeOfAdmission", "Type of Assistance1", "Amount1", "Source of Fund1", "Mode of Release1",
    "Type of Assistance2", "Amount2", "Source of Fund2", "Mode of Release2",
    "Type of Assistance3", "Amount3", "Source of Fund3", "Mode of Release3", 
    "ClientCategory", "SERVICE PROVIDERS", "B. LAST NAME", "B. FIRST NAME", "B. MIDDLE NAME", "B. EXT.",
    "B. DOB", "B. AGE", "B. SEX", "B. CATEGORY",
    "Sub-Category", "Pantawid Beneficiary", 
    "CLient Birth Day", "Client Birth Month", "Client Birth Year", "Beneficiary Birth Day", "Beneficiary Birth Month", "Beneficiary Birth Year"
];

fputcsv($output, $headers, ',', '"', '\\');

// Populate data rows
$__CHUNK = 2000;                      // stream in chunks: bounded memory
$__buf = [];
$__seen = [];
while (true) {
    $__r = mysqli_fetch_assoc($result);
    if ($__r !== null) { $__buf[] = $__r; }
    if (count($__buf) >= $__CHUNK || ($__r === null && !empty($__buf))) {
        $assistMap = $user->getAssistanceDataBatch(array_column($__buf, 'trans_id'));
        foreach ($__buf as $row) {
            if (isset($__seen[$row['trans_id']])) { continue; } // trans_id must be unique in the export
            $__seen[$row['trans_id']] = true;
    $fullname = $user->getuserFullname($row['encoded_encoder']);
    $assistance = $assistMap[$row['trans_id']] ?? null;
    $fundsource = $user->fundSourceLabel($row['program_type'] ?? '', $row['other_program'] ?? '', $row['date_accomplished']);
    
    $age = $user->calculate_age_by_date_accomplished($row['date_birth'], $row['date_accomplished']);
    $b_age = $user->calculate_age_by_date_accomplished($row['b_bday'], $row['date_accomplished']);

    $client_bday = $row['date_birth'] ? date('d', strtotime($row['date_birth'])) : '';
    $client_bmonth = $row['date_birth'] ? date('m', strtotime($row['date_birth'])) : '';
    $client_byear = $row['date_birth'] ? date('Y', strtotime($row['date_birth'])) : '';
    $beneficiary_bday = $row['b_bday'] ? date('d', strtotime($row['b_bday'])) : '';
    $beneficiary_bmonth = $row['b_bday'] ? date('m', strtotime($row['b_bday'])) : '';
    $beneficiary_byear = $row['b_bday'] ? date('Y', strtotime($row['b_bday'])) : '';

    $formatted_date_entered = $row['date_entered'] ? date('d/m/Y', strtotime($row['date_entered'])) : '';
    $formatted_date_accomplished = $row['date_accomplished'] ? date('d/m/Y', strtotime($row['date_accomplished'])) : '';
    $formatted_bday = $row['date_birth'] ? date('m/d/Y', strtotime($row['date_birth'])) : '';
    $formatted_b_bday = $row['b_bday'] ? date('m/d/Y', strtotime($row['b_bday'])) : '';
    
    $lname = $row['bene_id'] ? $row['b_lname'] : "";
    $fname = $row['bene_id'] ? $row['b_fname'] : "";
    $mname = $row['bene_id'] ? $row['b_mname'] : "";
    $ename = $row['bene_id'] ? $row['b_exname'] : "";

    $rowData = [
        $formatted_date_entered, $fullname, $row['control_no'], $formatted_date_accomplished,
        $row['client_region'], $row['client_province'], $row['client_municipality'], $row['client_barangay'],
        $row['client_district'], $row['lastname'], $row['firstname'], $row['middlename'], $row['extraname'],
        $row['sex'], $row['civil_status'], $formatted_bday, $age,
        $row['occupation'], $row['salary'], $row['familycount'], $row['mode_admission'],
        $user->translateAss($assistance[1]['type'] ?? ''),
        $assistance[1]['amount'] ?? '',
        (!empty($assistance[1]['type']) ? $fundsource : ''),
        (($assistance[1]['mode'] ?? '') === "GL" ? "Guarantee Letter" : (($assistance[1]['mode'] ?? '') === "CAV" ? 'Outright Cash' : ($assistance[1]['mode'] ?? ''))),

        $user->translateAss($assistance[2]['type'] ?? ''),
        $assistance[2]['amount'] ?? '',
        (!empty($assistance[2]['type']) ? $fundsource : ''),
        (($assistance[2]['mode'] ?? '') === "GL" ? "Guarantee Letter" : (($assistance[2]['mode'] ?? '') === "CAV" ? 'Outright Cash' : ($assistance[2]['mode'] ?? ''))),

        $user->translateAss($assistance[3]['type'] ?? ''),
        $assistance[3]['amount'] ?? '',
        (!empty($assistance[3]['type']) ? $fundsource : ''),
        (($assistance[3]['mode'] ?? '') === "GL" ? "Guarantee Letter" : (($assistance[3]['mode'] ?? '') === "CAV" ? 'Outright Cash' : ($assistance[3]['mode'] ?? ''))),
        $row['category'], $row['cname'], $lname, $fname, $mname, $ename, $formatted_b_bday, $b_age, $row['b_sex'], $row['b_category'], $row['subCategory'], $row['pantawid_bene'],
        $client_bday, $client_bmonth, $client_byear, $beneficiary_bday, $beneficiary_bmonth, $beneficiary_byear
    ];

    fputcsv($output, $rowData, ',', '"', '\\');
        }
        $__buf = [];
    }
    if ($__r === null) { break; }
}

// Close the file handle
fclose($output);
exit;
?>
