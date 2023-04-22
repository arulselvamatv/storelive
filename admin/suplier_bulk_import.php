<?php
/*
 * Bulk Implode Rules
 * File extension should be xls, xlsx or csv
 * If Company name empty or already exist data will skipped
 * If all values empty row will be skipped from read
 *
 * */


require_once("database/connect.php");
$db=new Database;
$db->Connect();

require 'phplib/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;

$target_dir = "uploads/";

$target_file = $target_dir . basename($_FILES["suplierxl"]["name"]);
$uploadOk = 1;
$upload_status = FALSE;
$sheetFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


if ($sheetFileType != "xls" && $sheetFileType != "xlsx" && $sheetFileType != "csv") {
    $upload_err_msg = "Sorry, only xls, xlsx or csv files are allowed.";
    $uploadOk = 0;
}

if ($uploadOk) {
    $uniquesavename = time() . uniqid(rand());
    $target_file_path = $target_dir . $uniquesavename . '.' . $sheetFileType;

    if (move_uploaded_file($_FILES["suplierxl"]["tmp_name"], $target_file_path)) {
        $upload_status = TRUE;
    } else {
        $upload_err_msg = "Sorry, there was an error uploading your file.";
    }
}

if ($upload_status && isset($target_file_path)) {
    $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($target_file_path);
    $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
    
    $spreadsheet = $reader->load($target_file_path);
    $spreadsheet->setActiveSheetIndex(0);
    $spreadsheet->getSheet(0);

    $worksheet = $spreadsheet->getActiveSheet();
    $highestRow = $worksheet->getHighestRow();
    $retrive_range = 'A2:I'.$highestRow;

    $dataArray = $worksheet->rangeToArray(
        $retrive_range,     // Range that we want to retrieve
        NULL,        // Value returned for empty cells
        TRUE,        // to getCalculatedValue
        TRUE,        // to getFormattedValue
        TRUE         // Should the array be indexed by cell row and cell column
    );

    // Fetch Already Exist Company Name
    $sth = $db->query('SELECT `company_name` FROM `suplier` where active_record=1');
    $all_company_name = $sth->fetchAll(PDO::FETCH_COLUMN, 0);

    $excel_data = array();
    $excel_skipped_data = array();
    $insert_err_data = array();
    foreach ($dataArray as $key => $rowdata) {
        if (empty(array_filter($rowdata))) {
            continue;
        }

        $suplier_data['company_name'] = trim($rowdata['A']);
        $suplier_data['name'] = trim($rowdata['B']);
        $suplier_data['mobile'] = trim($rowdata['C']);
        $suplier_data['address'] = trim($rowdata['D']);
        $suplier_data['gstin_no'] = trim($rowdata['E']);
        $suplier_data['pan_no'] = trim($rowdata['F']);
        $suplier_data['bank1'] = trim($rowdata['G']);
        $suplier_data['bank2'] = trim($rowdata['H']);
        $suplier_data['active_record'] = ($rowdata['I'] == '0') ? '0' : '1';

        if (empty(array_filter($suplier_data))) {
            continue;
        }
        if(!empty($suplier_data['company_name']) && !in_array($suplier_data['company_name'],$all_company_name)){
            array_push($excel_data, $suplier_data);
        }else{
            array_push($excel_skipped_data, $suplier_data);
        }
    }

    $response['skip_count'] = count($excel_skipped_data); // skipped due to already exist
    $response['insert_count'] = count($excel_data); // Data after skipped
    $response['total_count'] = ($response['insert_count'] + $response['skip_count']);
    

    if (count($excel_data) > 0) {
        $total_success = 0;
        $total_fails = 0;
        foreach ($excel_data as $data){
            $insrt_result = $db->insert_new('suplier',$data);
            if($insrt_result){
                $total_success++;
            }else{
                $total_fails++;
                array_push($insert_err_data, $data);
            }
        }

        $response['status'] = TRUE;
        $response['insert_success_count'] = $total_success;
        $response['insert_fail_count'] = $total_fails;
    } else {
        $response['status'] = TRUE;
        $response['insert_success_count'] = 0;
        $response['insert_fail_count'] = 0;
        if($response['total_count'] == 0){
            $response['status'] = FALSE;
            $response['error_msg'] = 'There is no records available to read.';
        }
    }

    if (file_exists($target_file_path)) @unlink($target_file_path);
} else {
    $response['status'] = FALSE;
    $response['error_msg'] = $upload_err_msg;
}

echo json_encode($response);
