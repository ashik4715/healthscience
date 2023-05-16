<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission_timer extends Model {
  public function category_name() {
    return $this->belongsTo(Category::class);
  }  
  public function publish() {
    return $this->hasOne(PublishDate::class);
  }
}
