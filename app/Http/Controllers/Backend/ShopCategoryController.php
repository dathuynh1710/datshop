<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ShopCategory;
use Illuminate\Http\Request;
use App\Http\Requests\ShopCategoryCreateRequest;
use App\Http\Requests\ShopCategoryIndexRequest;
use App\Http\Requests\ShopCategoryStoreRequest;
use App\Http\Requests\ShopCategoryDestroyRequest;
use Illuminate\Support\Facades\Storage;

class ShopCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ShopCategoryIndexRequest $request)
    {
        $dsShopCategories = ShopCategory::all();
        return view('backend.shop_categories.index')->with('dsShopCategories', $dsShopCategories);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(ShopCategoryCreateRequest $request)
    {
        return view('backend.shop_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ShopCategoryStoreRequest  $request)
    {
        $newCate = new ShopCategory();
        $newCate->category_code = $request->category_code;
        $newCate->category_name = $request->category_name;
        $newCate->description = $request->description;

        if ($request->hasFile('image')) {
            $file = $request->image;
            $newFileName = date('Ymd_His') . '_' . $file->getClientOriginalName();
            $newCate->image = 'categories/' . $newFileName;
            $file->storeAs('uploads/categories', $newFileName, 'public');
        }
        $newCate->save();
        return redirect(route('backend.shop_categories.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShopCategoryDestroyRequest $request, $id)
    {
        $deletingModel = ShopCategory::find($id);

        if ($deletingModel != null) {
            $filePath = 'uploads/' . $deletingModel->image;
            Storage::disk('public')->delete($filePath);
            $deletingModel->delete();
        }
        return redirect(route('backend.shop_categories.index'));
    }
}
