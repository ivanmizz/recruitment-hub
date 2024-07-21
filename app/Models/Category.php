<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Listing;
use App\Models\Company;
class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];
    public function listing() 
    {
        return $this->hasMany(Listing::class);
    }
    public function company() 
    {
        return $this->hasMany(Company::class);
    }
}
