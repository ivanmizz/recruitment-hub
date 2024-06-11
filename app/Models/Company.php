<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Listing;
use App\Models\User;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'user_id',
        'category_id',
        'location',
        'logo',    
    ];

    
    public function Category() 
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function User() 
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function Listing() 
    {
        return $this->hasMany(Listing::class);
    }
}
