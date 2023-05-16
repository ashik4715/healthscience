<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserFeedback extends Model {
  protected $fillable = ['name', 'email', 'message', 'pre_publish', 'recommend_email'];
}
