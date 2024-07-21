<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Company;
use App\Models\User;
use App\Models\Application;

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
        'job_type',
        'due_date',
        'user_id',
        'category_id',
        'company_id',
    ];


    public function user() 
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function categories() 
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function company() 
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function application() 
    {
        return $this->hasMany(Application::class);
    }
}
