<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Checkout;
use Illuminate\Http\Request;

class AdminCheckoutController extends Controller
{
    public function update(Request $request, Checkout $checkout)
    {
        # ubah status transaksi jadi terbayar
        $checkout->is_paid = true;
        # simpan datanya kedalam db
        $checkout->save();

        # kirim alert jika transaksi berhasil
        $request->session()->flash('success', "Checkout with ID {$checkout->id} has been updated!");

        return redirect()->route('dashboard.admin');
    }
}
