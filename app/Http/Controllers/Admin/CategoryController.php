<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Classes\BaseController;
use Illuminate\Support\Facades\DB;
use App\Manager\ImageUploadManager;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryListResource;

class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

           $categories = (new Category)->getCategory();
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

            $category = $request->except('photo');
            $category['user_id'] = auth()->id();
            $category['slug'] = Str::slug($request->input('slug'));
            if ($request->has('photo')) {
                $file             = $request->input('photo');
                $height           = 450;
                $width            = 450;
                $height_thumb     = 150;
                $width_thumb      = 150;
                $name             = Str::slug($request->input('slug'));
                $path = 'images/uploads/category/';
                $path_thumb = 'images/uploads/category_thumb/';
                $category['photo'] = ImageUploadManager::uploadImage($name, $width, $height, $path, $file);
                ImageUploadManager::uploadImage($name, $width_thumb, $height_thumb, $path_thumb, $file);
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


    public function show(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
