<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoinPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coin_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('txn_id')->nullable();
            $table->text('address')->nullable();

            $table->string('coin')->nullable();

            $table->double('amount_usd')->nullable();
            $table->double('amount_coin')->nullable();

            $table->string('status')->nullable();
            $table->string('status_url')->nullable();
            $table->boolean('processed')->default(false);
            $table->string('qrcode_url')->nullable();
            $table->string('timeout_at')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coin_payments');
    }
}
