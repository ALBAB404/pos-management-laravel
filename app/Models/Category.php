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

    final public function getCategory($input)
    {
       $per_page = $input['per_page'] ?? 10;
       $query = self::query();

       if (!empty($input['search'])) {
         $query->where('name', 'LIKE', '%'.$input['search'].'%');
       }
       if (!empty($input['order_by'])) {
         $query->orderBy($input['order_by'], $input['direction'] ?? 'asc');
       }
       return $query->with('user:id,name')->paginate($per_page);
    }

    final public function storeCategory($input)
    {
       return self::query()->create($input);
    }

    public function user()
    {
       return $this->belongsTo(User::class);
    }

    public function getCategoryIdAndName()
    {
       return self::query()->select('id', 'name')->get();
    }

}
