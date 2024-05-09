<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categories;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category_id',
        'logo',
        'location',
    ];

    
    public function Categories() 
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
    public function Listing() 
    {
        return $this->hasMany(Listing::class);
    }
}
