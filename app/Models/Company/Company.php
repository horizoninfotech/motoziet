<?php 
namespace App\Models\Company;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Service; // Import the Service model
use App\Models\Country\Country; // Import the Service model

class Company extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'mobile', 'latitude', 'longitude', 'registration_tax_number',
        'country_id', 'state', 'city', 'password', 'is_approved',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The services that belong to the company.
     */
    public function services()
    {
        return $this->belongsToMany(Service::class, 'company_service');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}
