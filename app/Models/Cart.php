<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    use HasFactory;

    public function user() {
        return $this->BelongsTo(User::class);
    }

    public function products() {
        return $this->hasMany(Product::class);
    }
}