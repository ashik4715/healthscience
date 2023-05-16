<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model {
  protected $guarded = [];

  //relation
  public function abouts() {
    //return $this->belongsTo('About','membership_image');
    return $this->belongsToMany('App\Models\About', 'membership_image', 'image_id', 'membership_id');
  }
}
