<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['account_id', 'description'];

    public function account() {
        return $this->belongsTo(Account::class);
    }
}
