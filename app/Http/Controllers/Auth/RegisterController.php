<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AclUser;

use Ramsey\Uuid\Uuid;
use App\Mail\ActiveUserMail;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register.index');
    }
    public function register(Request $request)
    {
        $newUser = new AclUser();
        $newUser->username = $request->username;
        $newUser->password = bcrypt($request->password);
        $newUser->last_name = $request->last_name;
        $newUser->first_name = $request->first_name;
        $newUser->gender = $request->gender;
        $newUser->email = $request->email;
        $newUser->active_code = (string) Uuid::uuid4();
        $newUser->status = 0;
        $newUser->created_at = date('Y-m-d H:i:s');
        $newUser->save();
        Mail::to($newUser->email)->send(new ActiveUserMail($newUser));

        return redirect(route('auth.register.register-success'))->with('newUser', $newUser);
    }
    public function registerSuccess()
    {
        return view('auth.register.success');
    }
    public function activeUser(Request $request)
    {
        $username = $request->query('username');
        $activeCode = $request->query('activeCode');
        $user = AclUser::where(
            [
                'username' => $username,
                'active_code' => $activeCode
            ]
        )->first();

        if (is_null($user)) {
            // Tìm không thấy
            return 'Không tìm thấy tài khoản để kích hoạt.';
        } else {
            // Tìm thấy
            $user->status = 1; // Đã kích hoạt
            $user->save();
            return 'Đã kích hoạt thành công!';
        }
    }
}
