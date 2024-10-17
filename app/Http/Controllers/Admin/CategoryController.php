<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Manager\ImageUploadManager;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function store(CategoryRequest $request)
    {
        try {
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
            return response()->json(['message' => 'Category Created Successfully', 'cls' => 'success']);
        } catch (Exception $e) {
            // Return a JSON response with error details
            return response()->json([
                'message' => 'Category creation failed',
                'error' => $e->getMessage()
            ], 500); // 500 indicates a server-side error
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
