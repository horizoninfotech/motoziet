<?php
namespace App\Models\Country;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company\Company;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'name_ar', 'iso_code', 'name_ur', 'phone_code',
    ];

    public function Companies()
    {
        return $this->hasMany(Company::class);
    }
}