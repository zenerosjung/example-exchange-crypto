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
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->timestamps();
        });

        Schema::create('cryptocurrency', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('currency', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('fiat_wallet', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
            $table->float('estimated_balance', 8, 2);
            $table->float('fait_balance', 8, 8);
            $table->float('spot_balance', 8, 8);
            $table->timestamps();
        });

        Schema::create('fiat_wallet_cryptocurrency', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('cryptocurrency_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('cryptocurrency_id')->references('id')->on('cryptocurrency')->onDelete('cascade');
            $table->float('total', 8, 8);
            $table->float('available', 8, 8);
            $table->timestamps();
        });

        Schema::create('funding_wallet', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
            $table->float('estimated_balance', 8, 8);
            $table->timestamps();
        });

        Schema::create('funding_wallet_cryptocurrency', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('cryptocurrency_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('cryptocurrency_id')->references('id')->on('cryptocurrency')->onDelete('cascade');
            $table->float('total', 8, 8);
            $table->float('available', 8, 8);
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
        Schema::dropIfExists('user');
        Schema::dropIfExists('cryptocurrency');
        Schema::dropIfExists('currency');
        Schema::dropIfExists('fiat_wallet');
        Schema::dropIfExists('fiat_wallet_cryptocurrency');
        Schema::dropIfExists('funding_wallet');
        Schema::dropIfExists('funding_wallet_cryptocurrency');
    }
}
