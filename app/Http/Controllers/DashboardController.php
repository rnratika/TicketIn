<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.users.index');
        } 
        elseif ($user->role === 'organizer') {
            if ($user->status === 'pending') return redirect()->route('organizer.pending');
            if ($user->status === 'rejected') return redirect()->route('organizer.rejected');
            
            return redirect()->route('organizer.events.index');
        }

        return view('dashboard');
    }
}