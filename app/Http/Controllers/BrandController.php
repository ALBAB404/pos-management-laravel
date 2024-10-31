<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Classes\BaseController;
use Illuminate\Support\Facades\DB;
use App\Manager\ImageUploadManager;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Http\Resources\BrandListResource;

class BrandController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $categories = (new Brand)->getBrand($request->all());

             return BrandListResource::collection($categories);
         } catch (Exception $exception) {
             Log::error($exception->getMessage());

             return $this->sendError(__("common.commonError"));
         }
    }

    public function store(StoreBrandRequest $request)
    {
        try {
           DB::beginTransaction();

           $brand = $request->except('photo');
           $brand['user_id'] = auth()->id();
           $brand['slug'] = Str::slug($request->input('slug'));
           if($request->has('photo')){
             $brand['photo'] = $this->processImageUpload($request->input('photo'), $brand['slug']);
           }

           (new Brand)->storeBrand($brand);

           DB::commit();
           return $this->sendResponse("Brand Created Successfully", "success");
        } catch (\Throwable $exception) {
            DB::rollback();
            Log::error($exception->getMessage());
            return $this->sendError(__("common.commonError"));
        }
    }

    public function show(Brand $brand)
    {
        //
    }

    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        //
    }

    public function destroy(Brand $brand)
    {
        //
    }

    private function processImageUpload($file, $name, $exisiting_photo = null)
    {
        $height            = 450;
        $width             = 450;
        $height_thumb      = 150;
        $width_thumb       = 150;
        $path              = Brand::Image_UPLOAD_PATH;
        $path_thumb        = Brand::THUMB_Image_UPLOAD_PATH;

        if (!empty($exisiting_photo)) {
            ImageUploadManager::deletePhoto(Brand::Image_UPLOAD_PATH, $exisiting_photo);
            ImageUploadManager::deletePhoto(Brand::THUMB_Image_UPLOAD_PATH, $exisiting_photo);
        }

        $photo_name = ImageUploadManager::uploadImage($name, $width, $height, $path, $file);
        ImageUploadManager::uploadImage($name, $width_thumb, $height_thumb, $path_thumb, $file);
        return $photo_name;
    }
}
