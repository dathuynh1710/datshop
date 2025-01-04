<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShopSetting;

class ShopSettingController extends Controller
{
    public function index()
    {
        $dsShopSettings = ShopSetting::all();
        return view('backend.shop_settings.index')->with('dsShopSettings', $dsShopSettings);
    }
    public function create()
    {
        return view('backend.shop_settings.create');
    }
    public function store(Request $request)
    {
        $shopSetting = new ShopSetting();
        $shopSetting->group = $request->group;
        $shopSetting->key = $request->key;
        $shopSetting->value = $request->value;
        $shopSetting->description = $request->description;
        $shopSetting->created_at = date('Y-m-d H:i:s');
        $shopSetting->save();
        toastify()->success('Thêm mới thành công');
        return redirect(route('backend.shop_settings.index'));
    }
    public function edit($id)
    {
        $shopSetting = ShopSetting::find($id);
        return view('backend.shop_settings.edit')->with('shopSetting', $shopSetting);
    }
    public function update(Request $request, $id)
    {
        $shopSetting = ShopSetting::find($id);
        $shopSetting->group = $request->group;
        $shopSetting->key = $request->key;
        $shopSetting->value = $request->value;
        $shopSetting->description = $request->description;
        $shopSetting->updated_at = date('Y-m-d H:i:s');
        $shopSetting->save();
        toastify()->success('Cập nhật thành công');
        return redirect(route('backend.shop_settings.index'));
    }
    public function destroy($id)
    {
        ShopSetting::destroy($id);

        toastify()->success('Đã xóa thành công');
        return redirect(route('backend.shop_settings.index'));
    }
}
