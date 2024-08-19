<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company\Company; // Updated namespace
use Illuminate\Http\Request;

class CompanyManagementController extends Controller
{
    public function index()
    {
        $companies = Company::where('is_approved', false)->get();
        return view('admin.companies.index', compact('companies'));
    }

    public function approve(Company $company)
    {
        $company->update(['is_approved' => true]);

        return redirect()->route('admin.companies.index')->with('status', 'Company approved successfully.');
    }
}
