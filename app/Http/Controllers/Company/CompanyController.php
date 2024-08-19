<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company\Company;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

 

class CompanyController extends Controller
{
    public function register(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:companies',
            'mobile' => 'required|string|max:20|unique:companies',
            'latitude' => 'nullable|string|max:255',
            'longitude' => 'nullable|string|max:255',
            'registration_tax_number' => 'required|string|max:255|unique:companies',
            'country' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
      
        

        // Create a new company
        $company = new Company();
        $company->name = $request->name;
        $company->email = $request->email;
        $company->mobile = $request->mobile;
        $company->latitude = $request->latitude;
        $company->longitude = $request->longitude;
        $company->registration_tax_number = $request->registration_tax_number;
        $company->country = $request->country;
        $company->state = $request->state;
        $company->city = $request->city;
        $company->password = Hash::make($request->password);
        $company->save();

        // Redirect with success message
        return redirect()->route('company.register')->with('status', 'Company registered successfully!');
    }
}
