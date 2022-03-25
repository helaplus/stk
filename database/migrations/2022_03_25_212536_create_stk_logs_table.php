<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stk_logs', function (Blueprint $table) {
            $table->id();
            $table->string('phone')->default(0);
            $table->string('amount')->default(0);
            $table->string('ref')->default(0);
            $table->string('checkout_request_id')->nullable();
            $table->text('details')->nullable();
            $table->text('response')->nullable();
            $table->integer('status')->nullable(0);
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
        Schema::dropIfExists('stk_logs');
    }
};
