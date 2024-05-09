<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categories;
use App\Models\Company;
use App\Models\User;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'location',
        'role_level',
        'contract_type',
        'requirement',
        'status',
        'due_date',
        'user_id',
        'category_id',
        'company_id',
    ];


    public function User() 
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function Categories() 
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }

    public function Company() 
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function Application() 
    {
        return $this->hasMany(Application::class);
    }
}
