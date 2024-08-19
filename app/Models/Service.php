<?php namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Company\Company;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'title_ar',
        'title_ur',
        'description',
        'description_ar',
        'description_ur',
        'icon',
        'category_id'
    ];

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'company_service');
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
