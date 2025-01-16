<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShopSupplier;
use App\Http\Requests\ShopSupplier\ShopSupplierIndexRequest;
use App\Http\Requests\ShopSupplier\ShopSupplierCreateRequest;
use App\Http\Requests\ShopSupplier\ShopSupplierStoreRequest;
use App\Http\Requests\ShopSupplier\ShopSupplierDestroyRequest;
use App\Http\Requests\ShopSupplier\ShopSupplierUpdateRequest;
use Illuminate\Support\Facades\Storage;

class ShopSupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ShopSupplierIndexRequest $request)
    {
        $dsShopSuppliers = ShopSupplier::all();

        return view('backend.shop_suppliers.index')
            ->with('dsShopSuppliers', $dsShopSuppliers);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(ShopSupplierCreateRequest $request)
    {
        return view('backend.shop_suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ShopSupplierStoreRequest $request)
    {
        $newModel = new ShopSupplier();
        $newModel->supplier_code = $request->supplier_code;
        $newModel->supplier_name = $request->supplier_name;
        $newModel->description = $request->description;

        if ($request->hasFile('image')) {
            $file = $request->image;
            $newFileName = date('Ymd_His') . '_' . $file->getClientOriginalName();
            $newModel->image = 'suppliers/' . $newFileName;
            $file->storeAs('uploads/suppliers', $newFileName, 'public');
        }
        $newModel->save();
        return redirect(route('backend.shop_suppliers.index'));
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
        $updatingModel = ShopSupplier::find($id);
        return view('backend.shop_suppliers.edit')->with('updatingModel', $updatingModel);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ShopSupplierUpdateRequest $request, string $id)
    {
        $updatingModel = ShopSupplier::find($id);
        $updatingModel->supplier_code = $request->supplier_code;
        $updatingModel->supplier_name = $request->supplier_name;
        $updatingModel->description = $request->description;

        if ($request->hasFile('image')) {
            $filePath = 'uploads/' . $updatingModel->image;
            Storage::disk('public')->delete($filePath);
            $file = $request->image;
            $newFileName = date('Ymd_His') . '_' . $file->getClientOriginalName();
            $updatingModel->image = 'suppliers/' . $newFileName;
            $file->storeAs('uploads/suppliers', $newFileName, 'public');
        }
        $updatingModel->save();
        return redirect(route('backend.shop_suppliers.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShopSupplierDestroyRequest $request, $id)
    {
        $deletingModel = ShopSupplier::find($id);
        // dd($deletingModel);

        // Xóa file không sử dụng nữa (file RÁC)
        if ($deletingModel != null) {
            // Xóa file trong storage
            $filePath = 'uploads/' . $deletingModel->image;
            // dd($filePath);
            Storage::disk('public')->delete($filePath);

            $deletingModel->delete();
        }

        // Điều hướng về route index
        return redirect(route('backend.shop_suppliers.index'));
    }
}
