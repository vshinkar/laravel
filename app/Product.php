<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Product extends Model {

    protected $fillable = ['name', 'user_id', 'quantity', 'price'];

    /**
     * Get user - product owner
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

}
