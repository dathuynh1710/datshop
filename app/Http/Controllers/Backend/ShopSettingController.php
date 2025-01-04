<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShopSetting;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make(
            $request->all(),
            [
                'group' => 'required|min:3|max:50',
                'key' => 'required',
                'value' => 'required',
            ],
            // messages
            [
                'group.required' => 'Tên nhóm bắt buộc nhập.',
                'group.min' => 'Tên nhóm phải từ 3 ký tự trở lên.',
                'group.max' => 'Tên nhóm phải ít hơn 50 ký tự.',
                'key.required' => 'Từ khóa bắt buộc nhập',
                'value.required' => 'Giá trị bắt buộc nhập',
            ]
        );
        // Xử lý logic chuyển hướng hay là tiến hành lưu
        if ($validator->fails()) {
            return redirect(route('backend.shop_settings.create'))
                ->withErrors($validator)
                ->withInput();
        }
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
