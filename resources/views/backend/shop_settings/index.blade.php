@extends('backend.layouts.master')

@section('title')
    Danh sách cấu hình
@endsection

@section('main-content')
    <h1>Danh sách Cấu hình</h1>
    Số lượng dữ liệu: {{ count($dsShopSettings) }}
    <br />
    <a class="btn btn-primary" href="#">Thêm</a>
    <table class="table table-bordered">
        <tr>
            <th>Id</th>
            <th>Nhóm</th>
            <th>Mã</th>
            <th>Giá trị</th>
            <th>Mô tả</th>
            <th>Ngày tạo</th>
            <th>Ngày cập nhật</th>
            <th>Hành động</th>
        </tr>
        @foreach ($dsShopSettings as $s)
            <tr>
                <td>{{ $s->id }}</td>
                <td>{{ $s->group }}</td>
                <td>{{ $s->key }}</td>
                <td>{{ $s->value }}</td>
                <td>{{ $s->description }}</td>
                <td>
                    {{ $s->created_at ? $s->created_at->diffForHumans() : 'N/A' }}
                </td>
                <td>{{ $s->updated_at }}</td>
                <td>
                    <a href="#" class="btn btn-warning">Sửa</a>
                    <form method="post" action="#">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Xóa</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
