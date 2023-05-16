<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PublishDate extends Model
{
    public function timer(){
    	return $this->belongsTo(Submission_timer::class);
    }
}
