<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Listing;
use App\Models\User;

use App\Events\ApplicationSent;
use App\Events\ApplicationStatusUpdated;
class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'listing_id',
        'user_id',
        'status',
        'resume',
        'cover_letter',
        'message',
        'candidate_name',
        'candidate_email',
        'candidate_phone',
    ];

    protected $dispatchesEvents = [
        'created' => ApplicationSent::class,
        'updated' => ApplicationStatusUpdated::class,

    ];

    public function listing() 
    {
        return $this->belongsTo(Listing::class);
    }


    public function user() 
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
