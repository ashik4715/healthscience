<?php

namespace App\Models\Author;

use App\Models\Category;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Submit extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }
}
