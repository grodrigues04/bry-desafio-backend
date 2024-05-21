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
            $employees= Employee::with('companies')->get();
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
            $employee = Employee::create([
                'name'=> $request->name,
                'cpf'=> $request->cpf,
                'email'=> $request->email,
                'login'=> $request->login,
                'password'=> $request->password,
                'address'=> $request->address,
            ]);

            if ($request->filled('company_id')) {
                // The 'company' field is present and is not empty...
                $employee->companies()->attach($request->company_id);
            }

            if($employee){
                return response()->json(['message'=> 'Employee created successfully'],200);
            }
        } catch (Exception $e) {
            return response()->json(['message'=> $validator->messages()],422);
        
        }
    }
    public function employee_id(int $id){
        try{
            $employee = Employee::find($id);
            if($employee){
                return response()->json(['employee'=>$employee],200);
            } else {
                return response()->json(['message'=>'Employee not found'],404);
            }
        }
        catch(Exception $e) {
            return response()->json(['message'=>'An error occurred while processing your request'],500);
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
                return response()->json(['message' => $validator->messages()],422);
            }
            $validatedData = $validator->validated();
            $employee->update($validatedData);
            return response()->json(['message' => 'employee updated successfully',"employee"=>$employee],200);
        } else {
            return response()->json(['message'=>'employee not found'],404);
        };
    } catch (Exception $e) {
        return response()->json(['message'=> 'Fail on try to update'],404);
    }
    }

    public function employee_delete($id){
        try{
            $employee = Employee::find($id);
            if($employee){
                $employee->delete();
                return response()->json(['message'=> "Employee {$employee->id} successfully deleted"],200);
            }
            else{
                return response()->json(['message'=> 'No employee Found'],404);
            }
        }
        catch(Exception $e) {
            return response()->json(['message'=> 'Fail on try to delete'],404);
        }

    }
};