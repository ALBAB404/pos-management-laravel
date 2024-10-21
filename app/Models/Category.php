<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public const Image_UPLOAD_PATH       = 'images/uploads/category/';
    public const THUMB_Image_UPLOAD_PATH = 'images/uploads/category_thumb/';

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

    final public function getCategory()
    {
       return self::query()->with('user:id,name')->orderBy('serial', 'asc')->paginate(1);
    }

    final public function storeCategory($input)
    {
       return self::query()->create($input);
    }

    public function user()
    {
       return $this->belongsTo(User::class);
    }

}
