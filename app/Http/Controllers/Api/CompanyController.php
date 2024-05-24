<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Exception;
class CompanyController extends Controller
{
    public function list_companies() #READ
    {
        try {
            $companies= Company::with('employees')->get();
            return response()->json($companies, 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error when try to list all companies'], 500);
        }
    }

    public function create_company(Request $request) {
       
        try {
            $validator = Validator::make($request->all(),[  
                'name' => 'required|string',
                'cnpj' => 'required|string',                                 
                'address' => 'required|string',
                'employee_id' => 'int'
            ]);
           
            $company=Company::create([
                'name'=> $request->name,
                'cnpj'=> $request->cnpj,
                'address'=> $request->address,
            ]);
            
            // The 'employee' field is present and is not empty...       
            if ($request->filled('employee_id')) {
                $employee = Company::find($request->employee_id);
                if ($employee){
                    $company->companies()->attach($request->employee_id);
                }
            }

            if($company){
                return response()->json(['message'=> 'Company created successfully'],200);
            }
        }
        catch (Exception $e) {
            return response()->json([$validator->messages()],422);
        }
    }

    public function company_id(int $id){
        try{
            $company = Company::find($id);
            if($company){
                return response()->json(['company'=>$company],200);
            } else {
                return response()->json(['message'=> 'company not found'],404);
            }
        }
        catch(Exception $e) {
            return response()->json(['message'=> 'An error occurred while processing your request'],500);
        }
    }

    public function company_update(Request $request, int $id){
        try{
            $company = Company::find($id);
            if($company){
                $validator = Validator::make($request->all(),[  
                    'name' => 'sometimes|string',
                    'cnpj' => 'sometimes|string',
                    'address' => 'sometimes|string'

                ]);    
                if ($validator->fails()) {
                    return response()->json(['message' => $validator->messages()],422);
                }
                $validatedData = $validator->validated();
                $company->update($validatedData);
                if ($request->filled('employee_id')) {
                    foreach ($request->employee_id as $id) {
                        $employee = Company::find($id);
                        if ($employee){
                            $employee->companies()->attach($id);
                        }
                    }
                }
                return response()->json(['message' => 'company updated successfully',"company"=>$company],200);
            } else {
                return response()->json(['message'=> 'company not found'],404);
            };
        } catch (Exception $e) {
            return response()->json(['message'=> 'Fail on try to update'],404);
        }
    }

    public function company_delete($id){
        try{
            $company = Company::find($id);
            if($company){
                $company->delete();
                return response()->json(['message'=> "company {$company->id} successfully deleted"],200);
            }
            else{
                return response()->json(['message'=> 'No company Found'],404);
            }
        }
        catch(Exception $e) {
            return response()->json(['message'=> 'Fail on try to delete'],404);
        }

    }
}

