<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
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
        $category = $request->except('photo');
        $category['user_id'] = auth()->id();
        $category['slug'] = Str::slug($request->input('slug'));
        if ($request->has('photo')) {
            $height       = 450;
            $width        = 450;
            $height_thumb = 450;
            $width_thumb  = 450;
            $path         = Str::slug($request->input('slug'));
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
