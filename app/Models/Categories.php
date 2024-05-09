<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Listing;
use App\Models\Company;
class Categories extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];
    public function Listing() 
    {
        return $this->hasMany(Listing::class);
    }
    public function Company() 
    {
        return $this->hasMany(Company::class);
    }
}
