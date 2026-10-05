<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class User extends Authenticatable { use HasFactory, Notifiable; protected $fillable=['name','email','password','role','department']; protected $hidden=['password','remember_token']; protected function casts(): array { return ['password'=>'hashed']; } public function hasRole(...$roles): bool { return in_array($this->role,$roles,true); } }
