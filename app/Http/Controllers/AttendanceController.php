<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{


    function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return ['status'=>false,'File not exist or have no permission to read file'];

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {
                if (!$header){
                    $header = ['Emp Id','Sch Id','In','Out'];                    
                
                foreach ($header as $key => $value) {
                    if($header[$key] !== $row[$key]){
                        return ['status'=>false,'Invalid Columns'];
                    }
                }
                }
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }

    public function uploadCSV(Request $request)
    {
        try{

            $fileName = time().'.'.$request->file('file')->getClientOriginalName(); 

            $request->file->move(public_path('uploads'), $fileName);  
            $file = public_path('uploads').'\\'. $fileName;    
            $records = $this->csvToArray($file);
            
            $format = "Y-m-d H:i:s"; // Specify the format of the input date string

            foreach ($records as $row) {
                
                $sch = Schedule::where(['id'=>$row['Sch Id'],'employee_id'=>$row['Emp Id']])->first();
                if(!empty($sch)){
                    Attendance::create([
                        'employee_id' => $sch->employee_id,
                        'schedule_id' => $sch->id,
                        'In' => date("Y-m-d H:i:s", strtotime($row['In'])),
                        'Out' => date("Y-m-d H:i:s", strtotime($row['Out'])),
                    ]);
                }
                            
            }

            return response()->json(['message' => 'File uploaded and data stored successfully']);
        }catch(\Exception $e){
            // dd($e);
            return response()->json(['message' => 'Error Occur Please Contact Support']);
        }
    }

    public function empAttendance(Request $request)
    {
        try{
            $result = DB::table('attendances')
            ->leftJoin('employees','attendances.employee_id', '=', 'employees.id')
            ->select(DB::raw('name,`Out`,`In`,HOUR(TIMEDIFF(`Out`, `In`)) AS hours '))
            ->where('name','like','%'.$request['emp_name'].'%')                        
            ->get();

            $records = $result->toArray();
            return json_encode($records);
        }catch(\Exception $e){
            dd($e);
            return response()->json(['message' => 'Error Occur Please Contact Support']);
        }
    }
}
