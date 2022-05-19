<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CheckoutRequest;
use App\Models\Camp;
use App\Models\Checkout;
use Illuminate\Http\Request;
use Mail;
use App\Mail\Checkout\AfterCheckout;
use App\Models\Discount;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Str;
use Midtrans;

class CheckoutController extends Controller
{
    # Set Midtrans Configuration
    public function __construct()
    {
        // Set your Merchant Server Key
        Midtrans\Config::$serverKey = env('MIDTRANS_SERVERKEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        // Set sanitization on (default)
        Midtrans\Config::$isSanitized = env('MIDTRANS_IS_SANITIZED');
        // Set 3DS transaction for credit card to true
        Midtrans\Config::$is3ds = env('MIDTRANS_IS_3DS');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Camp $camp)
    {
        // Validasi Jika User Telah Mendaftar Salah Satu Bootcamp
        if (Checkout::where('camp_id', $camp->id)->where('user_id', Auth::user()->id)->exists()) {
            $request->session()->flash('error', "You already registered in $camp->title program!");

            return redirect()->route('dashboard.user');
        }
        // exists(): function php untuk cek apakah ada data yang sama didalam db
        // dalam studi kasus ini kita cek apakah user yang login pernah daftar di bootcamp ini

        return view('pages.checkout.checkout',compact('camp'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckoutRequest $request, Camp $camp)
    {
        // Mapping Request Data
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['camp_id'] = $camp->id;

        // Update User Data
        $user = Auth::user();
        $user->email = $data['email'];
        $user->name = $data['name'];
        $user->occupation = $data['occupation'];
        $user->phone = $data['phone'];
        $user->address = $data['address'];
        $user->save();

        // Check Discount (Diisi User / Tidak)
        if ($request->discount) {
            // Jika diisi field discountnya (jalankan code ini) / cari data diskonnya
            $discount = Discount::where('code', $request->discount)->first();
            // Simpan discount_id didalam table checkouts
            $data['discount_id'] = $discount->id;
            // Simpan discount_percentage didalam table checkouts
            $data['discount_percentage'] = $discount->percentage;
            // Simpan total transaksi didalam table checkout
        }

        // Create Checkout Data
        $checkout = Checkout::create($data);

        return $checkout;

        // Tambahkan Function getSnapRedirect
        // dd($this->getSnapRedirect($checkout));
        $this->getSnapRedirect($checkout);

        // sending email 
        Mail::to(Auth::user()->email)->send(new AfterCheckout($checkout));

        return redirect()->route('checkout.success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function success()
    {
        return view('pages.checkout.success');
    }

    # Midtrans Handler
    public function getSnapRedirect(Checkout $checkout)
    {
        # Generate Booking Code
        $orderId = $checkout->id.'-'.Str::random(5);
        # Harga Bootcamp
        $price = $checkout->camp->price;
        
        # Instansiasi $checkout->midtrans_booking_code menyimpan nilai $orderId
        $checkout->midtrans_booking_code = $orderId;

        $transaction_details = [
            'order_id' => $orderId,
            'gross_amount' => $price,
        ];

        $item_details[] = [
            'id' => $orderId,
            'price' => $price,
            'quantity' => 1,
            'name' => "Payment for {$checkout->camp->title} Camp",
        ];

        $user_data = [
            "first_name" => $checkout->user->name,
            "last_name" => "",
            "address" => $checkout->user->address,
            "city" => "",
            "postal_code" => "",
            "phone" => $checkout->user->phone,
            "country_code" => "IDN",
        ];

        $customer_details = [
            "first_name" => $checkout->user->name,
            "last_name"  => "",
            "email"      => $checkout->user->email,
            "phone"      => $checkout->user->phone,
            "billing_address" => $user_data,
            "shipping_address" => $user_data,
        ];

        /*
            Simpan Kedalam Satu Objek:
            $transaction_details, $item_details, $customer_details
        */
        $midtrans_params = [
            'transaction_details' => $transaction_details,
            'item_details'        => $item_details,
            'customer_details'    => $customer_details,
        ];

        # Bracket Untuk Hit Kesisi Midtrans
        try {
            # Get Snap Payment Page Url
            $paymentUrl = \Midtrans\Snap::createTransaction($midtrans_params)->redirect_url;

            # Simpan $paymentUrl kedalam column midtrans_url pada tabel "checkouts"
            $checkout->midtrans_url = $paymentUrl;
            $checkout->save();

            # return ke Variabel $paymentUrl
            return $paymentUrl;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    # Midtrans Callback
    public function midtransCallback(Request $request)
    {
        /*
            Jika Request
            1. POST = new Midtrans\Notification()
            2. GET = Midtrans\Transaction::status($request->order_id)
        */
        $notif = $request->method() == 'POST' ? new Midtrans\Notification() : Midtrans\Transaction::status($request->order_id);

        $transaction_status = $notif->transaction_status;
        $fraud = $notif->fraud_status;

        # Cari id transaksi / checkout id
        # Didapat dari $orderId di function getSnapRedirect
        $checkout_id = explode('-', $notif->order_id)[0];

        # Cari id 'checkout' dari table checkouts
        $checkout = Checkout::findOrFail($checkout_id);

        # Cek Transaksi Status
        if ($transaction_status == 'capture') {
            if ($fraud == 'challenge') {
                // TODO Set payment status in merchant's database to 'challenge'
                $checkout->payment_status = 'pending';
            }
            else if ($fraud == 'accept') {
                // TODO Set payment status in merchant's database to 'success'
                $checkout->payment_status = 'paid';
            }
        } 
        else if ($transaction_status == 'cancel') {
            if ($fraud == 'challenge') {
                // TODO Set payment status in merchant's database to 'failure'
                $checkout->payment_status = 'failed';
            }
            else if ($fraud == 'accept') {
                // TODO Set payment status in merchant's database to 'failure'
                $checkout->payment_status = 'failed';
            }
        }
        else if ($transaction_status == 'deny') {
            // TODO Set payment status in merchant's database to 'failure'
            $checkout->payment_status = 'failed';
        }
        else if ($transaction_status == 'settlement') {
            // TODO set payment status in merchant's database to 'Settlement'
            $checkout->payment_status = 'paid';
        }
        else if ($transaction_status == 'pending') {
            // TODO set payment status in merchant's database to 'Pending'
            $checkout->payment_status = 'pending';
        }
        else if ($transaction_status == 'expire') {
            // TODO set payment status in merchant's database to 'expire'
            $checkout->payment_status = 'failed';
        }

        # Simpan Perubahan Datanya (update status payment_status) pada table checkouts
        $checkout->save();

        return view('pages.checkout.success');
    }
}
