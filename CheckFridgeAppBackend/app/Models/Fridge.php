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

    protected $hidden = [
        'created_at',
        'updated_at',
        'pivot',
    ];

    public function products() {
        return $this->belongsToMany(Product::class);
    }

    public function users() {
        return $this->belongsToMany(User::class);
    }

}
