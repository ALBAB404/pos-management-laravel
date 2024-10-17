<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Manager\ImageUploadManager;

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
        info($request->all());
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
