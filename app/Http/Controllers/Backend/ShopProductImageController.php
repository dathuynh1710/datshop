<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ShopProduct;
use Illuminate\Http\Request;
use App\Models\ShopProductImage;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ShopProductImage\ShopProductImageStoreRequest;
use App\Http\Requests\ShopProductImage\ShopProductImageDestroyRequest;

class ShopProductImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dsProductImages = ShopProductImage::paginate(5);

        return view('backend.shop_product_images.index')
            ->with('dsProductImages', $dsProductImages);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dsProducts = ShopProduct::all();
        return view('backend.shop_product_images.create')
            ->with('dsProducts', $dsProducts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ShopProductImageStoreRequest $request)
    {
        $newModel = new ShopProductImage();
        $newModel->product_id = $request->product_id;

        if ($request->hasFile('file')) {
            $file = $request->file;
            $newFileName = date('Ymd_His') . '_' . $file->getClientOriginalName();
            $newModel->image = 'product-images/' . $newFileName;
            $file->storeAs('uploads/product-images', $newFileName, 'public');
        }
        $newModel->save();
        return response()->json(
            [
                'status' => 'success',
                'message' => 'Thêm mới hình thành công',
            ]
        );
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
        $shop_product_image = ShopProductImage::find($id);
        $dsProducts = ShopProduct::all();
        return view('backend.shop_product_images.edit')
            ->with('shop_product_image', $shop_product_image)
            ->with('dsProducts', $dsProducts);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $updatingModel = ShopProductImage::find($id);
        $updatingModel->product_id = $request->product_id;

        if ($request->hasFile('image')) {
            $filePath = 'uploads/' . $updatingModel->image;
            Storage::disk('public')->delete($filePath);
            $file = $request->image;
            $newFileName = date('Ymd_His') . '_' . $file->getClientOriginalName();
            $updatingModel->image = 'product-images/' . $newFileName;
            $file->storeAs('uploads/product-images', $newFileName, 'public');
        }
        $updatingModel->save();
        return redirect(route('backend.shop_product_images.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShopProductImageDestroyRequest $request, $id)
    {
        $deletingModel = ShopProductImage::find($id);

        if ($deletingModel != null) {
            $filePath = 'uploads/' . $deletingModel->image;
            Storage::disk('public')->delete($filePath);
            $deletingModel->delete();
        }

        return redirect(route('backend.shop_product_images.index'));
    }

    public function batchDelete(Request $request)
    {
        $listSelectedIds = $request->listSelectedIds;
        foreach ($listSelectedIds as $id) {
            $deletingModel = ShopProductImage::find($id);
            if ($deletingModel != null) {
                // Xóa file trong storage
                $filePath = 'uploads/' . $deletingModel->image;
                // dd($filePath);
                Storage::disk('public')->delete($filePath);
                $deletingModel->delete();
            }
        }
        return response()->json(
            [
                'status' => 'success',
                'message' => 'Đã xóa các hình thành công!!!',
                'list_deleted_ids' => $listSelectedIds
            ]
        );
    }

    public function search(Request $request)
    {
        $query = ShopProductImage::query();
        // Nếu keyword_image tồn tại và khác rỗng
        if (isset($request->keyword_image) && !empty($request->keyword_image)) {
            $query->where('image', 'like', '%' . $request->keyword_image . '%');
        }

        // Nếu keyword_product_name tồn tại và khác rỗng
        if (isset($request->keyword_product_name) && !empty($request->keyword_product_name)) {
            $query->join('shop_products', 'shop_product_images.product_id', '=', 'shop_products.id')
                ->where('shop_products.product_name', 'LIKE', '%' . $request->keyword_product_name . '%');
        }
        $query->select('shop_product_images.*');

        $dsProductImages =   $query->paginate(5)->appends($request->query());

        return view('backend.shop_product_images.index')
            ->with('dsProductImages', $dsProductImages);
    }
}
