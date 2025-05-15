<?php
require '../vendor/autoload.php';
include('../php/class.user.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$user = new User();
$office_loc = $_SESSION['f_office'];

$date = $_GET['date'] ?? date('Y-m-d');
$file = date("F d Y", strtotime($date));
$filename =  $file . " Export";

$fromdate = date("Y-m-d", strtotime($date));
$todate = date("Y-m-d", strtotime($date));
$date1 = $fromdate . " 00:00:00";
$date2 = $todate . " 23:59:00";

$query = "SELECT client_id, trans_id, date_entered, encoded_encoder, control_no, client_data.occupation, client_data.salary, date_accomplished, mode, bene_id, 
    client_region, client_province, client_municipality, client_barangay, client_district,
    lastname, firstname, middlename, extraname, sex, civil_status, date_birth, mode_admission, category, 
    b_lname, b_fname, b_mname, b_exname, cname, subCategory, pantawid_bene, status_client, COUNT(family.name) AS familycount
    FROM client_data
    INNER JOIN tbl_transaction USING (client_id)
    LEFT OUTER JOIN beneficiary_data USING (bene_id)
    INNER JOIN assessment USING (trans_id)
    INNER JOIN assistance USING (trans_id)
    LEFT JOIN family USING (trans_id)
    LEFT OUTER JOIN gl USING (trans_id)
    WHERE (Left(trans_id, 9) = '$office_loc') AND (date_accomplished BETWEEN '{$date1}' and '{$date2}') and status_client = 'Done' 
    GROUP BY client_id, trans_id, date_entered, encoded_encoder, control_no, occupation, salary, 
            date_accomplished, mode, bene_id, client_region, client_province, 
            client_municipality, client_barangay, client_district, lastname, 
            firstname, middlename, extraname, sex, civil_status, date_birth, 
            mode_admission, category, b_lname, b_fname, b_mname, b_exname, cname, 
            subCategory, pantawid_bene, status_client
    ORDER BY tbl_transaction.date_entered ASC";

$result = mysqli_query($user->db, $query);
if (mysqli_num_rows($result) === 0) {
    echo "<script>alert('NO TRANSACTION MADE ON THIS DATE!');
    window.location.href='export.php';</script>";
    exit;
}

// Initialize PhpSpreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Column headers
$headers = [
    "Date Entered", "Entered By", "Client No", "Date Accomplished", "Region", "Province",
    "City/Municipality", "Barangay", "District", "LastName", "FirstName", "MiddleName", "ExtraName",
    "Sex", "CivilStatus", "DOB", "Age", "Number of Family Member", "Occupation", "Salary",
    "ModeOfAdmission", "Type of Assistance1", "Amount1", "Source of Fund1",
    "Type of Assistance2", "Amount2", "Source of Fund2", "ClientCategory",
    "CHARGING1", "CHARGING2", "CHARGING3", "CHARGING4", "CHARGING5", "CHARGING6",
    "CHARGING7", "CHARGING8", "CHARGING9", "CHARGING10", "CHARGING11", "CHARGING12",
    "MODE", "SERVICE PROVIDERS", "B. LAST NAME", "B. FIRST NAME", "B. MIDDLE NAME", "B. EXT.",
    "Sub Category", "Pantawid Beneficiary", "Fund Source"
];
$sheet->fromArray($headers, NULL, 'A1');

// Populate data rows
$rowIndex = 2;
while ($row = mysqli_fetch_assoc($result)) {
    $fullname = $user->getuserFullname($row['encoded_encoder']);
    $assistance = $user->getAssistanceData($row['trans_id']);
    $fund = $user->getfundsourcedata($row['trans_id']);
    $fundsource = $user->getfundsourceclient($row['trans_id']);
    $age = $user->getAge($row['date_birth']);

    $bname = $row['bene_id'] ? [$row['b_lname'], $row['b_fname'], $row['b_mname'], $row['b_exname']] : ["", "", "", ""];

    $rowData = [
        $row['date_entered'], $fullname, $row['control_no'], $row['date_accomplished'],
        $row['client_region'], $row['client_province'], $row['client_municipality'], $row['client_barangay'],
        $row['client_district'], $row['lastname'], $row['firstname'], $row['middlename'], $row['extraname'],
        $row['sex'], $row['civil_status'], $row['date_birth'], $age, $row['familycount'],
        $row['occupation'], $row['salary'], $row['mode_admission'],
        $user->translateAss($assistance[1]['type'] ?? ''), $assistance[1]['amount'] ?? '', $assistance[1]['fund'] ?? '',
        $user->translateAss($assistance[2]['type'] ?? ''), $assistance[2]['amount'] ?? '', $assistance[2]['fund'] ?? '',
        $row['category']
    ];

    for ($i = 1; $i <= 12; $i++) {
        $rowData[] = isset($fund[$i]['fundsource']) ? $fund[$i]['fundsource'] . ' - ' . $fund[$i]['fs_amount'] : '';
    }

    $rowData = array_merge($rowData, [
        $row['mode'], $row['cname'], $bname[0], $bname[1], $bname[2], $bname[3],
        $row['subCategory'], $row['pantawid_bene'], $fundsource
    ]);

    $sheet->fromArray($rowData, NULL, 'A' . $rowIndex++);
}

// Output to browser
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment;filename=\"{$filename}.xlsx\"");
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
?>