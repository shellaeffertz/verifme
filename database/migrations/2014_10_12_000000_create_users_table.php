<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('username')->nullable();
            $table->string('nickname')->nullable();
            // 
            $table->string('telegram')->nullable();
            // 
            $table->string('password');
            $table->string('referrer')->nullable();
            $table->double('balance')->default(0)->nullable();
            $table->string('type')->default('user')->nullable();
            $table->string('channel_id')->nullable();
            $table->boolean('is_admin')->default(false)->nullable();
            $table->boolean('is_banned')->default(false)->nullable();
            $table->boolean('is_seller')->default(false)->nullable();
            $table->boolean('is_support')->default(false)->nullable();
            $table->float('commission')->default(0.2)->nullable();
            $table->boolean('is_affiliate')->default(false)->nullable();
            $table->float('affiliate_commission')->default(0.05)->nullable();
            $table->string('affiliate_code')->nullable();
            $table->double('affiliate_balance')->default(0)->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
