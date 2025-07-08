<?php
include('../php/class.user.php');

$user = new User();

$fromdate = isset($_GET['fromdate']) ? date("Y-m-d", strtotime($_GET['fromdate'])) : null;
$todate = isset($_GET['todate']) ? date("Y-m-d", strtotime($_GET['todate'])) : null;

// Validate that dates are provided
if (empty($fromdate) || empty($todate)) {
    echo "<script>alert('Please provide both From Date and To Date!');
    window.location.href='export.php';</script>";
    exit;
}

$from_date = $fromdate . " 00:00:00";
$to_date = $todate . " 23:59:00";
$office_loc = $_SESSION['f_office'];

$query = "SELECT client_id, trans_id, date_entered, encoded_encoder, control_no, client_data.occupation, client_data.salary, 
        date_accomplished, mode, bene_id, client_region, client_province, client_municipality, client_barangay, client_district,
        lastname, firstname, middlename, extraname, sex, civil_status, date_birth, mode_admission, category, 
        b_lname, b_fname, b_mname, b_exname, cname, subCategory, pantawid_bene, status_client, COUNT(family.name) AS familycount
        FROM client_data
        INNER JOIN tbl_transaction USING (client_id)
        LEFT OUTER JOIN beneficiary_data USING (bene_id)
        INNER JOIN assessment USING (trans_id)
        INNER JOIN assistance USING (trans_id)
        LEFT JOIN family USING (trans_id)
        LEFT OUTER JOIN gl USING (trans_id)
        WHERE (LEFT(trans_id, 9) = '$office_loc') 
          AND (date_accomplished BETWEEN '{$from_date}' and '{$to_date}') 
          AND status_client = 'Done' 
        GROUP BY client_id, trans_id, date_entered, encoded_encoder, control_no, occupation, salary, 
        date_accomplished, mode, bene_id, client_region, client_province, 
        client_municipality, client_barangay, client_district, lastname, 
        firstname, middlename, extraname, sex, civil_status, date_birth, 
        mode_admission, category, b_lname, b_fname, b_mname, b_exname, cname, 
        subCategory, pantawid_bene, status_client
        ORDER BY tbl_transaction.date_entered ASC";

$result = mysqli_query($user->db, $query);

// Check if any rows are returned before proceeding
if (mysqli_num_rows($result) === 0) {
    echo "<script>alert('NO TRANSACTION MADE ON THIS DATE RANGE!');
    window.location.href='export.php';</script>";
    exit;
}

// Prepare the filename
$filename = date("M d", strtotime($fromdate)) . "-" . date("M d Y", strtotime($todate)) . " Export.csv";

// Set headers for CSV download
header('Content-Type: text/csv');
header("Content-Disposition: attachment; filename=\"$filename\"");
header('Cache-Control: no-cache, no-store, must-revalidate'); // Standard cache control
header('Pragma: no-cache'); // For HTTP 1.0
header('Expires: 0'); // Proxies

// Open a file handle for outputting to the browser
$output = fopen('php://output', 'w');

// Column headers
$headers = [
    "Date Entered", "Entered By", "Client No", "Date Accomplished", "Region", "Province",
    "City/Municipality", "Barangay", "District", "LastName", "FirstName", "MiddleName", "ExtraName",
    "Sex", "CivilStatus", "DOB", "Age", "Occupation", "Salary", "Number of Family Member",
    "ModeOfAdmission", "Type of Assistance1", "Amount1", "Source of Fund1", "Mode of Release1",
    "Type of Assistance2", "Amount2", "Source of Fund2", "Mode of Release2",
    "Type of Assistance3", "Amount3", "Source of Fund3", "Mode of Release3", 
    "ClientCategory", "SERVICE PROVIDERS", "B. LAST NAME", "B. FIRST NAME", "B. MIDDLE NAME", "B. EXT.",
    "Sub-Category", "Pantawid Beneficiary"
];
// Write the headers to the CSV file with explicit escape parameter
fputcsv($output, $headers, ',', '"', '\\');

// Populate data rows
while ($row = mysqli_fetch_assoc($result)) {
    $fullname = $user->getuserFullname($row['encoded_encoder']);
    $assistance = $user->getAssistanceData($row['trans_id']);
    $fundsource = $user->getfundsourceclient($row['trans_id']);
    // $fund = $user->getfundsourcedata($row['trans_id']); // This variable seems unused, consider removing or confirming its purpose

    $lname = $row['bene_id'] ? $row['b_lname'] : "";
    $fname = $row['bene_id'] ? $row['b_fname'] : "";
    $mname = $row['bene_id'] ? $row['b_mname'] : "";
    $ename = $row['bene_id'] ? $row['b_exname'] : "";

    $rowData = [
        $row['date_entered'], $fullname, $row['control_no'], $row['date_accomplished'],
        $row['client_region'], $row['client_province'], $row['client_municipality'], $row['client_barangay'],
        $row['client_district'], $row['lastname'], $row['firstname'], $row['middlename'], $row['extraname'],
        $row['sex'], $row['civil_status'], $row['date_birth'], $user->getAge($row['date_birth']),
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
        $row['category'], $row['cname'], $lname, $fname, $mname, $ename, $row['subCategory'], $row['pantawid_bene']
    ];

    // Write the row data to the CSV file with explicit escape parameter
    fputcsv($output, $rowData, ',', '"', '\\');
}

// Close the file handle
fclose($output);
exit;
?>
