<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrganizerStatusController extends Controller
{
    public function pending()
    {
        return view('organizer.status.pending');
    }

    public function rejected()
    {
        return view('organizer.status.rejected');
    }
    
    public function deleteAccount(Request $request)
    {
        $user = $request->user();
        
        Auth::logout();
        $user->delete();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }
}