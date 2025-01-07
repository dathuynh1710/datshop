<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ShopPost;
use Illuminate\Http\Request;
use App\Models\AclUser;
use App\Models\ShopPostCategory;

class ShopPostController extends Controller
{
    public function index()
    {
        $lstPosts = ShopPost::all();
        return view('backend.shop_posts.index')->with('lstPosts', $lstPosts);
    }
    public function create()
    {
        $lstUsers = AclUser::all();
        $lstPostCaterories = ShopPostCategory::all();
        return view('backend.shop_posts.create')
            ->with('lstUsers', $lstUsers)
            ->with('lstPostCaterories', $lstPostCaterories);
    }

    public function store(Request $request)
    {
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

    public function update(Request $request, $id) {}

    public function destroy($id) {}
}
