<?php
namespace App;

use App\Models\Author\Submit;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
  use Notifiable;


  protected $fillable = [
          'role_id', 'prefix', 'firstname', 'middlename', 'lastname', 'institution', 'department', 'address', 'email', 'password', 'image', 'verifyToken', 'status'
  ];


  protected $hidden = [
          'password', 'remember_token',
  ];


  protected $casts = [
          'email_verified_at' => 'datetime',
  ];

  public function role() {
    return $this->belongsTo(Role::class);
  }

  public function submits() {
    return $this->hasMany(Submit::class);
  }
}
