<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Exception;
class EmployeeController extends Controller
{
    //
    public function list_employees()
    {  
        #TODO:Search how to paginate this endpoint
        try{        
            $employees = Employee::all();
            return response()->json($employees,200);
        }catch(Exception $e){
            return response()->json(['message' => 'Error when try to list all employees'], 500);
        }
    }
}
