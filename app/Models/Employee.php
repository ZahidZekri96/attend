<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'employees';

    protected $fillable = [
        'name', 'employee_id', 'branch', 'group', 'year', 'created_by', 'updated_by'
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
    public function attendance(){

        return $this->hasMany(Attendance::class,'employee_id','id');
    }
    /*
    |--------------------------------------------------------------------------
    | End Relationship
    |--------------------------------------------------------------------------
    */

    //get company list
    public function getEmployeeList($selector="*", $order="ASC", $status="all")
    {
        $getEmployees = Employee::select($selector)
                            ->with('attendance')
                        	->orderBy('id',$order);

        return $getEmployees->get();
    }

    //get prospect group by id
    public function getEmployeeById($id)
    {
        $getData = Employee::find($id);

        return $getData;
    }
}