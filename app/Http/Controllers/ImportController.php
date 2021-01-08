<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use App\Line;

class ImportController extends Controller
{
    public function import()
    {
        // The user is logged in...
        $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        /**
        *text/comma-separated-values 逗號分隔CSV
        */
        if (isset($_FILES['file']['name']) && in_array($_FILES['file']['type'], $file_mimes)) //檔案是否存在
        {
            
            $arr_file = explode('.', $_FILES['file']['name']); //分割字串
            $extension = end($arr_file); //副檔名
            
            if ('csv' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } elseif ('xlsx' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            
            $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
            // start customize
            $sheetData = $spreadsheet->getActiveSheet()->ToArray(); //取得sheet值並存成陣列
            //return $sheetData;  return只會給予物件 所以中文會輸出unicode
            //return view('',$sheetData=>$sheetData);
            // /end customize
            $count = count($sheetData);
            if (is_array($sheetData)) {
                foreach ($sheetData as $row => $value) {
                    Line::create([
                        'user_id' => $value[0],
                        'created_at' => now(),
                        'apporved' => now(),
                        'person_name' => $value[1],
                        'school' => $value[2],
                        'phone' => $value[3],
                        ]);
                    }
                }    
                return redirect()->route('home')->with('message', "新增成功!總共新增$count" . "筆");//redirect home and 
            }
        }
}
