<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Classes\BaseController;
use Illuminate\Support\Facades\DB;
use App\Manager\ImageUploadManager;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Resources\CategoryEditResourse;
use App\Http\Resources\CategoryListResource;

class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
           $categories = (new Category)->getCategory($request->all());
            return CategoryListResource::collection($categories);
        //    return $this->sendResponse('Category list', 'success', $categories);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return $this->sendError(__("common.commonError"));
        }

    }

    public function store(CategoryRequest $request)
    {
        try {
            DB::beginTransaction();

            $category            = $request->except('photo');
            $category['user_id'] = auth()->id();
            $category['slug']    = Str::slug($request->input('slug'));
            if ($request->has('photo')) {
               $category['photo'] = $this->processImageUpload($request->input('photo'), $category['slug']);
            }

            (new Category)->storeCategory($category);

            DB::commit();
            return $this->sendResponse("Category Created Successfully", "success");
        } catch (Exception $exception) {
            DB::rollback();
            Log::error($exception->getMessage());
            return $this->sendError(__("common.commonError"));
        }
    }


    final public function show(Category $category)
    {
        try {

             return new CategoryEditResourse($category);

         } catch (Exception $exception) {
             Log::error($exception->getMessage());

             return $this->sendError(__("common.commonError"));
         }
    }


    final public function update(CategoryUpdateRequest $request, Category $category)
    {
        try {
            DB::beginTransaction();

            $category_data            = $request->except('photo');
            $category_data['slug']    = Str::slug($request->input('slug'));
            if ($request->has('photo')) {
                $category_data['photo'] = $this->processImageUpload($request->input('photo'), $category_data['slug'], $category->photo);
            }

            $category->update($category_data);

            DB::commit();
            return $this->sendResponse("Category Updated Successfully", "success");
        } catch (Exception $exception) {
            DB::rollback();
            Log::error($exception->getMessage());
            return $this->sendError(__("common.commonError"));
        }
    }

    public function destroy(Category $category)
    {
        try {
            DB::beginTransaction();

            if (!empty($category->photo)) {
                ImageUploadManager::deletePhoto(Category::Image_UPLOAD_PATH, $category->photo);
                ImageUploadManager::deletePhoto(Category::THUMB_Image_UPLOAD_PATH, $category->photo);
            }

            $category->delete();
            DB::commit();
            return $this->sendResponse("Category Deleted Successfully", "warning");
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
        $path              = Category::Image_UPLOAD_PATH;
        $path_thumb        = Category::THUMB_Image_UPLOAD_PATH;

        if (!empty($exisiting_photo)) {
            ImageUploadManager::deletePhoto(Category::Image_UPLOAD_PATH, $exisiting_photo);
            ImageUploadManager::deletePhoto(Category::THUMB_Image_UPLOAD_PATH, $exisiting_photo);
        }

        $photo_name = ImageUploadManager::uploadImage($name, $width, $height, $path, $file);
        ImageUploadManager::uploadImage($name, $width_thumb, $height_thumb, $path_thumb, $file);
        return $photo_name;
    }

    final public function get_category_list(Request $request)
    {
        try {

            $categories = (new Category())->getCategoryIdAndName();

            return $this->sendResponse('Category list', 'success', $categories);
         } catch (Exception $exception) {
             Log::error($exception->getMessage());

             return $this->sendError(__("common.commonError"));
         }

    }
}
