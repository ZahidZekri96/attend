<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Storage;
use Auth;

use App\Models\Attendance;
use App\Models\Employee;

class AttendanceController extends Controller
{
    //api get employee
    public function apiGetIndexDt()
    {
        try{
            $employeeList = (new Employee())->getEmployeeList();

            $object['company'] = $employeeList;

            return response()->json([
                "status"  => true,
                "message" => "success",
                "object"  => $object
            ]);
        } catch (Exception $exception){
            return response()->json([
                "status"  => false,
                "message" => "error"
            ]);
        }
    }

    public function attendanceByMonth($month,$year)
    {
        try{

            $employees = (new Employee())->getEmployeeList();
            

            $attendances = Attendance::whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->get();

            foreach($employees as $employee)
            {
                $salesman['id'] = $employee->id;
                $salesman['name'] = $employee->name;


                foreach($attendances as $attendance)
                {
                    if($attendance->employee_id == $employee->employee_id)
                    {
                        $attend_2['attend'] = $attendance->id;
                        $attend_2['date'] = $attendance->created_at;
                        $attend[] = $attend_2;
                    }
                    else{
                        $attend=[];
                    }

                }
                $salesman['attendance'] = $attend;
                $final[] = $salesman;
            }

            $object['attendance'] = $attendance;

            return response()->json([
                "status"  => true,
                "message" => "success",
                "object"  => $final
            ]);
        } catch (Exception $exception){
            return response()->json([
                "status"  => false,
                "message" => "error"
            ]);
        }
    }
}
