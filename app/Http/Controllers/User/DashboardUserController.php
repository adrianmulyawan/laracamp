<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Checkout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardUserController extends Controller
{
    public function index()
    {
        $items = Checkout::with(['camp'])->whereUserId(Auth::user()->id)->get();
        // whereUserId() => where('user_id', Auth::user()->id)
        
        return view('pages.dashboard-user.dashboard', compact('items'));
    }
}
