<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Checkout;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function index()
    {
        $items = Checkout::with(['camp'])->get();

        return view('pages.dashboard-admin.dashboard', compact('items'));
    }
}
