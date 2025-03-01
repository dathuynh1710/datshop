<?php

namespace App\Http\Requests\ShopCategory;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ShopCategoryIndexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        //Nếu chưa đăng nhập -> tức là không có quyền truy cập
        if (!Auth::check()) {
            return false;
        }

        // Nếu đã đăng nhập -> mà không vượt qua cửa an ninh (Gate) -> tức là k có quyền truy cập
        if (!Gate::allows('shop_categories::view')) {
            return false;
        }
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }
}
