<?php

namespace App\Models;

use App\Models\User;
use App\Models\Listing;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Application extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'listing_id', 'comments'];
    public $timestamps = false;
    //Relationship to user
    public function user() {
        return $this->belongsTo(User::class, "user_id");
    }
    
    //Relationship to listing
    public function listing() {
        return $this->belongsTo(Listing::class, "listing_id");
    }
}
