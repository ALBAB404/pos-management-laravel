<?php

namespace App\Http\Resources;

use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Manager\ImageUploadManager;
use Illuminate\Http\Resources\Json\JsonResource;

class SubCategoryEditResourse extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'category_id'   => $this->category->id,
            'slug'          => $this->slug,
            'description'   => $this->description,
            'status'        => $this->status,
            'serial'        => $this->serial,
            'photo_preview' => ImageUploadManager::prepareImageUrl(SubCategory::Image_UPLOAD_PATH, $this->photo),
        ];
    }
}
