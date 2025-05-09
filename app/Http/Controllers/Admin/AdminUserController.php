<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::query()
            ->when($request->search, fn($q) =>
                $q->where('name', 'like', "%{$request->search}%")
                  ->orWhere('email', 'like', "%{$request->search}%")
            )
            ->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'is_admin' => 'required|boolean', 
        ]);
    
        // Cập nhật thông tin người dùng
        $user->name = $data['name'];
        $user->email = $data['email'];
    
        // Cập nhật vai trò (is_admin) của người dùng
        $user->is_admin = $data['is_admin'];
    
        // Lưu thay đổi
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Cập nhật thành công!');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Đã xóa người dùng!');
    }
}
