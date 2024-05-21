<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
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
}
