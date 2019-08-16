<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreditPackOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_pack_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_type');
            $table->integer('user_id');
            $table->integer('transaction_id');
            $table->integer('credit_pack_id');
            $table->integer ('amount');
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
        Schema::dropIfExists('credit_pack_orders');
    }
}
