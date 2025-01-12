<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AclRoleHasPermission;

class APIAclRoleHasPermissionController extends Controller
{
    public function getByRoleId($role_id)
    {
        $aclRoleHasPermissions = AclRoleHasPermission::where('role_id', $role_id)->pluck('permission_id')->toArray();

        // Chuẩn RESTFul API
        return response()->json(
            [
                'statusCode' => 200,
                'message' => 'Đã lấy dữ liệu thành công!',
                'data' => $aclRoleHasPermissions
            ]
        );
    }
}
