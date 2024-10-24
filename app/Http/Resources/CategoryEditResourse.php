<?php

namespace App\Http\Resources;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Manager\ImageUploadManager;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryEditResourse extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'status' => $this->status,
            'serial' => $this->serial,
            'photo_preview' => ImageUploadManager::prepareImageUrl(Category::Image_UPLOAD_PATH, $this->photo),
        ];
    }
}
