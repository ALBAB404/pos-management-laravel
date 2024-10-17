<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'serial',
        'status',
        'status',
        'description',
        'photo',
        'user_id',
    ];

    final public function storeCategory($input)
    {
       return self::query()->create($input);
    }

}
