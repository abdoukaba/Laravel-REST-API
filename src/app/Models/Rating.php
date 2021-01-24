<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

        protected $fillable = ['sneaker_id', 'user_id', 'rating'];

        public function sneaker()
    {
      return $this->belongsTo(Sneaker::class);
    }
}
