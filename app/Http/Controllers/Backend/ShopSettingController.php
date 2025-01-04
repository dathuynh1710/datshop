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
}
