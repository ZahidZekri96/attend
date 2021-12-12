<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'attendance';

    protected $fillable = [
        'employee_id', 'created_by', 'updated_by'
    ];

    protected $dates = [
        'deleted_at','created_at', 'updated_at'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationship
    |--------------------------------------------------------------------------
    */
    public function employee(){

        return $this->hasOne(Employees::class,'id','employee_id');
    }
    /*
    |--------------------------------------------------------------------------
    | End Relationship
    |--------------------------------------------------------------------------
    */

    //get company list
    public function getAttendanceList($selector="*", $order="ASC", $status="all")
    {
        $getAttendance = Attendance::select($selector)
                        	->orderBy('id',$order)
                            ->with('employee');

        return $getAttendance->get();
    }

    //get prospect group by id
    public function getAttendanceById($id)
    {
        $getData = Attendance::find($id);

        return $getData;
    }
}