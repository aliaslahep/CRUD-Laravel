<?php

namespace App\Http\Controllers;

use App\Models\Access_logs;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use App\Exports\UsersExport;



use Illuminate\Http\Request;

use PDF;

use App\Models\User;
class AccessLogController extends Controller
{
    public function access_log() {

        $log = DB::table("access_logs")->leftJoin("users","access_logs.user_id","=","users.id")->get();

        $log_url = DB::table("access_logs")->select("url")->distinct()->get();

        $users = DB::table("users")->get();

        return view("access-log",[

            "logs"=> $log,
            "logs_url"=> $log_url,
            "users"=> $users,
            "old_user" => "",
            "old_url"=> ""
        ]);
    }

    public function filter_log(Request $request) {

        $user = $request->user;

        $url = $request->url;

        $from = date('Y-m-d H:i:s',strtotime($request->from));

        $to = $request->to;

        if($to == "") {
            $to = now();
        } else {

            $to = date('Y-m-d 23:59:59',strtotime($request->to));
        }

        $filter_log = DB::table("access_logs")
                            ->leftJoin("users","access_logs.user_id","=","users.id")
                            ->whereBetween('access_log' , [$from,$to]);

        if($user != ""){
            
            $filter_log->where('user_id','=', $user);

        }

        if($url != ""){

            $filter_log->where('url','=', $url);

        }

        $filter_log = $filter_log->get();

        $log_url = DB::table("access_logs")->select("url")->distinct()->get();

        $users = DB::table("users")->get();

        if ($request->has('download') && $request->download == 'pdf') {
            return $this->generate_pdf($filter_log);
        }


        return view('/access-log',[

            'logs'=> $filter_log,
            "logs_url"=> $log_url,
            "users"=> $users,
            "old_url" =>$url,
            "old_user"=> $user,
            "old_from" => $from,
            "old_to" => $to

        ]);
    }

    public function generate_pdf($user_id,$url,$from ,$to) {

        $filter_log = DB::table('access_logs')
                        ->leftJoin('users','access_logs.user_id','=','users.id')
                        ->whereBetween('access_log',[$from,$to]);
              
        if($url!="null"){

            $filter_log->where("url","=", urldecode($url));
        }
        if($user_id!= "null"){

            $filter_log->where("user_id","=", $user_id);
        }

        $filter_log = $filter_log->get();

        $pdf = PDF::loadView('pdf_download', [

            'access_logs' => $filter_log

        ]);
       
        return $pdf->download('access-log.pdf');

    }

    public function generate_excel($user_id,$url,$from ,$to) {

        $filter_log = DB::table('access_logs')
                        ->leftJoin('users','access_logs.user_id','=','users.id')
                        ->whereBetween('access_log',[$from,$to]);
              
        if($url!="null"){

            $filter_log->where("url","=", urldecode($url));
        }
        if($user_id!= "null"){

            $filter_log->where("user_id","=", $user_id);
        }

        $filter_log = $filter_log->get();

        $spreadsheet  = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1','IP Address');
        $sheet->setCellValue('B1','User Name');
        $sheet->setCellValue('C1','URL');
        $sheet->setCellValue('D1','Access Log');

        $row_num = 2;

        foreach( $filter_log as $row ) {

            $sheet->setCellValue('A'.$row_num, $row->ip_address);
            $sheet->setCellValue('B'.$row_num, $row->name);
            $sheet->setCellValue('C'.$row_num, $row->url);
            $sheet->setCellValue('D'.$row_num, $row->access_log);
            $row_num++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'access_log.xlsx';
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit();
    }

    public function import_excel() {

        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
        $reader->setInputEncoding('CP1252');
        $reader->setDelimiter(',');
        $reader->setEnclosure('');
        $reader->setSheetIndex(0);
        $filePath = storage_path('app/sample.csv');
        $spreadsheet = $reader->load($filePath);

        $sheet = $spreadsheet->getActiveSheet();
    
        $data = [];
    
        foreach ($sheet->getRowIterator() as $row) {
            
            $cells = $row->getCellIterator();

            $row_data = [];

            foreach ($cells as $cell) {

                $row_data[] = $cell->getValue();
            }

            $data[] = $row_data;

        }

        return view('uploades',[
            'data'=>$data
        ]);
    }    

}
