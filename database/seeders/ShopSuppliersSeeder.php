<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ShopSuppliersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $list = [];

        $row1 = [
            'id'            => 1,
            'supplier_code' => 'NCC1',
            'supplier_name' => 'Nhà cung cấp Apple',
            'description'   => 'Nhà cung cấp uy tín các dòng điện thoại, máy tính bảng',
            'image'         => 'suppliers/logo/Logo-Iphone-Apple.png',
            'created_at'    => date('Y-m-d H:i:s')
        ];
        array_push($list, $row1);

        $row2 = [
            'id'            => 2,
            'supplier_code' => 'NCC2',
            'supplier_name' => 'Nhà cung cấp Microsoft',
            'description'   => 'Nhà cung cấp uy tín các sản phẩm phần mềm văn phòng',
            'image'         => 'suppliers/logo/Logo-Microsoft.png',
            'created_at'    => date('Y-m-d H:i:s')
        ];
        array_push($list, $row2);

        // Insert vào database
        DB::table('shop_suppliers')->insert($list);
    }
}
