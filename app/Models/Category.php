<?php

// app/Models/Category.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'name_ar', 'name_ur', 'description', 'description_ar', 'description_ur' , 'icon'
    ];

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}

