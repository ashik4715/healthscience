<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model {
  protected $guarded = [];
  protected $casts = [
          'member_images' => 'array'
  ];

  //relation
  public function images() {
    return $this->belongsToMany('App\Models\Image', 'membership_image', 'membership_id', 'image_id');
  }

}
