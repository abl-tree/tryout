<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    public function customer() {
        return $this->hasOne("App\User", "id", "customer_id");
    }
    
    public function property() {
        return $this->hasOne("App\Sale", "id", "prop_id");
    }
}
