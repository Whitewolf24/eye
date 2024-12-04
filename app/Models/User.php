<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // Disable timestamps
    public $timestamps = false;

    protected $table = 'eye_users';

    protected $fillable = ['email', 'password'];

    protected $hidden = ['password'];

    // Correct the getAuthPassword method
    public function getAuthPassword()
    {
        return $this->password;  // Correct the column name to 'password'
    }
}
