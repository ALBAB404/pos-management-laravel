<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Classes\BaseController;
use Illuminate\Support\Facades\DB;
use App\Manager\ImageUploadManager;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\StoreSubCategoryRequest;
use App\Http\Requests\UpdateSubCategoryRequest;
use App\Http\Resources\SubCategoryListResource;

class SubCategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {

           $categories = (new SubCategory)->getSubCategory($request->all());

            return SubCategoryListResource::collection($categories);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return $this->sendError(__("common.commonError"));
        }

    }

    public function store(StoreSubCategoryRequest $request)
    {
        try {
            DB::beginTransaction();

            $subCategory            = $request->except('photo');
            $subCategory['user_id'] = auth()->id();
            $subCategory['slug']    = Str::slug($request->input('slug'));
            if ($request->has('photo')) {
               $subCategory['photo'] = $this->processImageUpload($request->input('photo'), $subCategory['slug']);
            }

            (new SubCategory)->storeSubCategory($subCategory);

            DB::commit();
            return $this->sendResponse("Sub Category Created Successfully", "success");
        } catch (Exception $exception) {
            DB::rollback();
            Log::error($exception->getMessage());
            return $this->sendError(__("common.commonError"));
        }
    }

    public function show(SubCategory $subCategory)
    {
        //
    }

    public function update(UpdateSubCategoryRequest $request, SubCategory $subCategory)
    {
        //
    }

    public function destroy(SubCategory $subCategory)
    {
        try {
            DB::beginTransaction();

            if (!empty($subCategory->photo)) {
                ImageUploadManager::deletePhoto(SubCategory::Image_UPLOAD_PATH, $subCategory->photo);
                ImageUploadManager::deletePhoto(SubCategory::THUMB_Image_UPLOAD_PATH, $subCategory->photo);
            }

            $subCategory->delete();
            DB::commit();
            return $this->sendResponse("Sub Category Deleted Successfully", "warning");
        } catch (Exception $exception) {
            DB::rollback();
            Log::error($exception->getMessage());
            return $this->sendError(__("common.commonError"));
        }
    }

    private function processImageUpload($file, $name, $exisiting_photo = null)
    {
        $height            = 450;
        $width             = 450;
        $height_thumb      = 150;
        $width_thumb       = 150;
        $path              = SubCategory::Image_UPLOAD_PATH;
        $path_thumb        = SubCategory::THUMB_Image_UPLOAD_PATH;

        if (!empty($exisiting_photo)) {
            ImageUploadManager::deletePhoto(SubCategory::Image_UPLOAD_PATH, $exisiting_photo);
            ImageUploadManager::deletePhoto(SubCategory::THUMB_Image_UPLOAD_PATH, $exisiting_photo);
        }

        $photo_name = ImageUploadManager::uploadImage($name, $width, $height, $path, $file);
        ImageUploadManager::uploadImage($name, $width_thumb, $height_thumb, $path_thumb, $file);
        return $photo_name;
    }
}
