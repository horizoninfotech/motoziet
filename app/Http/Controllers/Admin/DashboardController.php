<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\User;
use App\Models\Company\Company;
use App\Models\Country\Country;

class DashboardController extends Controller
{
    public function index()
{
    $servicesCount = Service::count();
    $usersCount = User::count();
    $companiesCount = Company::count();
    $countriesCount = Country::count();

    return view('admin.dashboard', compact('servicesCount', 'usersCount', 'companiesCount','countriesCount'));
}
}
