<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() { return view('admin.users.index', ['users' => User::latest()->get()]); }
    public function create() { return view('admin.users.form', ['editUser' => new User()]); }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role' => 'required|in:super_admin,editor',
        ]);
        $data['password'] = Hash::make($data['password']);
        User::create($data);
        return redirect()->route('admin.users.index')->with('success', 'Admin user created.');
    }

    public function destroy(User $editUser)
    {
        $editUser->delete();
        return back()->with('success', 'User removed.');
    }
}
