<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('f_name', 100)->nullable();
            $table->string('l_name', 100)->nullable();
            $table->string('phone', 255)->nullable(); // Changed length to match dump
            $table->string('email', 100)->nullable(); // Changed length to match dump
            $table->string('image', 100)->nullable();
            $table->tinyInteger('is_phone_verified')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 100)->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->string('interest', 255)->nullable();
            $table->string('cm_firebase_token', 255)->nullable();
            $table->tinyInteger('status')->default(1);
            $table->integer('order_count')->default(0);
            $table->string('login_medium', 255)->nullable();
            $table->string('social_id', 255)->nullable();
            $table->unsignedBigInteger('zone_id')->nullable();
            // Columns like wallet_balance, ref_code etc are added in later migrations
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
};
