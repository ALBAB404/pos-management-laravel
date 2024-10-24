<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    public const Image_UPLOAD_PATH       = 'images/uploads/sub_category/';
    public const THUMB_Image_UPLOAD_PATH = 'images/uploads/sub_category_thumb/';

    protected $fillable = [
        'name',
        'slug',
        'serial',
        'status',
        'status',
        'description',
        'photo',
        'user_id',
        'category_id',
    ];

    final public function getSubCategory($input)
    {
       $per_page = $input['per_page'] ?? 10;
       $query = self::query();

       if (!empty($input['search'])) {
         $query->where('name', 'LIKE', '%'.$input['search'].'%');
       }
       if (!empty($input['order_by'])) {
         $query->orderBy($input['order_by'], $input['direction'] ?? 'asc');
       }
       return $query->with(['user:id,name', 'category:id,name'])->paginate($per_page);
    }

    final public function storeSubCategory($input)
    {
       return self::query()->create($input);
    }

    public function user()
    {
       return $this->belongsTo(User::class);
    }

    public function category()
    {
       return $this->belongsTo(Category::class);
    }


}
