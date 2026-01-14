<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // 1️⃣ Danh sách + tìm kiếm + lọc
    public function index(Request $request)
    {
        $query = User::query();

        // Tìm kiếm
        if ($request->keyword) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->keyword}%")
                  ->orWhere('email', 'like', "%{$request->keyword}%");
            });
        }

        // Lọc role
        if ($request->role) {
            $query->where('role', $request->role);
        }

        $users = $query->orderByDesc('created_at')->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    // 2️⃣ Form thêm
    public function create()
    {
        return view('admin.users.create');
    }

    // 3️⃣ Lưu user mới
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required',
            'email' => 'required|email|unique:users',
            'role'  => 'required|in:admin,user',
            'password' => 'required|min:6'
        ]);

        User::create([
            'name' => $request->name,
            'email'=> $request->email,
            'role' => $request->role,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Thêm tài khoản thành công');
    }

    // 4️⃣ Xem chi tiết
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    // 5️⃣ Form sửa
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    // 6️⃣ Cập nhật
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'  => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'role'  => 'required|in:admin,user',
        ]);

        $user->update($request->only('name','email','role'));

        return redirect()->route('admin.users.index')
            ->with('success', 'Cập nhật thành công');
    }

    // 7️⃣ Xóa
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->role === 'admin') {
            return back()->with('error','Không thể xóa admin');
        }

        $user->delete();

        return back()->with('success','Xóa thành công');
    }
}
