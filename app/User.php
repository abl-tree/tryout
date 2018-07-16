<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'token', 'password', 'provider', 'provider_id'
    ];
    
    public function sales() {
        return $this->hasMany("App\Sale", "seller_id", "id");
    }
}
