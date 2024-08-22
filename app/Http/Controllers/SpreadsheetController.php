<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class SpreadsheetController extends Controller
{
    public function generate_excel()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set column headers
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Name');
        $sheet->setCellValue('C1', 'Email');

        // Sample data
        $data = [
            [1, 'John Doe', 'john.doe@example.com'],
            [2, 'Jane Smith', 'jane.smith@example.com'],
        ];

        // Initialize row number
        $rowNumber = 2; // Start from row 2

        foreach ($data as $row) {
            $sheet->setCellValue('A' . $rowNumber, $row[0]);
            $sheet->setCellValue('B' . $rowNumber, $row[1]);
            $sheet->setCellValue('C' . $rowNumber, $row[2]);
            $rowNumber++;
        }

        // Create writer and output file to browser
        $writer = new Xlsx($spreadsheet);
        $fileName = 'example.xlsx';

        // Set headers to force download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');

        // Write file to output
        $writer->save('php://output');
        exit();
    }
}
