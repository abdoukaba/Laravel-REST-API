<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sneaker extends Model
{
    use HasFactory;
	
	    protected $fillable = ['user_id', 'sneaker_name', 'hyper_level', 'price', 'release_date'];


        public function user()
    {
      return $this->belongsTo(User::class);
    }

        public function ratings()
    {
      return $this->hasMany(Rating::class);
    }
}
