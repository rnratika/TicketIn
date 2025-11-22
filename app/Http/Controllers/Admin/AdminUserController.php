<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::where('role', '!=', 'admin')->latest()->get();
        return view('admin.users.index', compact('users'));
    }

    // Approve Organizer
    public function approve(User $user)
    {
        $user->update(['status' => 'active']);
        return back()->with('success', 'Organizer disetujui.');
    }

    // Reject Organizer
    public function reject(User $user)
    {
        $user->update(['status' => 'rejected']);
        return back()->with('success', 'Organizer ditolak.');
    }
    
    // Hapus User
    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'User dihapus.');
    }
}