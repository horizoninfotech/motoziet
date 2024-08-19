<?php namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Country\Country; // Make sure the namespace is correct
use App\Models\Company\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\App;

class CompanyAuthController extends Controller
{
    // Show the registration form
    public function showRegistrationForm()
    {
        // Get the current language
        $locale = App::getLocale();

        // Fetch countries from the database
        $countries = Country::select('id', 'name', 'name_ar', 'name_ur', 'iso_code', 'phone_code')
            ->get()
            ->map(function($country) use ($locale) {
                if ($locale == 'ar') {
                    $country->name = $country->name_ar;
                } elseif ($locale == 'ur') {
                    $country->name = $country->name_ur;
                }
                return $country;
            });

        return view('company.register', compact('countries'));
    }

    // Handle the registration process
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:companies',
            'mobile' => 'required|string|max:15',
            'latitude' => 'nullable|string',
            'longitude' => 'nullable|string',
            'registration_tax_number' => 'required|string|max:255|unique:companies',
            'country_id' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create the company but set it as unapproved initially
        $company = Company::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'registration_tax_number' => $request->registration_tax_number,
            'country_id' => $request->country_id,
            'state' => $request->state,
            'city' => $request->city,
            'password' => Hash::make($request->password),
            'is_approved' => false, // Will require admin approval
        ]);

        return redirect()->route('company.register')->with('status', 'Registration successful! Awaiting admin approval.');
    }
}