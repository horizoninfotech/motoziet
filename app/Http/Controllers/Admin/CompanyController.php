<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company\Company;
use App\Models\Service;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function pending(Request $request)
    {
        $query = Company::where('is_approved', false)->orderBy('created_at', 'desc'); ;
    
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('mobile', 'like', "%{$search}%");
            });
        }
    
        $companies = $query->paginate(10); // Paginate results
    
        return view('admin.companies.pending', compact('companies'));
    }

    public function approve(Company $company)
    {
        $company->update(['is_approved' => true]);
        return redirect()->route('admin.companies.pending')->with('success', 'Company approved successfully!');
    }

    public function reject(Company $company)
    {
        $company->update(['is_approved' => 2]); // Assuming 2 means rejected
        return redirect()->route('admin.companies.pending')->with('success', 'Company rejected successfully!');
    }

    public function approved(Request $request)
{
    $query = Company::where('is_approved', true)->orderBy('id', 'desc'); ;

    if ($request->has('search')) {
        $search = $request->get('search');
        $query->where(function($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhere('mobile', 'like', "%{$search}%")
              ->orWhere('registration_tax_number', 'like', "%{$search}%")
              ->orWhere('country_id', 'like', "%{$search}%")
              ->orWhere('state', 'like', "%{$search}%")
              ->orWhere('city', 'like', "%{$search}%");
        });
    }

    $companies = $query->paginate(10); // Paginate results

    return view('admin.companies.approved', compact('companies'));
}
    public function rejected(Request $request)
{
    $query = Company::where('is_approved', 2)->orderBy('updated_at', 'desc'); ;

    if ($request->has('search')) {
        $search = $request->get('search');
        $query->where(function($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhere('mobile', 'like', "%{$search}%")
              ->orWhere('registration_tax_number', 'like', "%{$search}%")
              ->orWhere('country_id', 'like', "%{$search}%")
              ->orWhere('state', 'like', "%{$search}%")
              ->orWhere('city', 'like', "%{$search}%");
        });
    }

    $companies = $query->paginate(10); // Paginate results

    return view('admin.companies.rejected', compact('companies'));
}

public function show(Company $company)
{
    $company->load('country'); // Eager load the related country
    return view('admin.companies.show', compact('company'));
}

// View services assigned to a company
public function services(Company $company)
{
    $availableServices = Service::whereNotIn('id', $company->services->pluck('id'))->get();
    return view('admin.companies.services', compact('company', 'availableServices'));
}

// Assign a service to a company
public function assignService(Request $request, Company $company)
{
    $company->services()->attach($request->service_id);
    return redirect()->route('admin.companies.services', $company)->with('success', 'Service assigned successfully.');
}

// Remove a service from a company
public function removeService(Request $request, Company $company)
{
    $company->services()->detach($request->service_id);
    return redirect()->route('admin.companies.services', $company)->with('success', 'Service removed successfully.');
}
}
