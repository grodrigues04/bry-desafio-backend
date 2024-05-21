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
            $companies= Company::all();
            return response()->json($companies, 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error when try to list all companies'], 500);
        }
    }

    public function create_company(Request $request) {
        #cnpj validation
        for($i=0; $i < strlen($request->cnpj); $i++){
            if(!is_numeric($request->cnpj[$i])){
                $request->cnpj = str_replace($request->cnpj[$i], '', $request->cnpj);
            }
        };
        if (strlen($request->cnpj)!==14){
            return response()->json(['message'=> 'invalid cnpj'],422);
        }
        try {
            $validator = Validator::make($request->all(),[  
                'name' => 'required|string',
                'cnpj' => 'required|string',                                 
                'address' => 'required|string',]);
           
            $company=Company::create([
                'name'=> $request->name,
                'cnpj'=> $request->cnpj,
                'address'=> $request->address,
            ]);
            if($company){
                return response()->json(['message'=> 'Company created successfully'],200);
            }
        }
        catch (Exception $e) {
            return response()->json(['status'=>422,'message'=> $validator->messages()]);
        }
    }

    public function company_id(int $id){
        try{
            $company = Company::find($id);
            if($company){
                return response()->json(['status'=>200,'company'=>$company]);
            } else {
                return response()->json(['status'=> 404,'message'=>'company not found']);
            }
        }
        catch(Exception $e) {
            return response()->json(['status'=> 500,'message'=>'An error occurred while processing your request']);
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
                    return response()->json(['status' => 422, 'message' => $validator->messages()]);
                }
                $validatedData = $validator->validated();
                $company->update($validatedData);
                return response()->json(['status'=> 200,'message' => 'company updated successfully',"company"=>$company]);
            } else {
                return response()->json(['status'=> 404,'message'=>'company not found']);
            };
        } catch (Exception $e) {
            return response()->json(['status'=> 404,'message'=> 'Fail on try to update']);
        }
    }

    public function company_delete($id){
        try{
            $company = Company::find($id);
            if($company){
                $company->delete();
                return response()->json(['status'=> 200,'message'=> "company {$company->id} successfully deleted"]);
            }
            else{
                return response()->json(['status'=> 404,'message'=> 'No company Found']);
            }
        }
        catch(Exception $e) {
            return response()->json(['status'=> 404,'message'=> 'Fail on try to delete']);
        }

    }
}

