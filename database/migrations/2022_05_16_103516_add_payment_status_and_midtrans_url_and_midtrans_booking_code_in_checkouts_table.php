<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentStatusAndMidtransUrlAndMidtransBookingCodeInCheckoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('checkouts', function (Blueprint $table) {
            # payment_status: cek status pembayaran: waiting, paid, expired, dll
            $table->string('payment_status', 100)->default('waiting')->after('camp_id');
            # midtrans_url: untuk redirect user kehalaman pembayaran midtrans (snap redirect)
            $table->string('midtrans_url')->nullable()->after('payment_status');
            # midtrans_booking_code: untuk memudahkan (antisipasi) pengecekan secara manual
            $table->string('midtrans_booking_code')->nullable()->after('midtrans_url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('checkouts', function (Blueprint $table) {
            $table->dropColumn(['payment_status', 'midtrans_url', 'midtrans_booking_code']);
        });
    }
}
