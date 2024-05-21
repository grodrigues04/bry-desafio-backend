<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    //
    public function list_employees() #READ
    {
        #TODO:Search how to paginate this endpoint
        try {
            $employees = Employee::all();
            return response()->json($employees, 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error when try to list all employees'], 500);
        }
    }
    public function create_employee(Request $request) # CREATE
    {
        try {
            $validator = Validator::make($request->all(),[  
                'name' => 'required|string',
                'cpf' => 'required|string|size:11',
                'email' => 'required|email',
                'login' => 'required|string',
                'password' => 'required|string',
                'address' => 'required|string',
            ]);    
            $employees = Employee::create([
                'name'=> $request->name,
                'cpf'=> $request->cpf,
                'email'=> $request->email,
                'login'=> $request->login,
                'password'=> $request->password,
                'address'=> $request->address,
            ]);
            if($employees){
                return response()->json(['message'=> 'Employee created successfully'],200);
            }
        } catch (Exception $e) {
            return response()->json(['status'=>422,'message'=> $validator->messages()]);
        
        }
    }
    public function employee_id(int $id){
        try{
            $employee = Employee::find($id);
            if($employee){
                return response()->json(['status'=>200,'employee'=>$employee]);
            } else {
                return response()->json(['status'=> 404,'message'=>'employee not found']);
            }
        }
        catch(Exception $e) {
            return response()->json(['status'=> 500,'message'=>'An error occurred while processing your request']);
        }
    }

    public function employee_update(Request $request, int $id){ #TODO Change commit mensagem of this functions
    try{
        $employee = Employee::find($id);
        if($employee){
            $validator = Validator::make($request->all(),[  
                'name' => 'string',
                'cpf' => 'string|size:11',
                'email' => 'email',
                'login' => 'string',
                'password' => 'string',
                'address' => 'string',
            ]);    
            if ($validator->fails()) {
                return response()->json(['status' => 422, 'message' => $validator->messages()]);
            }
            $validatedData = $validator->validated();
            $employee->update($validatedData);
            return response()->json(['status'=> 200,'message' => 'Resource updated successfully',"employee"=>$employee]);
        } else {
            return response()->json(['status'=> 404,'message'=>'employee not found']);
        };
    } catch (Exception $e) {
        return response()->json(['status'=> 404,'message'=> 'Fail on try to update']);
    }
    }

    public function employee_delete($id){
        try{
            $employee = Employee::find($id);
            if($employee){
                $employee->delete();
                return response()->json(['status'=> 200,'message'=> "Employee {$employee->id} successfully deleted"]);
            }
            else{
                return response()->json(['status'=> 404,'message'=> 'No employee Found']);
            }
        }
        catch(Exception $e) {
            return response()->json(['status'=> 404,'message'=> 'Fail on try to delete']);
        }

    }
};