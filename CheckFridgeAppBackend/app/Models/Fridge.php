<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fridge extends Model
{

    use HasFactory;


    protected $fillable = [
        'title',
    ];

    public function products() {
        return $this->belongsToMany(Product::class);
    }

    public function users() {
        return $this->belongsToMany(User::class);
    }

}
