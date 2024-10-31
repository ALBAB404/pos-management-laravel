<?php

namespace App\Http\Resources;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Manager\ImageUploadManager;
use Illuminate\Http\Resources\Json\JsonResource;

class BrandListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'slug'        => $this->slug,
            'serial'      => $this->serial,
            'description' => $this->description,
            'status'      => $this->status == 1 ? 'Active' : 'Inactive',
            'photo'       => ImageUploadManager::prepareImageUrl(Brand::THUMB_Image_UPLOAD_PATH, $this->photo),
            'photo_full'  => ImageUploadManager::prepareImageUrl(Brand::Image_UPLOAD_PATH, $this->photo),
            'created_by'  => $this->user?->name,
            'created_at'  => $this->created_at->toDateTimeString(),
            'updated_at'  => $this->created_at != $this->updated_at ? $this->updated_at->toDateTimeString() : 'Not updated yet',
        ];
    }
}
