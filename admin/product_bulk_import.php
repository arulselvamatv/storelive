<?php
/*
 * Bulk Implode Rules
 * File extension should be xls, xlsx or csv
 * If Company name empty or already exist data will skipped
 * If all values empty row will be skipped from read
 *
 * */


require_once("database/connect.php");
$db = new Database;
$db->Connect();

require 'phplib/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;

$target_dir = "uploads/";

$target_file = $target_dir . basename($_FILES["productxl"]["name"]);
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

    if (move_uploaded_file($_FILES["productxl"]["tmp_name"], $target_file_path)) {
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
    $retrive_range = 'A2:E' . $highestRow;

    $dataArray = $worksheet->rangeToArray(
        $retrive_range,     // Range that we want to retrieve
        NULL,        // Value returned for empty cells
        TRUE,        // to getCalculatedValue
        TRUE,        // to getFormattedValue
        TRUE         // Should the array be indexed by cell row and cell column
    );

    $excel_data = array();
    $excel_skipped_data = array();
    $insert_err_data = array();
    $cat_name_insrt = true;
    $pro_id = false;
    $updated_no = false;

    $total_success = 0;
    $total_fails = 0;

    foreach ($dataArray as $key => $rowdata) {
        if (empty(array_filter($rowdata))) {
            continue;
        }

        $cat_name = trim($rowdata['A']);
        $pro_ty = trim($rowdata['B']);
        $pro_name = trim($rowdata['C']);
        $pro_desc = trim($rowdata['D']);
        $unit = trim($rowdata['E']);

        $asd = htmlentities($cat_name, ENT_QUOTES);
        $prod_two_code = substr($asd, 0, 2);

        $pro_code = $prod_two_code.'00'.$key; // temp product code

        if ($cat_name_insrt) {
            $field_values = array();
            $field_values[0] = htmlentities($cat_name, ENT_QUOTES);
            $field_values[1] = htmlentities($pro_ty, ENT_QUOTES);
            $pro_id = $db->insertreturnid('product_details', $field_values, 'cat_name,pro_ty');
            if ($pro_id) $cat_name_insrt = false;
        }

        if (isset($pro_id) && !empty($pro_id)) {
            $emp_data = $db->query('SELECT count(pdi.`proi_id`) FROM `product_details_info` as pdi inner join product_details as pd on pd.pro_id = pdi.pro_id
				WHERE pdi.`pro_name`="' . $pro_name . '" and pd.cat_name="' . $cat_name . '" and pd.pro_ty="' . $pro_ty . '"');
            $fetch_result = $emp_data->fetch();
            $count = $fetch_result[0];
            if ($count > 0) {
                array_push($excel_skipped_data, $rowdata); // Already Exists
            } else {
                $field_values = array();
                $field_values[0] = htmlentities(($pro_id), ENT_QUOTES);
                $field_values[1] = htmlentities(($pro_code), ENT_QUOTES);
                $field_values[2] = htmlentities(($pro_name), ENT_QUOTES);
                $field_values[3] = htmlentities(($pro_desc), ENT_QUOTES);
                $field_values[4] = htmlentities(($unit), ENT_QUOTES);

                $rdata = $db->insertreturnid('product_details_info', $field_values, "pro_id,pro_code, pro_name, pro_desc, unit");
                if ($rdata) {
                    $updated_no = $rdata;
                    array_push($excel_data, $rowdata);
                    $total_success++;

                    $field_vale = array();
                    $field_vale['pro_code'] = $prod_two_code . substr_replace('0000', trim($rdata), -strlen(trim($rdata)));
                    $rda = $db->update('product_details_info', $field_vale, 'proi_id =\'' . $rdata . '\'');
                } else {
                    array_push($excel_data, $rowdata); // to find total insert tried
                    array_push($insert_err_data, $rowdata);
                    $total_fails++;
                }
            }

            $response['status'] = TRUE; // Stored Sucessfully
        } else {
            $response['status'] = FALSE;
            $response['error_msg'] = 'Category name or product type not stored';
        }
    }

    if ($updated_no) {
        $field_value = array();
        $field_value['updated_no'] = $updated_no;
        $rdaa = $db->update('category', $field_value, 'category_name=\'' . $asd . '\'');
    }

    $response['skip_count'] = count($excel_skipped_data); // skipped due to already exist
    $response['insert_count'] = count($excel_data); // Data after skipped
    $response['total_count'] = ($response['insert_count'] + $response['skip_count']);

    if (count($excel_data) > 0) {
        $response['status'] = TRUE;
        $response['insert_success_count'] = $total_success;
        $response['insert_fail_count'] = $total_fails;
    } else {
        $response['status'] = TRUE;
        $response['insert_success_count'] = 0;
        $response['insert_fail_count'] = 0;
        if ($response['total_count'] == 0) {
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