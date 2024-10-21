<?php

namespace App\Http\Resources;

use App\Manager\ImageUploadManager;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryListResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'slug'       => $this->slug,
            'serial'     => $this->serial,
            'status'     => $this->status == 1 ? 'Active' : 'Inactive',
            'photo'      => ImageUploadManager::prepareImageUrl(Category::THUMB_Image_UPLOAD_PATH, $this->photo),
            'photo_full' => ImageUploadManager::prepareImageUrl(Category::Image_UPLOAD_PATH, $this->photo),
            'created_by' => $this->user?->name,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->created_at != $this->updated_at ? $this->updated_at->toDateTimeString() : 'Not updated yet',
        ];
    }
}
