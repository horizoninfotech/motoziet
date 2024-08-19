<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company\Company;
use Illuminate\Http\Request;

class CompanyMapController extends Controller
{
    public function showMap(Request $request)
    {
        // Fetch all companies with their locations
        $companies = Company::whereNotNull('latitude')
                            ->whereNotNull('longitude')
                            ->where('is_approved', 1)
                            ->get();

        return view('company.map', compact('companies'));
    }
}
