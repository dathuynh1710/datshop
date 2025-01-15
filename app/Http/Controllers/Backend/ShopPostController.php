<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ShopPost;
use Illuminate\Http\Request;
use App\Models\AclUser;
use App\Models\ShopPostCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ShopPostController extends Controller
{
    // Hàm khởi tạo
    public function __construct()
    {
        // Policy kiểm tra quyền
    }
    public function index()
    {
        // Authentication
        // Kiểm tra xem có đăng nhập chưa?
        if (!Auth::check()) {
            return redirect(route('auth.login.index'));
        }
        // Kiểm tra quyền (Authorization)
        // - Nếu có quyền thì thực thi action
        // - Nếu không có quyền thì hiển thị 403: bạn không có quyền truy cập chức năng.
        $hasPermission = false;
        $permission = 'shop_posts::view';
        $hasPermission = shopHasPermission(Auth::user(), $permission);
        if (!$hasPermission) {
            return abort(403);
        }

        $lstPosts = ShopPost::all();
        return view('backend.shop_posts.index')->with('lstPosts', $lstPosts);
    }
    public function create()
    {
        // Authentication
        // Kiểm tra xem có đăng nhập chưa?
        if (!Auth::check()) {
            return redirect(route('auth.login.index'));
        }
        // Kiểm tra quyền (Authorization)
        // - Nếu có quyền thì thực thi action
        // - Nếu không có quyền thì hiển thị 403: bạn không có quyền truy cập chức năng.
        if (!Gate::allows('shop_posts::create')) {
            abort(403);
        }
        $lstUsers = AclUser::all();
        $lstPostCaterories = ShopPostCategory::all();
        return view('backend.shop_posts.create')
            ->with('lstUsers', $lstUsers)
            ->with('lstPostCaterories', $lstPostCaterories);
    }

    public function store(Request $request)
    {
        // Authentication
        // Kiểm tra xem có đăng nhập chưa?
        if (!Auth::check()) {
            return redirect(route('auth.login.index'));
        }

        // Kiểm tra quyền (Authorization)
        // - Nếu có quyền thì thực thi action
        // - Nếu không có quyền thì hiển thị 403: bạn không có quyền truy cập chức năng.
        if (!Gate::allows('shop_posts::create')) {
            abort(403);
        }
        $newPost = new ShopPost();
        $newPost->post_slug = $request->post_slug;
        $newPost->post_title = $request->post_title;
        $newPost->post_content = $request->post_content;
        $newPost->post_excerpt = $request->post_excerpt;
        $newPost->post_type = $request->post_type;
        $newPost->post_status = $request->post_status;
        $newPost->user_id = $request->user_id;
        $newPost->post_category_id = $request->post_category_id;
        if ($request->hasFile('post_image')) {
            $file = $request->post_image;
            $newFileName = date('Ymd_His') . '_' . $file->getClientOriginalName();
            $newPost->post_image = $newFileName;
            $file->storeAs('uploads/posts', $newFileName, 'public');
        }
        $newPost->save();
        return redirect(route('backend.shop_posts.index'));
    }

    public function edit($id) {}

    public function update(Request $request, $id)
    {
        if (!Gate::allows('shop_posts::update')) {
            abort(403);
        }
    }

    public function destroy($id) {}
}
