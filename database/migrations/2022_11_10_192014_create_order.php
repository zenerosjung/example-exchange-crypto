<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });

        Schema::create('user_payment_bank_transfer', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
            $table->integer('payment_type_id')->unsigned();
            $table->foreign('payment_type_id')->references('id')->on('payment_type')->onDelete('cascade');
            $table->string('bank_account');
            $table->string('bank_name');
            $table->string('bank_branch');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });

        Schema::create('user_payment_true_money', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
            $table->integer('payment_type_id')->unsigned();
            $table->foreign('payment_type_id')->references('id')->on('payment_type')->onDelete('cascade');
            $table->string('phone');
            $table->string('username');
            $table->string('qr_code');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });

        Schema::create('order', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type'); // 1 = Buy, 2 = Sell
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
            $table->float('price')->default(0);
            $table->integer('price_currency_id')->unsigned();
            $table->foreign('price_currency_id')->references('id')->on('currency')->onDelete('cascade');
            $table->integer('cryptocurrency_id')->unsigned();
            $table->foreign('cryptocurrency_id')->references('id')->on('cryptocurrency')->onDelete('cascade');
            $table->float('total', 20, 8)->default(0);
            $table->float('available', 20, 8)->default(0);
            $table->float('limit_min', 20, 8)->default(0);
            $table->float('limit_max', 20, 8)->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });

        Schema::create('transaction', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('order')->onDelete('cascade');
            $table->integer('payment_type_id')->unsigned();
            $table->foreign('payment_type_id')->references('id')->on('payment_type')->onDelete('cascade');
            $table->float('total', 20, 8)->default(0);
            $table->float('receive', 20, 8)->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });

        Schema::create('order_payment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('order')->onDelete('cascade');
            $table->integer('payment_type_id')->unsigned();
            $table->foreign('payment_type_id')->references('id')->on('payment_type')->onDelete('cascade');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_type');
        Schema::dropIfExists('user_payment_bank_transfer');
        Schema::dropIfExists('user_payment_true_money');
        Schema::dropIfExists('order');
        Schema::dropIfExists('transaction');
        Schema::dropIfExists('order_payment');
    }
}
