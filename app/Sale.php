<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    public function seller() {
        return $this->hasOne("App\User", "id", "seller_id");
    }
}
