<?php
require '../vendor/autoload.php';
include('../php/class.user.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

session_start();
$user = new User();

$fromdate = isset($_GET['fromdate']) ? date("Y-m-d", strtotime($_GET['fromdate'])) : null;
$todate = isset($_GET['todate']) ? date("Y-m-d", strtotime($_GET['todate'])) : null;

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

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

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

$sheet->fromArray($headers, NULL, 'A1');

$rowNum = 2;

while ($row = mysqli_fetch_assoc($result)) {
    $fullname = $user->getuserFullname($row['encoded_encoder']);
    $assistance = $user->getAssistanceData($row['trans_id']);
    $fundsource = $user->getfundsourceclient($row['trans_id']);
    $fund = $user->getfundsourcedata($row['trans_id']);

    $lname = $row['bene_id'] ? $row['b_lname'] : "";
    $fname = $row['bene_id'] ? $row['b_fname'] : "";
    $mname = $row['bene_id'] ? $row['b_mname'] : "";
    $ename = $row['bene_id'] ? $row['b_exname'] : "";

    $rowData = [
        $row['date_entered'], $fullname, $row['control_no'], $row['date_accomplished'],
        $row['client_region'], $row['client_province'], $row['client_municipality'], $row['client_barangay'],
        $row['client_district'], $row['lastname'], $row['firstname'], $row['middlename'], $row['extraname'],
        $row['sex'], $row['civil_status'], $row['date_birth'], $user->getAge($row['date_birth']),
        $row['familycount'], $row['occupation'], $row['salary'], $row['mode_admission'],
        $user->translateAss($assistance[1]['type'] ?? ''),
        $assistance[1]['amount'] ?? '',
        (!empty($fund[1]['type']) ? $fundsource : ''),
        (($assistance[1]['mode'] ?? '') === "GL" ? "Guarantee Letter" : (($assistance[1]['mode'] ?? '') === "CAV" ? 'Outright Cash' : ($assistance[1]['mode'] ?? ''))),

        $user->translateAss($assistance[2]['type'] ?? ''),
        $assistance[2]['amount'] ?? '',
        (!empty($fund[2]['type']) ? $fundsource : ''),
        (($assistance[2]['mode'] ?? '') === "GL" ? "Guarantee Letter" : (($assistance[2]['mode'] ?? '') === "CAV" ? 'Outright Cash' : ($assistance[2]['mode'] ?? ''))),

        $user->translateAss($assistance[3]['type'] ?? ''),
        $assistance[3]['amount'] ?? '',
        (!empty($fund[3]['type']) ? $fundsource : ''),
        (($assistance[3]['mode'] ?? '') === "GL" ? "Guarantee Letter" : (($assistance[3]['mode'] ?? '') === "CAV" ? 'Outright Cash' : ($assistance[3]['mode'] ?? ''))),
        $row['category'], $row['cname'], $lname, $fname, $mname, $ename, $row['subCategory'], $row['pantawid_bene']
    ];

    $sheet->fromArray($rowData, NULL, 'A' . $rowNum);
    $rowNum++;
}

if ($rowNum > 2) {
    $filename = date("M d", strtotime($from_date)) . "-" . date("M d Y", strtotime($to_date)) . " Export.xlsx";
    
    ob_end_clean(); 
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment; filename=\"$filename\"");
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
} else {
    echo "<script>alert('NO TRANSACTION MADE ON THIS DATE!');
    window.location.href='export.php';</script>";
}
?>
