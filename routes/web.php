<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\CompanyController as AdminCompanyController;
use App\Http\Controllers\Company\CompanyAuthController;
use App\Http\Controllers\Company\CompanyController;
use App\Http\Controllers\Company\CompanyMapController;
use App\Http\Controllers\Country\CountryController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Authentication routes
require __DIR__.'/auth.php';
Auth::routes(['register' => false]);

Route::get('/', function () {
    return view('index'); // This will load resources/views/index.blade.php
});


// Route to show the registration form
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');

// Route to handle the registration submission
Route::post('register', [RegisterController::class, 'register'])->name('register.submit');

// Language Switching Route
Route::get('/company/register', [App\Http\Controllers\LanguageController::class, 'setLang'])->name('company.register');
Route::get('/companies/map', [CompanyMapController::class, 'showMap'])->name('companies.map');

// Google OAuth Routes
Route::get('auth/google', [AuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

 
 

// Admin Authentication Routes (without middleware)
Route::prefix('admin')->as('admin.')->group(function () {
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminAuthController::class, 'login']);
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');
});

// Admin Routes (protected by auth:admin middleware)
Route::prefix('admin')->as('admin.')->middleware(['auth:admin', 'verified'])->group(function () {
    // Admin Dashboard Route
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('countries', CountryController::class);
    Route::get('countries/{country}', [CountryController::class, 'show'])->name('countries.show');
   

    // Admin Categories Routes
    Route::resource('categories', CategoryController::class);

    // Admin Services Routes
    Route::resource('services', ServiceController::class);
    // Company Services Management Route
    
    Route::get('companies/{company}/services', [AdminCompanyController::class, 'services'])->name('companies.services');
    Route::post('companies/{company}/services/assign', [AdminCompanyController::class, 'assignService'])->name('companies.services.assign');
    Route::post('companies/{company}/services/remove', [AdminCompanyController::class, 'removeService'])->name('companies.services.remove');



    // Admin Packages Routes
    Route::resource('packages', PackageController::class);

    // Company Management Routes
    Route::get('companies', [AdminCompanyController::class, 'pending'])->name('companies.index');
    Route::get('companies/pending', [AdminCompanyController::class, 'pending'])->name('companies.pending');
    Route::get('companies/approved', [AdminCompanyController::class, 'approved'])->name('companies.approved');
    Route::get('companies/rejected', [AdminCompanyController::class, 'rejected'])->name('companies.rejected');
    Route::post('companies/{company}/approve', [AdminCompanyController::class, 'approve'])->name('companies.approve');
    Route::post('companies/{company}/reject', [AdminCompanyController::class, 'reject'])->name('companies.reject');
    Route::get('companies/{company}', [AdminCompanyController::class, 'show'])->name('companies.show');
});

// Company Registration Routes
Route::prefix('company')->group(function () {
    Route::get('register', [CompanyAuthController::class, 'showRegistrationForm'])->name('company.register');
    Route::post('register', [CompanyAuthController::class, 'register'])->name('company.submitRegistration');
});

 

// User dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


 

// Home route (can be customized or removed if using a different dashboard route)
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
